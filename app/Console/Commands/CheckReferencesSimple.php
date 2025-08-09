<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reference;
use App\Services\FreeAIReferenceService;

class CheckReferencesSimple extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'references:check-free {--id=} {--force}';

    /**
     * The console command description.
     */
    protected $description = 'Check references using free AI analysis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new FreeAIReferenceService();
        
        $query = Reference::with('post');
        
        if ($this->option('id')) {
            $query->where('id', $this->option('id'));
        } elseif (!$this->option('force')) {
            // Only check references that need rechecking
            $query->where(function($q) {
                $q->whereNull('last_checked_at')
                  ->orWhere('last_checked_at', '<', now()->subDays(7));
            });
        }
        
        $references = $query->get();
        
        $this->info("Checking {$references->count()} references...");
        
        if ($references->count() === 0) {
            $this->info('No references need checking.');
            return 0;
        }
        
        $progressBar = $this->output->createProgressBar($references->count());
        
        foreach ($references as $reference) {
            $this->newLine();
            $this->info("Checking: {$reference->url}");
            
            $result = $service->validateReference($reference, $reference->post);
            
            $status = $result['supports_post'] ? '✅ SUPPORTS' : '❌ CONTRADICTS';
            $this->line("Result: {$status} (Confidence: " . round($result['confidence'] * 100, 1) . "%)");
            $this->line("Analysis: {$result['explanation']}");
            
            $progressBar->advance();
            
            // Small delay to respect API limits
            sleep(1);
        }
        
        $progressBar->finish();
        $this->newLine(2);
        $this->info('Reference checking completed!');
        
        return 0;
    }
}
