<?php

namespace App\Console\Commands;

use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class TestManualAI extends Command
{
    protected $signature = 'test:manual-ai';
    protected $description = 'Test manual AI checking on existing gibberish references';

    public function handle()
    {
        $this->info("Testing Manual AI Check on Gibberish References");
        $this->info("====================================================");

        // Get a gibberish reference
        $gibberishRef = Reference::whereHas('post', function($query) {
            $query->where('content', 'like', '%sdfskdjfiojggjetjhgkjhuj%')
                  ->orWhere('content', 'like', '%jbkjbjlbjbkb%')
                  ->orWhere('content', 'like', '%tfytfytf%');
        })->first();

        if (!$gibberishRef) {
            $this->error("No gibberish references found");
            return 1;
        }

        $this->info("Testing Reference ID: {$gibberishRef->id}");
        $this->info("URL: {$gibberishRef->url}");
        $this->info("Post Content: '{$gibberishRef->post->content}'");
        $this->info("");

        // Test the enhanced AI service
        $aiService = new FreeAIReferenceService();
        $result = $aiService->validateReference($gibberishRef, $gibberishRef->post);

        $this->info("🤖 AI ANALYSIS RESULT:");
        $this->info("Supports Post: " . ($result['supports_post'] === null ? '❌ NULL (Rejected)' : ($result['supports_post'] ? '✅ YES' : '❌ NO')));
        $this->info("Confidence: " . ($result['confidence'] * 100) . "%");
        $this->info("Explanation: " . $result['explanation']);

        if ($result['supports_post'] === null && $result['confidence'] == 0) {
            $this->info("✅ SUCCESS: Gibberish content correctly rejected!");
        } else {
            $this->error("❌ PROBLEM: Gibberish content was not rejected properly");
        }

        return 0;
    }
}
