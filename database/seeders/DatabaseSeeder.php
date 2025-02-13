<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
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
        Post::factory(10)->create([
            'user_id' => $users->random()->id, // Assign random user
        ])->each(function ($post) use ($users) { // Pass $users into the closure
            // Create child posts
            Post::factory(4)->create([
                'user_id' => $users->random()->id, // Assign random user
                'parent_id' => $post->id, // Link to parent
                'excerpt' => null,
            ])->each(function ($childPost) use ($users) { // Pass $users into the closure
                // Create grandchild posts
                Post::factory(2)->create([
                    'user_id' => $users->random()->id, // Assign random user
                    'parent_id' => $childPost->id, // Link to child post
                    'excerpt' => null,

                ]);
            });
        });


    }
}
