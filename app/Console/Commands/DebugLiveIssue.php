<?php

namespace App\Console\Commands;

use App\Models\Reference;
use App\Services\FreeAIReferenceService;
use Illuminate\Console\Command;

class DebugLiveIssue extends Command
{
    protected $signature = 'debug:live-issue';
    protected $description = 'Debug the live issue with gorilla contradiction not working';

    public function handle()
    {
        $this->info("🔍 DEBUGGING LIVE GORILLA ISSUE");
        $this->info("===============================");

        // Find the most recent reference with gorilla content
        $recentRefs = Reference::with('post')
            ->whereHas('post', function($query) {
                $query->where('content', 'like', '%gorilla%')
                      ->orWhere('content', 'like', '%cannot%')
                      ->orWhere('content', 'like', '%can\'t%');
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        if ($recentRefs->isEmpty()) {
            $this->error("No recent gorilla references found");
            return 1;
        }

        foreach ($recentRefs as $ref) {
            $this->info("\n" . str_repeat("=", 50));
            $this->info("Reference ID: {$ref->id}");
            $this->info("Created: {$ref->created_at}");
            $this->info("URL: {$ref->url}");
            $this->info("Post Content: '{$ref->post->content}'");

            $this->info("\n📊 CURRENT DATABASE STATE:");
            $this->line("• supports_post: " . ($ref->supports_post === null ? 'NULL' : ($ref->supports_post ? 'TRUE (supports)' : 'FALSE (contradicts)')));
            $this->line("• confidence_score: " . ($ref->confidence_score ?? 'NULL'));
            $this->line("• last_checked_at: " . ($ref->last_checked_at ? $ref->last_checked_at->format('Y-m-d H:i:s') : 'NULL'));
            $this->line("• ai_analysis: " . ($ref->ai_analysis ?? 'NULL'));

            // Test with current AI service
            $this->info("\n🤖 TESTING WITH CURRENT AI SERVICE:");
            $aiService = new FreeAIReferenceService();
            $result = $aiService->validateReference($ref, $ref->post);

            $this->line("• New Result - Supports: " . ($result['supports_post'] === null ? 'NULL' : ($result['supports_post'] ? 'TRUE' : 'FALSE')));
            $this->line("• New Result - Confidence: " . round($result['confidence'] * 100, 1) . "%");
            $this->line("• New Result - Explanation: " . $result['explanation']);

            // Check if database was updated
            $ref->refresh();
            $this->info("\n💾 UPDATED DATABASE STATE:");
            $this->line("• supports_post: " . ($ref->supports_post === null ? 'NULL' : ($ref->supports_post ? 'TRUE (supports)' : 'FALSE (contradicts)')));
            $this->line("• confidence_score: " . ($ref->confidence_score ?? 'NULL'));
            $this->line("• ai_analysis: " . ($ref->ai_analysis ?? 'NULL'));

            // Determine what UI would show
            $this->info("\n🖥️ UI WOULD SHOW:");
            if ($ref->supports_post !== null) {
                if ($ref->supports_post) {
                    $this->line("🤖 Supports (" . round($ref->confidence_score * 100, 1) . "% confidence)");
                } else {
                    $this->line("🤖 Contradicts (" . round($ref->confidence_score * 100, 1) . "% confidence)");
                }
            } elseif ($ref->last_checked_at !== null) {
                $this->line("🤖 Rejected - " . ($ref->ai_analysis ?? 'Content rejected for analysis'));
            } else {
                $this->line("🤖 Pending");
            }
        }

        return 0;
    }
}
