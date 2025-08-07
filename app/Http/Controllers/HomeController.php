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

        // Fetch the first 9 categories
        $categories = Category::limit(9)->get();

        // Get polls for display
        $polls = Poll::with(['options', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('posts', 'categories', 'polls'));
    }
}

