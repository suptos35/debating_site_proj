<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $userId = Auth::id();
        $user = Auth::user();
        $liked = $post->isLikedByUser($userId);

        if ($liked) {
            // User already liked this post - remove the like
            $post->likes()->where('user_id', $userId)->delete();
            $post->decrement('like_count');
            $isLiked = false;
        } else {
            // User hasn't liked this post - add a like
            $post->likes()->create(['user_id' => $userId]);
            $post->increment('like_count');
            $isLiked = true;

            // Create notification for the post owner
            app(\App\Services\NotificationService::class)->createLikeNotification($post, $user);
        }

        return response()->json([
            'success' => true,
            'liked' => $isLiked,
            'likeCount' => $post->fresh()->like_count
        ]);
    }
}
