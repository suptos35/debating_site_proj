<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Poll;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch posts where parent_id is NULL, along with categories and user, ordered by latest first
        $posts = Post::whereNull('parent_id')
            ->with('categories', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch all categories for the main navigation
        $categories = Category::limit(9)->get();

        // Get the most popular categories by view count
        $viewService = new \App\Services\ViewService();
        $popularCategories = Category::withCount('posts')->get()
            ->map(function($category) use ($viewService) {
                $category->view_count = $viewService->getCategoryViewCount($category);
                return $category;
            })
            ->sortByDesc('view_count')
            ->take(4);

        // Get the most popular writers by view count
        $popularWriters = \App\Models\User::whereHas('posts', function($query) {
                $query->whereNull('parent_id');
            })
            ->withSum('viewsAsWriter as total_views', 'view_count')
            ->orderByDesc('total_views')
            ->take(4)
            ->get();

        // Get polls for display
        $polls = Poll::with(['options', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('posts', 'categories', 'polls', 'popularCategories', 'popularWriters'));
    }
}

