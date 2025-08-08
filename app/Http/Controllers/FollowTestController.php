<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FollowTestController extends Controller
{
    /**
     * Test endpoint to verify follow functionality.
     */
    public function testFollow(): JsonResponse
    {
        // Get first user and category for testing
        $user = User::first();
        $category = Category::first();

        if (!$user || !$category) {
            return response()->json([
                'error' => 'No users or categories found. Please seed the database first.'
            ]);
        }

        // Get current counts
        $userFollowers = $user->getFollowersCount();
        $categoryFollowers = $category->getFollowersCount();

        return response()->json([
            'status' => 'Backend is working!',
            'models_exist' => [
                'Follow' => class_exists('App\Models\Follow'),
                'Notification' => class_exists('App\Models\Notification'),
            ],
            'relationships_working' => [
                'user_followers_method' => method_exists($user, 'getFollowersCount'),
                'category_followers_method' => method_exists($category, 'getFollowersCount'),
                'user_follow_method' => method_exists($user, 'follow'),
            ],
            'current_counts' => [
                'user_followers' => $userFollowers,
                'category_followers' => $categoryFollowers,
                'total_follows' => Follow::count(),
                'total_notifications' => Notification::count(),
            ],
            'test_user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'test_category' => [
                'id' => $category->id,
                'name' => $category->name,
            ]
        ]);
    }

    /**
     * Test creating a post and checking if notifications are generated.
     */
    public function testNotifications(): JsonResponse
    {
        // Get a user to create a post
        $user = User::first();
        $category = Category::first();

        if (!$user || !$category) {
            return response()->json([
                'error' => 'No users or categories found. Please seed the database first.'
            ]);
        }

        // Create a test post
        $post = Post::create([
            'title' => 'Test Post for Notifications',
            'content' => 'This is a test post to verify notification functionality.',
            'user_id' => $user->id,
        ]);

        // Attach the category
        $post->categories()->attach($category->id);

        // Count notifications created
        $notificationsCount = Notification::where('post_id', $post->id)->count();

        return response()->json([
            'status' => 'Notification test completed',
            'post_created' => [
                'id' => $post->id,
                'title' => $post->title,
                'author' => $user->name,
            ],
            'category_attached' => $category->name,
            'notifications_created' => $notificationsCount,
            'total_notifications' => Notification::count(),
        ]);
    }

    /**
     * Get system stats for debugging.
     */
    public function getStats(): JsonResponse
    {
        return response()->json([
            'database_counts' => [
                'users' => User::count(),
                'categories' => Category::count(),
                'posts' => Post::count(),
                'follows' => Follow::count(),
                'notifications' => Notification::count(),
            ],
            'follow_stats' => [
                'user_follows' => Follow::where('followable_type', 'App\Models\User')->count(),
                'category_follows' => Follow::where('followable_type', 'App\Models\Category')->count(),
            ],
            'notification_stats' => [
                'user_notifications' => Notification::where('type', 'new_post_by_user')->count(),
                'category_notifications' => Notification::where('type', 'new_post_in_category')->count(),
                'unread_notifications' => Notification::where('is_read', false)->count(),
            ],
        ]);
    }
}
