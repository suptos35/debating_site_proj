<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class TestGorillaAI extends Command
{
    protected $signature = 'test:gorilla-ai';
    protected $description = 'Test AI with gorilla statements against relevant and irrelevant articles';

    public function handle()
    {
        $this->info("🦍 TESTING GORILLA AI ANALYSIS");
        $this->info("=================================");

        // Test scenarios
        $scenarios = [
            [
                'post_content' => 'Gorillas can seek out friends and form lasting social bonds with other gorillas in their group.',
                'url' => 'https://www.bbc.com/news/articles/c80d7l94yvro',
                'description' => 'BBC article about gorillas (RELEVANT)',
                'expected' => 'Should SUPPORT if article mentions gorilla social behavior'
            ],
            [
                'post_content' => 'Gorillas cannot seek out friends and are completely solitary animals that avoid social contact.',
                'url' => 'https://www.bbc.com/news/articles/c80d7l94yvro',
                'description' => 'BBC article about gorillas (RELEVANT - OPPOSING)',
                'expected' => 'Should CONTRADICT if article mentions gorilla social behavior'
            ],
            [
                'post_content' => 'Gorillas can seek out friends and form lasting social bonds with other gorillas in their group.',
                'url' => 'https://www.bbc.com/news/videos/cj4wexw5gwyo',
                'description' => 'BBC article about Gaza/Israel (IRRELEVANT)',
                'expected' => 'Should have LOW confidence - unrelated content'
            ]
        ];

        $testResults = [];

        foreach ($scenarios as $index => $scenario) {
            $this->info("\n" . str_repeat("=", 60));
            $this->info("🧪 TEST SCENARIO " . ($index + 1));
            $this->info("Post: " . substr($scenario['post_content'], 0, 80) . "...");
            $this->info("URL: " . $scenario['url']);
            $this->info("Expected: " . $scenario['expected']);
            $this->info(str_repeat("-", 60));

            // Create temporary post
            $post = new Post();
            $post->content = $scenario['post_content'];
            $post->user_id = 1; // Assuming user exists
            $post->save();

            // Create temporary reference
            $reference = new Reference();
            $reference->post_id = $post->id;
            $reference->url = $scenario['url'];
            $reference->description = $scenario['description'];
            $reference->is_valid = true;
            $reference->is_reputable = true;
            $reference->save();

            // Test AI analysis
            $aiService = new FreeAIReferenceService();

            $this->info("📥 Analyzing with AI...");
            $result = $aiService->validateReference($reference, $post);

            // Display results
            $this->info("📊 AI ANALYSIS RESULT:");
            $this->line("• Supports Post: " . ($result['supports_post'] === null ? '❌ REJECTED/NULL' : ($result['supports_post'] ? '✅ YES' : '❌ NO')));
            $this->line("• Confidence: " . round($result['confidence'] * 100, 1) . "%");
            $this->line("• Explanation: " . $result['explanation']);

            // Check database state
            $reference->refresh();
            $this->info("💾 DATABASE STATE:");
            $this->line("• supports_post: " . ($reference->supports_post === null ? 'NULL' : ($reference->supports_post ? 'true' : 'false')));
            $this->line("• confidence_score: " . ($reference->confidence_score ?? 'NULL'));
            $this->line("• last_checked_at: " . ($reference->last_checked_at ? $reference->last_checked_at->format('H:i:s') : 'NULL'));
            $this->line("• ai_analysis: " . substr($reference->ai_analysis ?? 'NULL', 0, 100) . "...");

            // Store result for summary
            $testResults[] = [
                'scenario' => $index + 1,
                'post' => substr($scenario['post_content'], 0, 50) . "...",
                'url_type' => strpos($scenario['url'], 'c80d7l94yvro') !== false ? 'GORILLA' : 'GAZA',
                'supports' => $result['supports_post'],
                'confidence' => round($result['confidence'] * 100, 1),
                'explanation' => $result['explanation']
            ];

            // Clean up
            $reference->delete();
            $post->delete();

            $this->info("✅ Test completed and cleaned up");
        }

        // Summary
        $this->info("\n" . str_repeat("=", 60));
        $this->info("📋 SUMMARY OF ALL TESTS");
        $this->info(str_repeat("=", 60));

        foreach ($testResults as $result) {
            $this->info("Test {$result['scenario']}: {$result['post']} vs {$result['url_type']} article");
            $this->line("  → " . ($result['supports'] === null ? 'REJECTED' : ($result['supports'] ? 'SUPPORTS' : 'CONTRADICTS')) . " ({$result['confidence']}%)");
            $this->line("  → {$result['explanation']}");
            $this->line("");
        }

        return 0;
    }
}
