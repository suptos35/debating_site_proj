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

// Presentation routes for UI mockups (only for local environment)
if (app()->environment('local')) {
    Route::get('/presentation', function () {
        return view('presentation.homepage');
    })->name('presentation.homepage');

    Route::get('/presentation/discussion', function () {
        return view('presentation.argument');
    })->name('presentation.argument');

    Route::get('/presentation/categories', function () {
        $categories = [
            [
                'name' => 'Science', 'slug' => 'science', 'icon' => 'fas fa-atom', 'bg_color' => 'bg-blue-600',
                'description' => 'Scientific research, discoveries, and evidence-based discussions.',
                'discussions_count' => 127, 'weekly_posts' => 8,
                'top_writers' => [
                    ['initials' => 'SC', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                    ['initials' => 'MT', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                ]
            ],
            [
                'name' => 'Technology', 'slug' => 'technology', 'icon' => 'fas fa-robot', 'bg_color' => 'bg-purple-600',
                'description' => 'AI, software, hardware, and emerging tech discussions.',
                'discussions_count' => 98, 'weekly_posts' => 12,
                'top_writers' => [
                    ['initials' => 'MR', 'bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                    ['initials' => 'AL', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'],
                ]
            ],
            [
                'name' => 'Health', 'slug' => 'health', 'icon' => 'fas fa-heartbeat', 'bg_color' => 'bg-green-600',
                'description' => 'Medical research, nutrition, and wellness topics.',
                'discussions_count' => 84, 'weekly_posts' => 6,
                'top_writers' => [
                    ['initials' => 'JP', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                    ['initials' => 'LM', 'bg' => 'bg-pink-100', 'text' => 'text-pink-600'],
                ]
            ]
        ];

        return view('presentation.categories', compact('categories'));
    })->name('presentation.categories');

    Route::get('/presentation/writers', function () {
        $writers = [
            [
                'name' => 'Dr. Sarah Chen', 'slug' => 'dr-sarah-chen', 'title' => 'Environmental Scientist',
                'initials' => 'SC', 'avatar_class' => 'bg-blue-100', 'text_class' => 'text-blue-600',
                'bio' => 'Climate researcher specializing in renewable energy systems.',
                'posts_count' => 42, 'total_likes' => 1247, 'followers' => 2834,
                'specialties' => ['Climate Science', 'Renewable Energy'], 'last_active' => '2 hours ago', 'rating' => 4.8
            ],
            [
                'name' => 'Marcus Rodriguez', 'slug' => 'marcus-rodriguez', 'title' => 'Tech Policy Analyst',
                'initials' => 'MR', 'avatar_class' => 'bg-purple-100', 'text_class' => 'text-purple-600',
                'bio' => 'Expert in AI ethics and technology regulation.',
                'posts_count' => 38, 'total_likes' => 1089, 'followers' => 2156,
                'specialties' => ['AI Ethics', 'Tech Policy'], 'last_active' => '5 hours ago', 'rating' => 4.7
            ],
            [
                'name' => 'Dr. James Park', 'slug' => 'dr-james-park', 'title' => 'Health Researcher',
                'initials' => 'JP', 'avatar_class' => 'bg-green-100', 'text_class' => 'text-green-600',
                'bio' => 'Nutrition scientist focused on dietary interventions.',
                'posts_count' => 29, 'total_likes' => 892, 'followers' => 1743,
                'specialties' => ['Nutrition', 'Public Health'], 'last_active' => '1 day ago', 'rating' => 4.9
            ]
        ];

        return view('presentation.writers', compact('writers'));
    })->name('presentation.writers');

    Route::get('/presentation/category/{category}', function ($category) {
        $posts = $category == 'science' ? [
            [
                'title' => 'Should nuclear energy be prioritized over renewable sources?',
                'excerpt' => 'With climate targets becoming increasingly urgent, the debate intensifies.',
                'author' => 'Dr. Sarah Chen', 'likes' => 23, 'comments' => 41, 'references' => 8,
                'gradient' => 'from-blue-400 to-blue-600', 'icon' => 'fas fa-atom',
                'categories' => [
                    ['name' => 'Science', 'class' => 'bg-blue-100 text-blue-600'],
                    ['name' => 'Environment', 'class' => 'bg-green-100 text-green-600']
                ]
            ]
        ] : [
            [
                'title' => 'Sample Discussion in ' . ucfirst($category),
                'excerpt' => 'This is a sample discussion.',
                'author' => 'Sample Author', 'likes' => 10, 'comments' => 15, 'references' => 3,
                'gradient' => 'from-gray-400 to-gray-600', 'icon' => 'fas fa-comment',
                'categories' => [['name' => ucfirst($category), 'class' => 'bg-gray-100 text-gray-600']]
            ]
        ];

        return view('presentation.category', compact('category', 'posts'));
    })->name('presentation.category');

    Route::get('/presentation/writer/{slug}', function ($slug) {
        $writer = $slug == 'dr-sarah-chen' ? [
            'name' => 'Dr. Sarah Chen', 'title' => 'Environmental Scientist & Climate Researcher',
            'initials' => 'SC', 'avatar_class' => 'bg-blue-100', 'text_class' => 'text-blue-600',
            'posts_count' => 42, 'total_likes' => 1247, 'joined' => 'March 2023',
            'posts' => [
                [
                    'title' => 'Should nuclear energy be prioritized over renewable sources?',
                    'excerpt' => 'With climate targets becoming increasingly urgent, the debate intensifies.',
                    'date' => '3 days ago', 'likes' => 23, 'comments' => 41, 'references' => 8,
                    'gradient' => 'from-blue-400 to-blue-600', 'icon' => 'fas fa-atom',
                    'categories' => [
                        ['name' => 'Science', 'class' => 'bg-blue-100 text-blue-600'],
                        ['name' => 'Environment', 'class' => 'bg-green-100 text-green-600']
                    ]
                ]
            ]
        ] : null;

        if (!$writer) abort(404);

        $posts = $writer['posts'];
        return view('presentation.writer', compact('writer', 'posts'));
    })->name('presentation.writer');

    Route::get('/presentation/profile', function () {
        return view('presentation.profile');
    })->name('presentation.profile');

    Route::get('/presentation/groups', function () {
        return view('presentation.groups');
    })->name('presentation.groups');

    Route::get('/presentation/admin', function () {
        return view('presentation.admin');
    })->name('presentation.admin');

    Route::get('/presentation/search', function () {
        $keyword = request('q', 'climate'); // Default to 'climate' if no search query
        return view('presentation.search', compact('keyword'));
    })->name('presentation.search');

    Route::get('/presentation/polls', function () {
        return view('presentation.polls');
    })->name('presentation.polls');
}

require __DIR__.'/auth.php';
