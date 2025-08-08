<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report;

class ViewReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View all reports in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reports = Report::with(['user', 'reportable'])->get();

        $this->info('📋 Reports Summary:');
        $this->info('Total reports: ' . $reports->count());
        $this->info('Post reports: ' . $reports->where('reportable_type', 'App\Models\Post')->count());
        $this->info('Reference reports: ' . $reports->where('reportable_type', 'App\Models\Reference')->count());
        $this->line('');

        $this->info('📝 Detailed Reports:');

        foreach ($reports as $report) {
            $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
            $this->line("Report ID: {$report->id}");
            $this->line("Reporter: {$report->user->name} ({$report->user->email})");
            $this->line("Reason: {$report->reason_display}");
            $this->line("Status: {$report->status}");
            $this->line("Type: " . class_basename($report->reportable_type));

            if ($report->reportable_type === 'App\Models\Post' && $report->reportable) {
                $content = substr($report->reportable->content, 0, 100) . '...';
                $this->line("Post Content: {$content}");
            } elseif ($report->reportable_type === 'App\Models\Reference' && $report->reportable) {
                $this->line("Reference URL: {$report->reportable->url}");
                if ($report->reportable->description) {
                    $this->line("Description: {$report->reportable->description}");
                }
            }

            $this->line("Reported: {$report->created_at->diffForHumans()}");
            $this->line('');
        }

        return 0;
    }
}
