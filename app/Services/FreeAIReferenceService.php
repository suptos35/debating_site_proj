<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Reference;
use App\Models\Post;

class FreeAIReferenceService
{
    private $huggingFaceToken;

    public function __construct()
    {
        // Get free token from https://huggingface.co/settings/tokens
        $this->huggingFaceToken = config('services.huggingface.api_token');
    }

    /**
     * Check if reference supports post using free Hugging Face API
     */
    public function validateReference(Reference $reference, Post $post)
    {
        try {
            // Validate input content quality
            if (!$this->isValidContent($post->content)) {
                Log::warning("Post content appears to be gibberish or too short: '{$post->content}'");
                $result = $this->createResult(null, 0, 'Post content is too short or invalid for analysis');

                // Update reference even for rejected content so UI shows proper status
                $reference->update([
                    'is_relevant' => false, // Set to false for rejected content
                    'similarity_score' => $result['confidence'],
                    'ai_analysis' => $result['explanation'],
                    'supports_post' => $result['supports_post'],
                    'confidence_score' => $result['confidence'],
                    'last_checked_at' => now(),
                    'content_extracted' => 'REJECTED: Content too short or invalid'
                ]);

                return $result;
            }

            // Extract content from URL
            $urlContent = $this->extractUrlContent($reference->url);

            if (!$urlContent) {
                $result = $this->createResult(false, 0, 'Could not extract content from URL');

                // Update reference even for failed URL extraction
                $reference->update([
                    'is_relevant' => false, // Set to false for failed extraction
                    'similarity_score' => $result['confidence'],
                    'ai_analysis' => $result['explanation'],
                    'supports_post' => $result['supports_post'],
                    'confidence_score' => $result['confidence'],
                    'last_checked_at' => now(),
                    'content_extracted' => 'FAILED: Could not extract content'
                ]);

                return $result;
            }

            if (!$this->isValidContent($urlContent)) {
                Log::warning("URL content appears to be invalid: " . substr($urlContent, 0, 100));
                $result = $this->createResult(null, 0, 'URL content is too short or invalid for analysis');

                // Update reference for invalid URL content
                $reference->update([
                    'is_relevant' => false, // Set to false for invalid content
                    'similarity_score' => $result['confidence'],
                    'ai_analysis' => $result['explanation'],
                    'supports_post' => $result['supports_post'],
                    'confidence_score' => $result['confidence'],
                    'last_checked_at' => now(),
                    'content_extracted' => 'REJECTED: URL content invalid - ' . substr($urlContent, 0, 100)
                ]);

                return $result;
            }

            // Use free Hugging Face API
            $result = $this->analyzeWithHuggingFace($post->content, $urlContent);

            // Update reference
            $reference->update([
                'is_relevant' => $result['supports_post'],
                'similarity_score' => $result['confidence'],
                'ai_analysis' => $result['explanation'],
                'supports_post' => $result['supports_post'],
                'confidence_score' => $result['confidence'],
                'last_checked_at' => now(),
                'content_extracted' => substr($urlContent, 0, 500) // Store sample for debugging
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('AI Reference validation failed: ' . $e->getMessage());
            return $this->createResult(null, 0, 'Analysis failed: ' . $e->getMessage());
        }
    }

    /**
     * Validate if content is meaningful (not gibberish)
     */
    private function isValidContent($content)
    {
        $content = trim($content);

        // Too short
        if (strlen($content) < 10) {
            return false;
        }

        // Check for meaningful words (at least 3 real words)
        $words = str_word_count($content, 1);
        $meaningfulWords = 0;

        $commonWords = ['the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'must', 'can', 'a', 'an', 'this', 'that', 'these', 'those', 'what', 'where', 'when', 'why', 'how', 'who', 'which', 'about', 'into', 'through', 'during', 'before', 'after', 'above', 'below', 'up', 'down', 'out', 'off', 'over', 'under', 'again', 'further', 'then', 'once'];

        foreach ($words as $word) {
            $word = strtolower($word);
            if (strlen($word) >= 3 && (in_array($word, $commonWords) || ctype_alpha($word))) {
                $meaningfulWords++;
            }
        }

        // Need at least 3 meaningful words
        return $meaningfulWords >= 3;
    }

    /**
     * Using Hugging Face free API with text classification model
     */
    private function analyzeWithHuggingFace($postContent, $referenceContent)
    {
        // First check for obvious contradictions using keyword detection
        $contradictionDetected = $this->detectObviousContradiction($postContent, $referenceContent);

        if ($contradictionDetected) {
            Log::info("Obvious contradiction detected via keyword analysis");
            return $this->createResult(false, 0.8, "Contradiction detected: negative statement vs positive evidence");
        }

        // Try text similarity first to detect relevance
        $result = $this->checkSimilarity($postContent, $referenceContent);

        // If similarity is very low (<0.15), content is likely irrelevant
        if ($result['confidence'] < 0.15) {
            Log::info("Very low similarity ({$result['confidence']}), marking as irrelevant content");
            return $this->createResult(false, $result['confidence'], "Content appears unrelated (similarity: " . round($result['confidence'] * 100, 1) . "%)");
        }

        // For moderate to high similarity, use classification
        Log::info("Using classification for final analysis (similarity was: {$result['confidence']})");
        return $this->classifySupport($postContent, $referenceContent);
    }

    /**
     * Detect obvious contradictions using keyword analysis
     */
    private function detectObviousContradiction($postContent, $referenceContent)
    {
        $postLower = strtolower($postContent);
        $refLower = strtolower($referenceContent);

        // Look for negation words in the post
        $negationWords = ['cannot', 'can\'t', 'cant', 'don\'t', 'dont', 'doesn\'t', 'doesnt', 'won\'t', 'wont', 'will not', 'do not', 'does not', 'never', 'no', 'not'];
        $hasNegation = false;

        foreach ($negationWords as $negation) {
            if (strpos($postLower, $negation) !== false) {
                $hasNegation = true;
                break;
            }
        }

        if (!$hasNegation) {
            return false; // No negation found, let AI handle it normally
        }

        // Extract key action words from both texts
        $postWords = $this->extractKeywords($postContent);
        $refWords = $this->extractKeywords($referenceContent);

        // Check if they share key concepts but one is negated
        $commonConcepts = array_intersect($postWords, $refWords);

        // If there are common concepts AND the post has negation AND reference has positive language
        if (count($commonConcepts) >= 2 && $hasNegation) {
            // Look for positive indicators in reference
            $positiveWords = ['can', 'do', 'will', 'are', 'have', 'show', 'appear', 'maintain', 'seek'];
            foreach ($positiveWords as $positive) {
                if (strpos($refLower, $positive) !== false) {
                    Log::info("Contradiction detected: negation in post ('{$postContent}') vs positive evidence ('{$referenceContent}')");
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check semantic similarity between post and reference
     */
    private function checkSimilarity($postContent, $referenceContent)
    {
        try {
            if (!$this->huggingFaceToken) {
                Log::info("No HuggingFace token, using keyword analysis");
                return $this->simpleKeywordAnalysis($postContent, $referenceContent);
            }

            // Log what we're analyzing
            Log::info("AI Analysis Input - Post: " . substr($postContent, 0, 100) . "... | Reference: " . substr($referenceContent, 0, 100) . "...");

            // Use free sentence similarity model
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->huggingFaceToken,
            ])->timeout(30)->post('https://api-inference.huggingface.co/models/sentence-transformers/all-MiniLM-L6-v2', [
                'inputs' => [
                    'source_sentence' => substr($postContent, 0, 500),
                    'sentences' => [substr($referenceContent, 0, 500)]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $similarity = $result[0] ?? 0;

                Log::info("HuggingFace similarity result: " . $similarity);

                // More strict threshold - only high confidence counts
                $supports = $similarity > 0.7; // Increased from 0.5 to 0.7
                $confidence = $similarity;

                // If similarity is moderate, try classification for better accuracy
                if ($similarity > 0.4 && $similarity <= 0.7) {
                    Log::info("Similarity moderate ({$similarity}), trying classification for better accuracy");
                    return $this->classifySupport($postContent, $referenceContent);
                }

                return $this->createResult(
                    $supports,
                    $confidence,
                    $supports ?
                        "AI Similarity: strong match (similarity: " . round($similarity * 100, 1) . "%)" :
                        "AI Similarity: weak match (similarity: " . round($similarity * 100, 1) . "%)"
                );
            } else {
                Log::warning("HuggingFace similarity API failed: " . $response->status() . " - " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('HuggingFace similarity check failed: ' . $e->getMessage());
        }

        // Fallback to text classification
        return $this->classifySupport($postContent, $referenceContent);
    }

    /**
     * Classify if reference supports or contradicts the post
     */
    private function classifySupport($postContent, $referenceContent)
    {
        try {
            if (!$this->huggingFaceToken) {
                Log::info("No HuggingFace token for classification, using keyword analysis");
                return $this->simpleKeywordAnalysis($postContent, $referenceContent);
            }

            // Create a clear, simple prompt for classification
            $prompt = "Statement: " . substr($postContent, 0, 200) . "\n\n" .
                     "Evidence: " . substr($referenceContent, 0, 200);

            Log::info("Classification prompt: " . substr($prompt, 0, 150) . "...");

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->huggingFaceToken,
            ])->timeout(30)->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [
                'inputs' => $prompt,
                'parameters' => [
                    'candidate_labels' => ['supports', 'contradicts', 'neutral']
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $labels = $result['labels'] ?? [];
                $scores = $result['scores'] ?? [];

                Log::info("Classification result: " . json_encode($result));

                if (!empty($labels)) {
                    $topLabel = $labels[0];
                    $topScore = $scores[0];

                    Log::info("Classification: {$topLabel} with {$topScore} confidence");

                    // Only trust results with reasonable confidence
                    if ($topScore < 0.6) {
                        Log::info("Classification confidence too low ({$topScore}), falling back to keyword analysis");
                        return $this->simpleKeywordAnalysis($postContent, $referenceContent);
                    }

                    $supports = $topLabel === 'supports';

                    return $this->createResult(
                        $supports,
                        $topScore,
                        "AI Classification: {$topLabel} (confidence: " . round($topScore * 100, 1) . "%)"
                    );
                }
            } else {
                Log::warning("HuggingFace classification API failed: " . $response->status() . " - " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Classification failed: ' . $e->getMessage());
        }

        // Final fallback
        return $this->simpleKeywordAnalysis($postContent, $referenceContent);
    }

    /**
     * Simple keyword-based analysis (no API required)
     */
    private function simpleKeywordAnalysis($postContent, $referenceContent)
    {
        $postWords = $this->extractKeywords($postContent);
        $refWords = $this->extractKeywords($referenceContent);

        $commonWords = array_intersect($postWords, $refWords);
        $similarity = count($commonWords) / max(count($postWords), 1);

        $supports = $similarity > 0.3;

        return $this->createResult(
            $supports,
            $similarity,
            $supports ?
                "Found " . count($commonWords) . " matching keywords (keyword analysis)" :
                "Low keyword overlap detected (keyword analysis)"
        );
    }

    /**
     * Extract content from URL with better content detection
     */
    private function extractUrlContent($url)
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.5',
                ])
                ->get($url);

            if (!$response->successful()) {
                Log::warning("Failed to fetch URL: {$url}, Status: " . $response->status());
                return null;
            }

            $html = $response->body();

            // Log raw HTML length
            Log::info("Raw HTML length for {$url}: " . strlen($html) . " characters");

            // Try to extract main content using multiple strategies
            $content = $this->extractMainContent($html);

            if (strlen($content) < 50) {
                Log::warning("Extracted content too short for {$url}: " . strlen($content) . " chars - '{$content}'");
                return null;
            }

            // Log extracted content for debugging
            Log::info("Extracted content for {$url} (" . strlen($content) . " chars): " . substr($content, 0, 200) . "...");

            return $content;

        } catch (\Exception $e) {
            Log::error('URL content extraction failed for ' . $url . ': ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Better content extraction using multiple strategies
     */
    private function extractMainContent($html)
    {
        // Strategy 1: Look for article/main content tags
        if (preg_match('/<article[^>]*>(.*?)<\/article>/is', $html, $matches)) {
            $content = $this->cleanText($matches[1]);
            if (strlen($content) > 100) {
                return substr($content, 0, 2000);
            }
        }

        // Strategy 2: Look for main tag
        if (preg_match('/<main[^>]*>(.*?)<\/main>/is', $html, $matches)) {
            $content = $this->cleanText($matches[1]);
            if (strlen($content) > 100) {
                return substr($content, 0, 2000);
            }
        }

        // Strategy 3: Look for content div/section
        if (preg_match('/<div[^>]*class="[^"]*content[^"]*"[^>]*>(.*?)<\/div>/is', $html, $matches)) {
            $content = $this->cleanText($matches[1]);
            if (strlen($content) > 100) {
                return substr($content, 0, 2000);
            }
        }

        // Strategy 4: Look for paragraph-heavy sections
        preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $html, $paragraphs);
        if (!empty($paragraphs[1])) {
            $textContent = implode(' ', $paragraphs[1]);
            $content = $this->cleanText($textContent);
            if (strlen($content) > 100) {
                return substr($content, 0, 2000);
            }
        }

        // Strategy 5: Fallback - clean entire HTML but filter out navigation/footer
        $html = preg_replace('/<nav\b[^>]*>.*?<\/nav>/is', '', $html);
        $html = preg_replace('/<header\b[^>]*>.*?<\/header>/is', '', $html);
        $html = preg_replace('/<footer\b[^>]*>.*?<\/footer>/is', '', $html);
        $html = preg_replace('/<aside\b[^>]*>.*?<\/aside>/is', '', $html);

        return substr($this->cleanText($html), 0, 2000);
    }

    /**
     * Clean and normalize text content
     */
    private function cleanText($html)
    {
        // Remove script and style tags
        $html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $html);
        $html = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $html);

        // Remove comments
        $html = preg_replace('/<!--.*?-->/s', '', $html);

        // Strip HTML tags
        $text = strip_tags($html);

        // Normalize whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        // Remove common navigation/footer words
        $text = preg_replace('/\b(menu|navigation|footer|sidebar|advertisement|cookie|privacy policy|terms of service)\b/i', '', $text);

        return trim($text);
    }

    /**
     * Extract keywords for analysis
     */
    private function extractKeywords($text)
    {
        $stopWords = ['the', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'must', 'can', 'a', 'an', 'this', 'that', 'these', 'those'];
        $words = str_word_count(strtolower($text), 1);

        return array_filter($words, function($word) use ($stopWords) {
            return strlen($word) > 3 && !in_array($word, $stopWords);
        });
    }

    /**
     * Create standardized result
     */
    private function createResult($supports, $confidence, $explanation)
    {
        return [
            'supports_post' => $supports,
            'confidence' => round($confidence, 2),
            'explanation' => $explanation,
            'is_valid' => true
        ];
    }
}
