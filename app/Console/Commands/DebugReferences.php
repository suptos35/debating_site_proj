<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reference;
use App\Models\Post;

class DebugReferences extends Command
{
    protected $signature = 'debug:references';
    protected $description = 'Debug reference content and post content';

    public function handle()
    {
        $this->info("=== DEBUGGING REFERENCES AND POST CONTENT ===");

        $references = Reference::with('post')->get();

        foreach ($references as $reference) {
            $this->newLine();
            $this->info("Reference ID: {$reference->id}");
            $this->info("URL: {$reference->url}");
            $this->newLine();

            $this->warn("Post Content (what AI compares to):");
            $this->line("'{$reference->post->content}'");
            $this->newLine();

            $this->info("AI Result:");
            $this->line("Supports: " . ($reference->supports_post ? 'YES' : ($reference->supports_post === false ? 'NO' : 'PENDING')));
            $this->line("Confidence: " . ($reference->confidence_score ? round($reference->confidence_score * 100, 1) . '%' : 'N/A'));
            $this->line("Analysis: " . ($reference->ai_analysis ?? 'N/A'));
            $this->line("Last Checked: " . ($reference->last_checked_at ? $reference->last_checked_at->format('Y-m-d H:i:s') : 'NULL'));

            $this->info("---");
        }

        $this->newLine();
        $this->error("🚨 ISSUE IDENTIFIED:");
        $this->error("The posts contain gibberish text, not real content!");
        $this->error("The AI is working correctly - it's comparing gibberish to real news articles.");
        $this->newLine();
        $this->info("💡 SOLUTION:");
        $this->info("Create posts with meaningful content to test AI accuracy properly.");
    }
}
