<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class TestSimpleGorilla extends Command
{
    protected $signature = 'test:simple-gorilla';
    protected $description = 'Test simplified gorilla AI logic';

    public function handle()
    {
        $this->info("🦍 TESTING SIMPLIFIED GORILLA AI");
        $this->info("===============================");

        $scenarios = [
            ['content' => 'gorillas can seek out friends', 'expected' => 'SUPPORTS'],
            ['content' => 'gorillas cannot seek out friends', 'expected' => 'CONTRADICTS'],
            ['content' => 'gorillas can\'t seek out friends', 'expected' => 'CONTRADICTS'],
        ];

        foreach ($scenarios as $index => $scenario) {
            $this->info("\n--- Test " . ($index + 1) . " ---");
            $this->info("Content: '{$scenario['content']}'");
            $this->info("Expected: {$scenario['expected']}");

            // Create temp post and reference
            $post = new Post();
            $post->content = $scenario['content'];
            $post->user_id = 1;
            $post->save();

            $reference = new Reference();
            $reference->post_id = $post->id;
            $reference->url = 'https://www.bbc.com/news/articles/c80d7l94yvro';
            $reference->is_valid = true;
            $reference->is_reputable = true;
            $reference->save();

            // Test AI
            $aiService = new FreeAIReferenceService();
            $result = $aiService->validateReference($reference, $post);

            $actualResult = $result['supports_post'] === null ? 'REJECTED' : ($result['supports_post'] ? 'SUPPORTS' : 'CONTRADICTS');
            $isCorrect = $actualResult === $scenario['expected'];

            $this->line("Result: {$actualResult} ({$result['confidence']}%)");
            $this->line("Status: " . ($isCorrect ? '✅ CORRECT' : '❌ WRONG'));

            // Clean up
            $reference->delete();
            $post->delete();
        }

        return 0;
    }
}
