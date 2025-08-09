<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Reference;

class CheckCreatedPosts extends Command
{
    protected $signature = 'check:created-posts';
    protected $description = 'Check the debate posts that were just created';

    public function handle()
    {
        $this->info('Recent debate posts (main topics):');
        $mainPosts = Post::where('type', 'question')
            ->whereNull('parent_id')
            ->latest()
            ->take(5)
            ->with(['user', 'categories', 'pros', 'cons'])
            ->get();

        foreach($mainPosts as $post) {
            $this->line("\n📝 {$post->title}");
            $this->line("   By: {$post->user->name}");
            $this->line("   Category: " . $post->categories->pluck('name')->join(', '));
            $this->line("   PRO arguments: {$post->pros()->count()}");
            $this->line("   CON arguments: {$post->cons()->count()}");

            // Check references for this post's arguments
            $references = Reference::whereIn('post_id',
                $post->pros()->pluck('id')->merge($post->cons()->pluck('id'))
            )->get();

            $this->line("   References: {$references->count()}");

            foreach($references as $ref) {
                $status = $ref->supports_post === null ? 'Pending' :
                         ($ref->supports_post ? 'Supports' : 'Contradicts');
                $confidence = $ref->confidence_score ? " ({$ref->confidence_score}%)" : '';
                $this->line("     - {$ref->url} → {$status}{$confidence}");
            }
        }

        return 0;
    }
}
