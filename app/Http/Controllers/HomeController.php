<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch posts where parent_id is NULL, along with categories and user
        $posts = Post::whereNull('parent_id')->with('categories', 'user')->get();

        // Fetch the first 9 categories
        $categories = Category::limit(9)->get();

        return view('home', compact('posts', 'categories'));
    }
}

