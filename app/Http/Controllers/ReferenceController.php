<?php


namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReferenceController extends Controller
{
public function store(Request $request, Post $post)
{
    if (Auth::id() !== $post->user_id) {
        abort(403);
    }
    $request->validate([
        'url' => 'required|url',
        'description' => 'nullable|string|max:255',
    ]);

    // Check validity with enhanced HTTP checking
    $isValid = false;
    $errorMessage = null;

    Log::info('Starting URL validation', ['url' => $request->url]);

    try {
        $response = Http::timeout(15)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate, br',
                'DNT' => '1',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1'
            ])
            ->withOptions([
                'verify' => false, // Skip SSL verification if needed
                'allow_redirects' => ['max' => 5]
            ])
            ->get($request->url);

        Log::info('HTTP Response received', [
            'status' => $response->status(),
            'content_type' => $response->header('Content-Type'),
            'body_length' => strlen($response->body())
        ]);

        // More lenient validity check
        if ($response->status() >= 200 && $response->status() < 400) {
            $contentType = strtolower($response->header('Content-Type') ?? '');

            // Check for valid content types
            $isValid = str_contains($contentType, 'text/html') ||
                      str_contains($contentType, 'application/pdf') ||
                      str_contains($contentType, 'text/plain') ||
                      str_contains($contentType, 'application/xhtml') ||
                      empty($contentType); // Some sites don't set content-type properly

            // Also check if body has content
            $isValid = $isValid && strlen($response->body()) > 100;

            Log::info('Content validation', [
                'content_type' => $contentType,
                'content_type_valid' => str_contains($contentType, 'text/html') || str_contains($contentType, 'application/pdf') || str_contains($contentType, 'text/plain') || str_contains($contentType, 'application/xhtml') || empty($contentType),
                'body_length' => strlen($response->body()),
                'body_length_valid' => strlen($response->body()) > 100,
                'final_valid' => $isValid
            ]);
        }
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Log::error('URL validation failed', [
            'url' => $request->url,
            'error' => $errorMessage
        ]);
        $isValid = false;
    }

    // Check reputation for fact-checking credibility (not just security)
    $domain = parse_url($request->url, PHP_URL_HOST);
    $domain = strtolower(str_replace('www.', '', $domain)); // Normalize domain

    Log::info('Domain parsing', [
        'original_url' => $request->url,
        'parsed_domain' => $domain
    ]);

    $isReputable = false;

    // Try NewsGuard API for source credibility (better for fact-checking)
    // try {
    //     $ngResponse = Http::timeout(5)->get('https://api.newsguardtech.com/check/' . $domain, [
    //         'x-api-key' => env('NEWSGUARD_API_KEY') // Get free key from newsguardtech.com
    //     ]);

    //     if ($ngResponse->successful()) {
    //         $ngData = $ngResponse->json();
    //         $credibilityScore = $ngData['score'] ?? 0; // 0-100 scale

    //         // Consider reputable if credibility score > 60
    //         $isReputable = $credibilityScore > 60;
    //     }
    // } catch (\Exception $e) {
    //     // API failed, fall back to curated credibility whitelist
    // }

    // Fallback: Credibility-focused whitelist for fact-checking
    if (!$isReputable) {
        $credibleSources = [
            // Primary sources - Government/Official
            'gov', 'cdc.gov', 'fda.gov', 'nih.gov', 'who.int', 'un.org',

            // Academic/Educational
            'edu', 'harvard.edu', 'mit.edu', 'stanford.edu', 'oxford.ac.uk',

            // High-credibility news (fact-checked, established)
            'reuters.com', 'ap.org', 'bbc.com', 'npr.org', 'pbs.org',
            'wsj.com', 'economist.com', 'ft.com', 'bloomberg.com',

            // Peer-reviewed journals
            'nature.com', 'science.org', 'nejm.org', 'bmj.com', 'thelancet.com',
            'cell.com', 'pnas.org', 'pubmed.ncbi.nlm.nih.gov',

            // Fact-checking organizations
            'factcheck.org', 'snopes.com', 'politifact.com', 'factchecker.org',

            // Research institutions
            'brookings.edu', 'cfr.org', 'pewresearch.org', 'gallup.com',

            // Reference works
            'wikipedia.org', 'britannica.com', 'merriam-webster.com'
        ];

        foreach ($credibleSources as $credibleDomain) {
            if (str_ends_with($domain, $credibleDomain)) {
                $isReputable = true;
                Log::info('Found reputable match', [
                    'domain' => $domain,
                    'matched_with' => $credibleDomain
                ]);
                break;
            }
        }
    }

    Log::info('Final validation results', [
        'url' => $request->url,
        'domain' => $domain,
        'is_valid' => $isValid,
        'is_reputable' => $isReputable,
        'error_message' => $errorMessage ?? 'none'
    ]);

    // Relevance (stub, replace with actual AI call)
    $isRelevant = false;
    $similarityScore = null;
    // TODO: Call AI API here and set $isRelevant/$similarityScore

    $reference = $post->references()->create([
        'url' => $request->url,
        'description' => $request->description,
        'is_valid' => $isValid,
        'is_reputable' => $isReputable,
        'is_relevant' => $isRelevant,
        'similarity_score' => $similarityScore,
    ]);

    // Add debugging to verify database save
    Log::info('Reference created in database', [
        'reference_id' => $reference->id,
        'url' => $reference->url,
        'is_valid' => $reference->is_valid,
        'is_reputable' => $reference->is_reputable,
        'is_relevant' => $reference->is_relevant,
        'similarity_score' => $reference->similarity_score
    ]);

    return back()->with('success', 'Reference added!');
}
    public function destroy(Reference $reference)
{
    if (Auth::id() !== $reference->post->user_id) {
        abort(403);
    }

    Log::info('Deleting reference', [
        'reference_id' => $reference->id,
        'reference_url' => $reference->url,
        'post_id' => $reference->post_id
    ]);

    $reference->delete();

    Log::info('Reference deleted successfully', [
        'reference_id' => $reference->id
    ]);

    return back()->with('success', 'Reference deleted!');
}

}
