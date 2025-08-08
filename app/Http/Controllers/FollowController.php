<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    /**
     * Follow a user.
     */
    public function followUser(User $user): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to follow users'], 401);
        }

        if (Auth::id() === $user->id) {
            return response()->json(['error' => 'You cannot follow yourself'], 400);
        }

        $followed = Auth::user()->follow($user);

        return response()->json([
            'success' => $followed !== false,
            'message' => $followed ? 'User followed successfully' : 'Already following this user',
            'followers_count' => $user->getFollowersCount(),
            'is_following' => Auth::user()->isFollowing($user)
        ]);
    }

    /**
     * Unfollow a user.
     */
    public function unfollowUser(User $user): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $unfollowed = Auth::user()->unfollow($user);

        return response()->json([
            'success' => $unfollowed > 0,
            'message' => $unfollowed > 0 ? 'User unfollowed successfully' : 'Not following this user',
            'followers_count' => $user->getFollowersCount(),
            'is_following' => Auth::user()->isFollowing($user)
        ]);
    }

    /**
     * Follow a category.
     */
    public function followCategory(Category $category): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to follow categories'], 401);
        }

        $followed = Auth::user()->follow($category);

        return response()->json([
            'success' => $followed !== false,
            'message' => $followed ? 'Category followed successfully' : 'Already following this category',
            'followers_count' => $category->getFollowersCount(),
            'is_following' => Auth::user()->isFollowing($category)
        ]);
    }

    /**
     * Unfollow a category.
     */
    public function unfollowCategory(Category $category): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $unfollowed = Auth::user()->unfollow($category);

        return response()->json([
            'success' => $unfollowed > 0,
            'message' => $unfollowed > 0 ? 'Category unfollowed successfully' : 'Not following this category',
            'followers_count' => $category->getFollowersCount(),
            'is_following' => Auth::user()->isFollowing($category)
        ]);
    }

    /**
     * Get user's followed categories.
     */
    public function getFollowedCategories(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $categories = Auth::user()->followedCategories()->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Get user's followed users.
     */
    public function getFollowedUsers(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $users = Auth::user()->followedUsers()->get();

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    /**
     * Get followers of a user.
     */
    public function getUserFollowers(User $user): JsonResponse
    {
        $followers = $user->followers()->with('user')->get()->pluck('user');

        return response()->json([
            'success' => true,
            'followers' => $followers,
            'count' => $followers->count()
        ]);
    }

    /**
     * Get followers of a category.
     */
    public function getCategoryFollowers(Category $category): JsonResponse
    {
        $followers = $category->followers()->with('user')->get()->pluck('user');

        return response()->json([
            'success' => true,
            'followers' => $followers,
            'count' => $followers->count()
        ]);
    }
}
