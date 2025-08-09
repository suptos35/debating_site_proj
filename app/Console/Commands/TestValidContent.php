<?php

namespace App\Console\Commands;

use App\Models\Reference;
use App\Models\Post;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class TestValidContent extends Command
{
    protected $signature = 'test:valid-content';
    protected $description = 'Test AI with a valid post and reference';

    public function handle()
    {
        $this->info("Testing AI with Valid Content");
        $this->info("==============================");

        // Create a test post with meaningful content
        $post = new Post();
        $post->content = "Climate change is causing rising sea levels and extreme weather patterns around the world. Scientific evidence shows global temperatures have increased significantly since the industrial revolution.";
        $post->user_id = 1; // Assuming user ID 1 exists
        $post->save();

        $this->info("Created test post: " . substr($post->content, 0, 100) . "...");

        // Create a reference with climate-related content
        $reference = new Reference();
        $reference->post_id = $post->id;
        $reference->url = "https://www.bbc.com/news/science-environment-54256826"; // BBC climate article
        $reference->description = "BBC article on climate change evidence";
        $reference->is_valid = true;
        $reference->is_reputable = true;
        $reference->save();

        $this->info("Created reference: {$reference->url}");
        $this->info("");

        // Test AI analysis
        $aiService = new FreeAIReferenceService();
        $result = $aiService->validateReference($reference, $post);

        $this->info("🤖 AI ANALYSIS RESULT:");
        $this->info("Supports Post: " . ($result['supports_post'] === null ? 'NULL' : ($result['supports_post'] ? 'YES' : 'NO')));
        $this->info("Confidence: " . round($result['confidence'] * 100, 1) . "%");
        $this->info("Explanation: " . $result['explanation']);

        // Clean up
        $reference->delete();
        $post->delete();

        if ($result['supports_post'] !== null) {
            $this->info("✅ SUCCESS: Valid content processed correctly!");
        } else {
            $this->error("❌ PROBLEM: Valid content was incorrectly rejected");
        }

        return 0;
    }
}
