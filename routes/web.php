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
use App\Http\Controllers\PollController;
use App\Http\Controllers\DevController;

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
    $categories = \App\Models\Category::all();
    return view('points', ['post' => $post, 'pros' => $pros, 'cons' => $cons, 'categories' => $categories]);
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
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::post('/arguments', [PostController::class, 'storeArgument'])->name('arguments.store')->middleware('auth');
Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

Route::post('/posts/{post}/references', [ReferenceController::class, 'store'])->middleware('auth')->name('references.store');
Route::delete('/references/{reference}', [ReferenceController::class, 'destroy'])->middleware('auth')->name('references.delete');

// Poll routes
Route::get('/polls', [PollController::class, 'index'])->name('polls.index');
Route::post('/polls', [PollController::class, 'store'])->middleware('auth')->name('polls.store');
Route::post('/polls/{poll}/vote', [PollController::class, 'vote'])->middleware('auth')->name('polls.vote');
Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->middleware('auth')->name('polls.destroy');

// Development routes (only work in local environment)
if (app()->environment('local')) {
    Route::get('/dev', [DevController::class, 'dashboard'])->name('dev.dashboard');
    Route::post('/dev/create-user', [DevController::class, 'createUser'])->name('dev.create-user');
    Route::post('/dev/login-as/{user}', [DevController::class, 'loginAs'])->name('dev.login-as');
    Route::post('/dev/create-post', [DevController::class, 'createPost'])->name('dev.create-post');
    Route::post('/dev/create-arguments/{post}', [DevController::class, 'createArguments'])->name('dev.create-arguments');
    Route::post('/dev/create-poll', [DevController::class, 'createPoll'])->name('dev.create-poll');
    Route::post('/dev/reset-data', [DevController::class, 'resetData'])->name('dev.reset-data');
    Route::post('/dev/logout', [DevController::class, 'logout'])->name('dev.logout');
}

require __DIR__.'/auth.php';
