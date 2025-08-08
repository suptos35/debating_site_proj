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
    //posts by catagory where parent_id is null (only main discussions)
    $posts = $catagory->posts()->whereNull('parent_id')->with('categories', 'user')->get();

    $type = 'Catagory';
    $name = $catagory->name;
    // Get discussions count (only parent posts)
    $discussionsCount = $catagory->posts()->whereNull('parent_id')->count();
    return view('filter_post', [
        'catagory' => $catagory,
        'posts' => $posts,
        'type' => $type,
        'name' => $name,
        'discussionsCount' => $discussionsCount
    ]);
});

Route::get('/index', function () {
    $posts = App\Models\Post::whereNull('parent_id')->get();
    return view('index', ['posts' => $posts]);

});

Route::get('/post/{post}', function (Post $post, Request $request) {
    // Record the view
    $viewService = new \App\Services\ViewService();
    $viewService->recordView($post, $request);

    $pros = $post->pros;
    $cons = $post->cons;
    $categories = \App\Models\Category::all();

    // Get view count
    $viewCount = $viewService->getViewCount($post);

    return view('points', [
        'post' => $post,
        'pros' => $pros,
        'cons' => $cons,
        'categories' => $categories,
        'viewCount' => $viewCount
    ]);
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
        // Get categories and count only parent posts (with null parent_id)
        $categoryData = Category::withCount(['posts' => function($query) {
            $query->whereNull('parent_id');
        }])->get();

        // Initialize view service to calculate views for each category
        $viewService = new \App\Services\ViewService();

        // Process categories for the presentation view
        $categoriesForView = $categoryData->map(function ($category) use ($viewService) {
            // Calculate total views for this category
            $viewCount = $viewService->getCategoryViewCount($category);

            return [
                'id' => $category->id, // Include the ID
                'name' => $category->name,
                'icon' => 'fas fa-folder', // Default icon
                'bg_color' => 'bg-gray-600', // Default background color
                'description' => $category->description ?? 'No description available.',
                'discussions_count' => $category->posts_count, // Now only counts parent posts
                'view_count' => $viewCount, // Add view count
                'weekly_posts' => rand(1, 20), // Replace with actual logic if you track weekly posts
                'top_writers' => [
                    ['initials' => 'AB', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                    ['initials' => 'CD', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                ],
            ];
        });

        // Pass both the original category objects (for the main_layout) and the presentation data
        return view('presentation.categories', [
            'categories' => $categoryData, // Original objects for main_layout dropdown
            'categoriesForView' => $categoriesForView // Processed array data for the presentation view
        ]);
    })->name('presentation.categories');

        Route::get('/presentation/writers', function () {
        // Get users who have published posts (where parent_id is null)
        $users = User::whereHas('posts', function($query) {
            $query->whereNull('parent_id');
        })
        ->withCount(['posts' => function($query) {
            $query->whereNull('parent_id'); // Only count parent posts
        }])
        ->withSum('posts', 'like_count') // Sum all likes on their posts
        ->get();

        // Format writers for the view with additional hardcoded metadata
        $writers = $users->map(function($user) {
            // Generate initials from name
            $nameParts = explode(' ', $user->name);
            $initials = '';
            if (count($nameParts) >= 1) {
                $initials .= strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) >= 2) {
                    $initials .= strtoupper(substr($nameParts[1], 0, 1));
                }
            }

            // Determine avatar class and text class based on user ID
            $avatarClasses = ['bg-blue-100', 'bg-green-100', 'bg-purple-100', 'bg-yellow-100', 'bg-pink-100', 'bg-indigo-100'];
            $textClasses = ['text-blue-600', 'text-green-600', 'text-purple-600', 'text-yellow-600', 'text-pink-600', 'text-indigo-600'];
            $avatarIndex = $user->id % count($avatarClasses);

            // Generate random specialties for demonstration
            $allSpecialties = [
                'Climate Science', 'Renewable Energy', 'AI Ethics', 'Tech Policy',
                'Health Research', 'Education', 'Psychology', 'Economics',
                'Political Science', 'Public Policy', 'History', 'Sociology'
            ];
            $specialtyCount = min(3, 1 + ($user->id % 3)); // 1-3 specialties based on ID
            $specialties = [];
            for ($i = 0; $i < $specialtyCount; $i++) {
                $specialties[] = $allSpecialties[($user->id + $i) % count($allSpecialties)];
            }

            // Generate a slug from the name
            $slug = strtolower(str_replace(' ', '-', $user->name));

            return [
                'id' => $user->id,
                'name' => $user->name,
                'slug' => $slug,
                'title' => $user->role ?? 'Community Member', // Use role if available or default
                'initials' => $initials,
                'avatar_class' => $avatarClasses[$avatarIndex],
                'text_class' => $textClasses[$avatarIndex],
                'bio' => 'Contributor with expertise in various topics.', // Hardcoded bio
                'posts_count' => $user->posts_count ?? 0,
                'total_likes' => $user->posts_sum_like_count ?? 0,
                'followers' => rand(50, 3000), // Random follower count for demo
                'specialties' => $specialties,
                'last_active' => rand(1, 24) . ' hours ago', // Random last active time
                'rating' => number_format(3.5 + (mt_rand(0, 15) / 10), 1) // Random rating between 3.5-5.0
            ];
        });

        // Pass both the original user objects (for the main_layout) and the processed writers data
        return view('presentation.writers', [
            'users' => $users, // Original objects for main_layout if needed
            'writers' => $writers // Processed array data for the presentation view
        ]);
    })->name('presentation.writers');

    Route::get('/presentation/category/{category}', function ($category, Request $request) {
        // Try to find the category by ID first, then by name if that fails
        $categoryModel = Category::find($category);

        if (!$categoryModel) {
            // If not found by ID, try finding by name
            $categoryModel = Category::where('name', $category)->first();
        }

        if (!$categoryModel) {
            abort(404);
        }

        // Count only parent posts (with null parent_id)
        $discussionsCount = $categoryModel->posts()->whereNull('parent_id')->count();

        // Get category view count
        $viewService = new \App\Services\ViewService();
        $categoryViewCount = $viewService->getCategoryViewCount($categoryModel);

        // We'll use the post_card component which handles all the formatting
        // No need for complex formatting logic here anymore

        // Get all categories for the main_layout component
        $allCategories = Category::all();

        return view('presentation.category', [
            'category' => $category,
            'category_model' => $categoryModel,
            'categories' => $allCategories, // Pass all categories for the main_layout component
            'discussionsCount' => $discussionsCount,
            'viewCount' => $categoryViewCount
        ]);
    })->name('presentation.category');

    Route::get('/presentation/writer/{slug}', function ($slug) {
        // Find the user by matching slug (which is derived from the name)
        $user = User::whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower($slug)])
            ->withCount(['posts' => function($query) {
                $query->whereNull('parent_id'); // Only count parent posts
            }])
            ->withSum('posts', 'like_count') // Sum all likes on their posts
            ->first();

        if (!$user) {
            abort(404);
        }

        // Generate writer metadata similar to writers list
        $nameParts = explode(' ', $user->name);
        $initials = '';
        if (count($nameParts) >= 1) {
            $initials .= strtoupper(substr($nameParts[0], 0, 1));
            if (count($nameParts) >= 2) {
                $initials .= strtoupper(substr($nameParts[1], 0, 1));
            }
        }

        // Determine avatar class and text class based on user ID
        $avatarClasses = ['bg-blue-100', 'bg-green-100', 'bg-purple-100', 'bg-yellow-100', 'bg-pink-100', 'bg-indigo-100'];
        $textClasses = ['text-blue-600', 'text-green-600', 'text-purple-600', 'text-yellow-600', 'text-pink-600', 'text-indigo-600'];
        $avatarIndex = $user->id % count($avatarClasses);

        // Generate random specialties for demonstration
        $allSpecialties = [
            'Climate Science', 'Renewable Energy', 'AI Ethics', 'Tech Policy',
            'Health Research', 'Education', 'Psychology', 'Economics',
            'Political Science', 'Public Policy', 'History', 'Sociology'
        ];
        $specialtyCount = min(3, 1 + ($user->id % 3)); // 1-3 specialties based on ID
        $specialties = [];
        for ($i = 0; $i < $specialtyCount; $i++) {
            $specialties[] = $allSpecialties[($user->id + $i) % count($allSpecialties)];
        }

        // Format the joined date
        $joinedDate = $user->created_at ? $user->created_at->format('F Y') : 'Unknown';

        $writer = [
            'id' => $user->id,
            'name' => $user->name,
            'slug' => $slug,
            'title' => $user->role ?? 'Community Member', // Use role if available or default
            'initials' => $initials,
            'avatar_class' => $avatarClasses[$avatarIndex],
            'text_class' => $textClasses[$avatarIndex],
            'posts_count' => $user->posts_count ?? 0,
            'total_likes' => $user->posts_sum_like_count ?? 0,
            'joined' => $joinedDate,
            'followers' => rand(50, 3000), // Random follower count for demo
            'specialties' => $specialties,
        ];

        // Get the user's posts with related data
        $dbPosts = $user->posts()
            ->whereNull('parent_id')
            ->with(['categories', 'references', 'children'])
            ->orderBy('created_at', 'desc')
            ->get();

            // Format posts for the template
        $posts = $dbPosts->map(function($post) {
            // Determine icon and gradient based on category or use default
            $icon = 'fas fa-comment';
            $gradient = 'from-gray-400 to-gray-600';

            // If post has categories, use the first one's properties
            if ($post->categories->isNotEmpty()) {
                $mainCategory = $post->categories->first();
                $categoryName = strtolower($mainCategory->name);
                if (strpos($categoryName, 'science') !== false) {
                    $icon = 'fas fa-atom';
                    $gradient = 'from-blue-400 to-blue-600';
                } elseif (strpos($categoryName, 'tech') !== false) {
                    $icon = 'fas fa-robot';
                    $gradient = 'from-purple-400 to-purple-600';
                } elseif (strpos($categoryName, 'environment') !== false || strpos($categoryName, 'nature') !== false) {
                    $icon = 'fas fa-seedling';
                    $gradient = 'from-green-400 to-green-600';
                } elseif (strpos($categoryName, 'health') !== false || strpos($categoryName, 'medical') !== false) {
                    $icon = 'fas fa-heartbeat';
                    $gradient = 'from-red-400 to-red-600';
                } elseif (strpos($categoryName, 'politic') !== false || strpos($categoryName, 'government') !== false) {
                    $icon = 'fas fa-landmark';
                    $gradient = 'from-yellow-400 to-yellow-600';
                } elseif (strpos($categoryName, 'econom') !== false || strpos($categoryName, 'financ') !== false) {
                    $icon = 'fas fa-chart-line';
                    $gradient = 'from-indigo-400 to-indigo-600';
                }
            }            // Format post date for display
            $date = $post->created_at ? $post->created_at->diffForHumans() : 'Recently';

            // Format categories for display
            $formattedCategories = $post->categories->map(function($cat) {
                $class = 'bg-gray-100 text-gray-600';

                // Use name instead of slug for category identification
                $categoryName = strtolower($cat->name);
                if (strpos($categoryName, 'science') !== false) {
                    $class = 'bg-blue-100 text-blue-600';
                } elseif (strpos($categoryName, 'tech') !== false) {
                    $class = 'bg-purple-100 text-purple-600';
                } elseif (strpos($categoryName, 'environment') !== false || strpos($categoryName, 'nature') !== false) {
                    $class = 'bg-green-100 text-green-600';
                } elseif (strpos($categoryName, 'health') !== false || strpos($categoryName, 'medical') !== false) {
                    $class = 'bg-red-100 text-red-600';
                } elseif (strpos($categoryName, 'politic') !== false || strpos($categoryName, 'government') !== false) {
                    $class = 'bg-yellow-100 text-yellow-600';
                } elseif (strpos($categoryName, 'econom') !== false || strpos($categoryName, 'financ') !== false) {
                    $class = 'bg-indigo-100 text-indigo-600';
                }

                return [
                    'name' => $cat->name,
                    'class' => $class
                ];
            })->toArray();


            return [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => $post->excerpt ?? substr(strip_tags($post->content), 0, 150) . '...',
                'date' => $date,
                'likes' => $post->like_count ?? 0,
                'comments' => $post->children->count() ?? 0,
                'references' => $post->references->count() ?? 0,
                'gradient' => $gradient,
                'icon' => $icon,
                'categories' => $formattedCategories
            ];
        })->toArray();

        // Get all categories for the main layout component
        $categories = Category::all();

        return view('presentation.writer', [
            'writer' => $writer,
            'user' => $user,
            'categories' => $categories
        ]);
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
