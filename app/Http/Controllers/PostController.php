<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function edit(Post $post)
    {
        // Check if user owns the post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'You can only edit your own posts.');
        }

        $categories = \App\Models\Category::all();
        $postCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'postCategories'));
    }

    public function update(Request $request, Post $post)
    {
        // Check if user owns the post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'You can only edit your own posts.');
        }

        try {
            if ($post->parent_id === null) {
                // Main post - validate all fields
                $validated = $request->validate([
                    'title' => 'required|max:255',
                    'excerpt' => 'nullable|max:1000',
                    'content' => 'required',
                    'categories' => 'array|nullable',
                ]);

                // Update the post
                $post->update([
                    'title' => $validated['title'],
                    'excerpt' => $validated['excerpt'],
                    'content' => $validated['content'],
                ]);

                // Sync categories
                if ($request->has('categories') && is_array($request->categories)) {
                    $post->categories()->sync($request->categories);
                } else {
                    $post->categories()->detach();
                }

                return redirect('/post/' . $post->id)->with('success', 'Discussion updated successfully!');

            } else {
                // Argument - only validate content
                $validated = $request->validate([
                    'content' => 'required',
                ]);

                $post->update([
                    'content' => $validated['content'],
                ]);

                return redirect('/post/' . $post->parent_id)->with('success', 'Argument updated successfully!');
            }

        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'There was an error updating your post. Please try again.');
        }
    }

    public function destroy(Post $post)
    {
        // Check if user owns the post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'You can only delete your own posts.');
        }

        // Store the parent_id for redirect logic
        $parentId = $post->parent_id;

        // Delete the post (this will cascade delete related data due to foreign key constraints)
        $post->delete();

        if ($parentId) {
            // If it was an argument, redirect back to the parent discussion
            return redirect()->back()->with('success', 'Your argument has been deleted.');
        } else {
            // If it was a main post, redirect to home
            return redirect('/')->with('success', 'Discussion deleted successfully.');
        }
    }
}
