<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\NotificationService;

class PostObserver
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post)
    {
        // Only trigger notifications for parent posts (not arguments/comments) for USER follower notifications
        if (is_null($post->parent_id) && is_null($post->group_id)) {
            // Create notifications ONLY for USER followers (NOT category followers yet)
            // Category notifications will be handled when categories are attached
            $this->createUserFollowerNotifications($post);
        }

        // For comments/replies (posts with parent_id), notify the parent post author
        if (!is_null($post->parent_id)) {
            $parentPost = Post::find($post->parent_id);
            if ($parentPost) {
                // If parent is a main post, it's a comment
                if (is_null($parentPost->parent_id)) {
                    $this->notificationService->createCommentNotification($parentPost, $post, $post->user);
                } else {
                    // If parent is also a comment, it's a reply
                    $this->notificationService->createReplyNotification($parentPost, $post, $post->user);
                }
            }
        }
    }

    /**
     * Create notifications only for user followers (not category followers).
     */
    private function createUserFollowerNotifications(Post $post)
    {
        try {
            // Get all followers of the post author
            $userFollowers = \App\Models\Follow::where('followable_type', 'App\Models\User')
                ->where('followable_id', $post->user_id)
                ->pluck('user_id');

            // Create notifications for user followers
            foreach ($userFollowers as $followerId) {
                if ($followerId != $post->user_id) { // Don't notify the author
                    \App\Models\Notification::create([
                        'user_id' => $followerId,
                        'type' => 'new_post_by_user',
                        'post_id' => $post->id,
                        'triggered_by_user_id' => $post->user_id,
                        'notifiable_type' => 'App\Models\User',
                        'notifiable_id' => $post->user_id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating user follower notifications: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
