<?php


namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        $request->validate([
            'url' => 'required|url',
            'description' => 'nullable|string|max:255',
        ]);
        $post->references()->create($request->only('url', 'description'));
        return back()->with('success', 'Reference added!');
    }

    public function destroy(Reference $reference)
{
    if (Auth::id() !== $reference->post->user_id) {
        abort(403);
    }
    $reference->delete();
    return back()->with('success', 'Reference deleted!');
}

}
