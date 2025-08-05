<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DevController extends Controller
{
    public function __construct()
    {
        // Only allow in development environment
        if (!app()->environment('local')) {
            abort(404);
        }
    }

    /**
     * Show development testing dashboard
     */
    public function dashboard()
    {
        $users = User::all();
        $posts = Post::whereNull('parent_id')->with('user')->latest()->take(10)->get();
        $categories = Category::all();

        return view('dev.dashboard', compact('users', 'posts', 'categories'));
    }

    /**
     * Quick login as any user
     */
    public function loginAs(User $user)
    {
        Auth::login($user);
        return redirect('/')->with('success', "Logged in as {$user->name}");
    }

    /**
     * Create test user with known password
     */
    public function createUser(Request $request)
    {
        $username = $request->username ?? 'testuser' . rand(1000, 9999);
        $password = $request->password ?? 'password';

        $user = User::create([
            'name' => $request->name ?? 'Test User ' . rand(100, 999),
            'username' => $username,
            'email' => $username . '@test.com',
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        return redirect()->back()->with('success', "Created user: {$user->username} (password: {$password})");
    }

    /**
     * Create sample post
     */
    public function createPost(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Must be logged in to create posts');
        }

        $titles = [
            'Should AI replace human workers?',
            'Is climate change the biggest threat to humanity?',
            'Should social media be regulated by governments?',
            'Is universal basic income a good idea?',
            'Should genetic engineering be allowed in humans?',
            'Is privacy dead in the digital age?',
            'Should cryptocurrency replace traditional money?',
            'Is remote work better than office work?',
        ];

        $contents = [
            'This is a sample discussion post created for testing purposes. Feel free to add your arguments!',
            'What are your thoughts on this important topic? Let\'s have a structured debate.',
            'This controversial topic deserves careful consideration from multiple perspectives.',
            'The implications of this issue affect us all. What\'s your stance?',
        ];

        $post = Post::create([
            'title' => $titles[array_rand($titles)],
            'excerpt' => 'Test post created via dev tools',
            'content' => $contents[array_rand($contents)],
            'user_id' => Auth::id(),
            'parent_id' => null,
            'type' => null,
        ]);

        // Attach random categories
        if (Category::count() > 0) {
            $randomCategories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->categories()->attach($randomCategories);
        }

        return redirect()->back()->with('success', "Created post: {$post->title}");
    }

    /**
     * Create sample arguments for a post
     */
    public function createArguments(Post $post)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Must be logged in to create arguments');
        }

        $proArguments = [
            'This approach would lead to significant economic benefits.',
            'Research shows positive outcomes in similar cases.',
            'The long-term advantages outweigh short-term costs.',
            'This solution addresses the root cause of the problem.',
        ];

        $conArguments = [
            'The potential risks are too high to ignore.',
            'There are serious ethical concerns with this approach.',
            'The evidence doesn\'t support this conclusion.',
            'This would create more problems than it solves.',
        ];

        // Create 2-3 pro arguments
        for ($i = 0; $i < rand(2, 3); $i++) {
            Post::create([
                'title' => null,
                'excerpt' => null,
                'content' => $proArguments[array_rand($proArguments)],
                'user_id' => Auth::id(),
                'parent_id' => $post->id,
                'type' => 'pro',
            ]);
        }

        // Create 2-3 con arguments
        for ($i = 0; $i < rand(2, 3); $i++) {
            Post::create([
                'title' => null,
                'excerpt' => null,
                'content' => $conArguments[array_rand($conArguments)],
                'user_id' => Auth::id(),
                'parent_id' => $post->id,
                'type' => 'con',
            ]);
        }

        return redirect()->back()->with('success', "Created arguments for: {$post->title}");
    }

    /**
     * Create sample poll
     */
    public function createPoll(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Must be logged in to create polls');
        }

        $questions = [
            'What\'s your favorite programming language?',
            'Which is better for productivity?',
            'What\'s the most important skill for developers?',
            'Which technology trend excites you most?',
        ];

        $options = [
            ['PHP', 'JavaScript', 'Python', 'Java'],
            ['Remote Work', 'Hybrid Work', 'Office Work'],
            ['Problem Solving', 'Communication', 'Technical Skills', 'Creativity'],
            ['AI/ML', 'Blockchain', 'IoT', 'Quantum Computing'],
        ];

        $questionIndex = array_rand($questions);

        $poll = Poll::create([
            'question' => $questions[$questionIndex],
            'user_id' => Auth::id(),
            'multiple_choice' => rand(0, 1),
            'expires_at' => now()->addDays(rand(7, 30)),
        ]);

        foreach ($options[$questionIndex] as $option) {
            PollOption::create([
                'poll_id' => $poll->id,
                'option_text' => $option,
            ]);
        }

        return redirect()->back()->with('success', "Created poll: {$poll->question}");
    }

    /**
     * Reset all test data
     */
    public function resetData()
    {
        // Only delete test users (those with @test.com emails)
        User::where('email', 'like', '%@test.com')->delete();

        return redirect()->back()->with('success', 'Reset test data');
    }

    /**
     * Logout current user
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out');
    }
}
