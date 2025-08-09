<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class DebugAIInputs extends Command
{
    protected $signature = 'debug:ai-inputs';
    protected $description = 'Debug what content is being passed to AI analysis';

    public function handle()
    {
        $this->info("🔍 DEBUGGING AI INPUTS AND PROCESSING");
        $this->info("=====================================");

        // Test the contradictory statement
        $post = new Post();
        $post->content = 'Gorillas cannot seek out friends and are completely solitary animals that avoid social contact.';
        $post->user_id = 1;
        $post->save();

        $reference = new Reference();
        $reference->post_id = $post->id;
        $reference->url = 'https://www.bbc.com/news/articles/c80d7l94yvro';
        $reference->description = 'BBC gorilla article';
        $reference->is_valid = true;
        $reference->is_reputable = true;
        $reference->save();

        $this->info("📝 POST CONTENT:");
        $this->line("'{$post->content}'");
        $this->info("\n🌐 URL:");
        $this->line($reference->url);

        // Manually test content extraction
        $aiService = new FreeAIReferenceService();

        // Create a modified version of the service to show internal processing
        $this->info("\n🔍 STEP-BY-STEP ANALYSIS:");

        // Step 1: Content validation
        $reflection = new \ReflectionClass($aiService);
        $isValidMethod = $reflection->getMethod('isValidContent');
        $isValidMethod->setAccessible(true);

        $isValidPost = $isValidMethod->invoke($aiService, $post->content);
        $this->info("1. Post content valid: " . ($isValidPost ? '✅ YES' : '❌ NO'));

        // Step 2: URL content extraction
        $extractMethod = $reflection->getMethod('extractUrlContent');
        $extractMethod->setAccessible(true);

        $urlContent = $extractMethod->invoke($aiService, $reference->url);
        $this->info("2. URL content extracted: " . ($urlContent ? '✅ YES (' . strlen($urlContent) . ' chars)' : '❌ NO'));

        if ($urlContent) {
            $this->info("   First 200 chars of extracted content:");
            $this->line("   '" . substr($urlContent, 0, 200) . "...'");

            $isValidUrl = $isValidMethod->invoke($aiService, $urlContent);
            $this->info("   URL content valid: " . ($isValidUrl ? '✅ YES' : '❌ NO'));
        }

        // Step 3: Full AI analysis
        $this->info("\n3. Running full AI analysis...");
        $result = $aiService->validateReference($reference, $post);

        $this->info("\n📊 FINAL RESULT:");
        $this->line("• Supports: " . ($result['supports_post'] === null ? 'NULL' : ($result['supports_post'] ? 'YES' : 'NO')));
        $this->line("• Confidence: " . round($result['confidence'] * 100, 1) . "%");
        $this->line("• Explanation: " . $result['explanation']);

        // Check what was stored in content_extracted
        $reference->refresh();
        $this->info("\n💾 STORED CONTENT SAMPLE:");
        $this->line(substr($reference->content_extracted ?? 'NULL', 0, 300) . "...");

        // Clean up
        $reference->delete();
        $post->delete();

        $this->info("\n✅ Analysis complete");

        return 0;
    }
}
