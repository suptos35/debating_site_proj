<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users with known passwords
        $testUsers = [
            ['name' => 'Alice Johnson', 'username' => 'alice', 'email' => 'alice@test.com'],
            ['name' => 'Bob Smith', 'username' => 'bob', 'email' => 'bob@test.com'],
            ['name' => 'Charlie Brown', 'username' => 'charlie', 'email' => 'charlie@test.com'],
            ['name' => 'Diana Prince', 'username' => 'diana', 'email' => 'diana@test.com'],
            ['name' => 'Eve Wilson', 'username' => 'eve', 'email' => 'eve@test.com'],
        ];

        $createdTestUsers = collect();
        foreach ($testUsers as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => bcrypt('password'), // All test users have password: "password"
                'email_verified_at' => now(),
            ]);
            $createdTestUsers->push($user);
        }

        // Create additional random users
        $randomUsers = User::factory(10)->create();
        $allUsers = $createdTestUsers->merge($randomUsers);

        // Create categories
        $categories = Category::factory(10)->create();

        // Create posts with arguments
        Post::factory(10)->create()->each(function ($post) use ($allUsers, $categories) {
            $post->update(['user_id' => $allUsers->random()->id]); // Assign random user

            // Attach up to 3 random categories
            $post->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

            // Create child posts (arguments)
            Post::factory(4)->create([
                'parent_id' => $post->id,
                'user_id' => $allUsers->random()->id,
                'excerpt' => null,
                'type' => collect(['pro', 'con'])->random(),
            ])->each(function ($childPost) use ($categories, $allUsers) {
                $childPost->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

                // Create grandchild posts (responses to arguments)
                Post::factory(2)->create([
                    'parent_id' => $childPost->id,
                    'user_id' => $allUsers->random()->id,
                    'excerpt' => null,
                    'type' => collect(['pro', 'con'])->random(),
                ])->each(function ($grandChildPost) use ($categories) {
                    $grandChildPost->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
                });
            });
        });

        $this->command->info('🎉 Database seeded successfully!');
        $this->command->info('📝 Test users created with password "password":');
        foreach ($testUsers as $user) {
            $this->command->info("   • {$user['username']} ({$user['email']})");
        }
    }
}
