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

        $users = User::factory(15)->create();
        $categories = Category::factory(10)->create();
        Post::factory(10)->create()->each(function ($post) use ($users, $categories) {
            $post->update(['user_id' => $users->random()->id]); // Assign random user

            // Attach up to 3 random categories
            $post->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

            // Create child posts
            Post::factory(4)->create([
                'parent_id' => $post->id,
                'user_id' => $users->random()->id,
                'excerpt' => null,
            ])->each(function ($childPost) use ($users, $categories) {
                $childPost->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

                // Create grandchild posts
                Post::factory(2)->create([
                    'parent_id' => $childPost->id,
                    'user_id' => $users->random()->id,
                    'excerpt' => null,
                ])->each(function ($grandChildPost) use ($categories) {
                    $grandChildPost->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
                });
            });
        });


    }
}
