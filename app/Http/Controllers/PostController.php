<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|max:1000',
            'content' => 'required',
            'categories' => 'array|nullable',
        ]);

        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'parent_id' => null,
            'type' => null,
            'image_url' => null,
        ]);

        // Attach categories (if any were selected)
        if ($request->has('categories') && is_array($request->categories)) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function storeArgument(Request $request)
{
    $request->validate([
        'content' => 'required',
        'parent_id' => 'required|exists:posts,id',
        'type' => 'required|in:pro,con',
    ]);

    // Create the argument post
    $post = Post::create([
        'title' => null, // No title for arguments
        'excerpt' => null,
        'content' => $request->content,
        'parent_id' => $request->parent_id,
        'user_id' => Auth::id(),
        'type' => $request->type,
        'image_url' => null,
    ]);

    // Redirect back to the parent post
    return redirect()->back()->with('success', 'Your argument has been posted!');
}
}
