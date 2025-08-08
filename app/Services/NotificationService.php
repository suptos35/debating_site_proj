<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Notification;
use App\Models\Follow;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Create notifications for a new post.
     * This should be called AFTER categories are attached to the post.
     */
    public function createPostNotifications(Post $post)
    {
        try {
            // Only create notifications for parent posts (not arguments/comments) and non-group posts
            if (!is_null($post->parent_id) || !is_null($post->group_id)) {
                return;
            }

            // Reload the post with categories to ensure they're loaded
            $post->load('categories');

            // Get all followers of the post author
            $userFollowers = Follow::where('followable_type', 'App\Models\User')
                ->where('followable_id', $post->user_id)
                ->pluck('user_id');

            // Create notifications for user followers
            foreach ($userFollowers as $followerId) {
                if ($followerId != $post->user_id) { // Don't notify the author
                    Notification::create([
                        'user_id' => $followerId,
                        'type' => 'new_post_by_user',
                        'post_id' => $post->id,
                        'triggered_by_user_id' => $post->user_id,
                        'notifiable_type' => 'App\Models\User',
                        'notifiable_id' => $post->user_id,
                    ]);
                }
            }

            // Get all followers of the post categories
            foreach ($post->categories as $category) {
                $categoryFollowers = Follow::where('followable_type', 'App\Models\Category')
                    ->where('followable_id', $category->id)
                    ->pluck('user_id');

                foreach ($categoryFollowers as $followerId) {
                    if ($followerId != $post->user_id) { // Don't notify the author
                        // Check if user doesn't already have a notification for this post
                        $existingNotification = Notification::where('user_id', $followerId)
                            ->where('post_id', $post->id)
                            ->exists();

                        if (!$existingNotification) {
                            Notification::create([
                                'user_id' => $followerId,
                                'type' => 'new_post_in_category',
                                'post_id' => $post->id,
                                'triggered_by_user_id' => $post->user_id,
                                'notifiable_type' => 'App\Models\Category',
                                'notifiable_id' => $category->id,
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error creating post notifications: ' . $e->getMessage());
        }
    }

    /**
     * Create notifications for categories when they are attached to a post.
     * This method should be called when categories are attached to an existing post.
     */
    public function createCategoryNotifications(Post $post, $categoryIds = null)
    {
        try {
            // Only create notifications for parent posts (not arguments/comments) and non-group posts
            if (!is_null($post->parent_id) || !is_null($post->group_id)) {
                return;
            }

            // If specific category IDs are provided, use those; otherwise use all post categories
            if ($categoryIds) {
                $categories = \App\Models\Category::whereIn('id', $categoryIds)->get();
            } else {
                $categories = $post->categories;
            }

            // Get all followers of the post categories
            foreach ($categories as $category) {
                $categoryFollowers = Follow::where('followable_type', 'App\Models\Category')
                    ->where('followable_id', $category->id)
                    ->pluck('user_id');

                foreach ($categoryFollowers as $followerId) {
                    if ($followerId != $post->user_id) { // Don't notify the author
                        // Check if user doesn't already have a notification for this post
                        $existingNotification = Notification::where('user_id', $followerId)
                            ->where('post_id', $post->id)
                            ->exists();

                        if (!$existingNotification) {
                            Notification::create([
                                'user_id' => $followerId,
                                'type' => 'new_post_in_category',
                                'post_id' => $post->id,
                                'triggered_by_user_id' => $post->user_id,
                                'notifiable_type' => 'App\Models\Category',
                                'notifiable_id' => $category->id,
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error creating category notifications: ' . $e->getMessage());
        }
    }

    /**
     * Create notification when someone likes a post.
     */
    public function createLikeNotification($post, $likerUser)
    {
        try {
            // Don't notify if user likes their own post
            if ($post->user_id == $likerUser->id) {
                return;
            }

            // Check if notification already exists for this like
            $existingNotification = Notification::where('user_id', $post->user_id)
                ->where('type', 'post_liked')
                ->where('post_id', $post->id)
                ->where('triggered_by_user_id', $likerUser->id)
                ->exists();

            if (!$existingNotification) {
                Notification::create([
                    'user_id' => $post->user_id,
                    'type' => 'post_liked',
                    'post_id' => $post->id,
                    'triggered_by_user_id' => $likerUser->id,
                    'notifiable_type' => 'App\Models\Post',
                    'notifiable_id' => $post->id,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error creating like notification: ' . $e->getMessage());
        }
    }

    /**
     * Create notification when someone comments on a post.
     */
    public function createCommentNotification($parentPost, $comment, $commenterUser)
    {
        try {
            // Don't notify if user comments on their own post
            if ($parentPost->user_id == $commenterUser->id) {
                return;
            }

            Notification::create([
                'user_id' => $parentPost->user_id,
                'type' => 'post_commented',
                'post_id' => $comment->id,
                'triggered_by_user_id' => $commenterUser->id,
                'notifiable_type' => 'App\Models\Post',
                'notifiable_id' => $parentPost->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating comment notification: ' . $e->getMessage());
        }
    }

    /**
     * Create notification when someone replies to a comment.
     */
    public function createReplyNotification($parentComment, $reply, $replierUser)
    {
        try {
            // Don't notify if user replies to their own comment
            if ($parentComment->user_id == $replierUser->id) {
                return;
            }

            Notification::create([
                'user_id' => $parentComment->user_id,
                'type' => 'post_replied',
                'post_id' => $reply->id,
                'triggered_by_user_id' => $replierUser->id,
                'notifiable_type' => 'App\Models\Post',
                'notifiable_id' => $parentComment->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating reply notification: ' . $e->getMessage());
        }
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($notificationId, $userId)
    {
        return Notification::where('id', $notificationId)
            ->where('user_id', $userId)
            ->update(['is_read' => true]);
    }

    /**
     * Mark all notifications as read for a user.
     */
    public function markAllAsRead($userId)
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * Get notifications for a user with pagination.
     */
    public function getUserNotifications($userId, $perPage = 20)
    {
        return Notification::where('user_id', $userId)
            ->with(['post', 'triggeredBy', 'notifiable'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get unread notifications count for a user.
     */
    public function getUnreadCount($userId)
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Delete old notifications (older than 30 days).
     */
    public function cleanupOldNotifications()
    {
        return Notification::where('created_at', '<', now()->subDays(30))->delete();
    }
}
