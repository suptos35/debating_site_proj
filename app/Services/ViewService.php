<?php

namespace App\Services;

use App\Models\Post;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ViewService
{
    /**
     * Record a view for the given post.
     *
     * @param Post $post
     * @param Request $request
     * @return void
     */
    public function recordView(Post $post, Request $request): void
    {
        // Get user ID if authenticated
        $userId = Auth::check() ? Auth::id() : null;
        
        // Get session ID
        $sessionId = Session::getId();
        
        // Get IP address
        $ipAddress = $request->ip();
        
        // Try to find existing view entry
        $view = View::firstOrNew([
            'post_id' => $post->id,
            'session_id' => $sessionId,
            'ip_address' => $ipAddress,
        ]);
        
        // Associate user if authenticated
        if ($userId) {
            $view->user_id = $userId;
        }
        
        // If this is a new view entry, view_count will be set to default 1
        // If it's an existing entry, increment the view count
        if ($view->exists) {
            $view->increment('view_count');
        } else {
            // New view, view_count is already set to default 1
            $view->save();
        }
    }
    
    /**
     * Get the total view count for a post.
     *
     * @param Post $post
     * @return int
     */
    public function getViewCount(Post $post): int
    {
        return $post->views()->sum('view_count');
    }
}
