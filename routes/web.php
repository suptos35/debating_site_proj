<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReferenceController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/user/{user}', function (User $user) {
    //posts by user where parent_id is null
    $posts = $user->posts()->whereNull('parent_id')->with('categories', 'user')->get();


    $type = 'User';
    $name = $user->username;
    return view('filter_post', ['user' => $user, 'posts' => $posts, 'type' => $type, 'name' => $name]);
});

Route::get('/catagory/{catagory}', function (Category $catagory) {
    //posts by catagory where parent_id is null
    $posts = $catagory->posts()->whereNull('parent_id')->with('catagory', 'user')->get();

    $type = 'Catagory';
    $name = $catagory->name;
    return view('filter_post', ['catagory' => $catagory, 'posts' => $posts, 'type' => $type, 'name' => $name]);
});

Route::get('/index', function () {
    $posts = App\Models\Post::whereNull('parent_id')->get();
    return view('index', ['posts' => $posts]);

});

Route::get('/post/{post}', function (Post $post) {
    $pros = $post->pros;
    $cons = $post->cons;
    return view('points', ['post' => $post, 'pros' => $pros, 'cons' => $cons]);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::post('/arguments', [PostController::class, 'storeArgument'])->name('arguments.store')->middleware('auth');
Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

Route::post('/posts/{post}/references', [ReferenceController::class, 'store'])->middleware('auth')->name('references.store');
Route::delete('/references/{reference}', [ReferenceController::class, 'destroy'])->middleware('auth')->name('references.delete');

require __DIR__.'/auth.php';
