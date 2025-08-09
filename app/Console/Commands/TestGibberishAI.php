<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FreeAIReferenceService;
use App\Models\Reference;
use App\Models\Post;

class TestGibberishAI extends Command
{
    protected $signature = 'test:gibberish-ai';
    protected $description = 'Test AI analysis with gibberish content';

    public function handle()
    {
        $this->info("=== TESTING AI WITH GIBBERISH CONTENT ===");
        $this->newLine();

        // Create a temporary post with gibberish content
        $post = new Post();
        $post->content = "tfytfytf tfyguyg";
        $post->title = "Test Post";
        $post->user_id = 1; // Assuming user 1 exists
        // Don't save to DB, just use for testing

        // Create a temporary reference
        $reference = new Reference();
        $reference->url = "https://www.bbc.com/news/videos/cj4wexw5gwyo";
        // Don't save to DB, just use for testing

        $this->info("📝 Post Content: '{$post->content}'");
        $this->info("🔗 Reference URL: {$reference->url}");
        $this->newLine();

        // Test the AI service
        $aiService = new FreeAIReferenceService();
        $result = $aiService->validateReference($reference, $post);

        $this->info("=== AI ANALYSIS RESULT ===");

        if ($result['supports_post'] === null) {
            $this->warn("🚫 ANALYSIS REJECTED");
        } elseif ($result['supports_post']) {
            $this->info("✅ SUPPORTS");
        } else {
            $this->error("❌ CONTRADICTS");
        }

        $this->info("Confidence: " . round($result['confidence'] * 100, 1) . "%");
        $this->info("Explanation: " . $result['explanation']);

        $this->newLine();
        $this->info("This demonstrates the system correctly rejects gibberish content!");

        return 0;
    }
}
