<?php

namespace App\Console\Commands;

use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class TestPendingRefs extends Command
{
    protected $signature = 'test:pending-refs';
    protected $description = 'Test the enhanced AI service on pending references';

    public function handle()
    {
        $this->info("Testing Enhanced AI Service on Pending References");
        $this->info("=================================================");

        // Get references with NULL last_checked_at
        $pendingRefs = Reference::whereNull('last_checked_at')->with('post')->get();

        $this->info("Found " . $pendingRefs->count() . " pending references");

        foreach ($pendingRefs as $ref) {
            $this->info("\n--- Testing Reference ID: {$ref->id} ---");
            $this->info("URL: {$ref->url}");
            $this->info("Post Content: '{$ref->post->content}'");

            // Test the enhanced AI service
            $aiService = new FreeAIReferenceService();
            $result = $aiService->validateReference($ref, $ref->post);

            $this->info("🤖 AI Result: " . json_encode($result, JSON_PRETTY_PRINT));

            // Check if database was updated
            $ref->refresh();
            $this->info("📊 Database Status:");
            $this->info("- supports_post: " . ($ref->supports_post === null ? 'NULL' : ($ref->supports_post ? 'true' : 'false')));
            $this->info("- confidence_score: " . ($ref->confidence_score ?? 'NULL'));
            $this->info("- last_checked_at: " . ($ref->last_checked_at ? $ref->last_checked_at->format('Y-m-d H:i:s') : 'NULL'));
            $this->info("- ai_analysis: " . ($ref->ai_analysis ?? 'NULL'));
        }

        return 0;
    }
}
