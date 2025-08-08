<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Post;
use App\Models\Reference;
use App\Models\User;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some posts and references to report
        $posts = Post::limit(3)->get();
        $references = Reference::limit(2)->get();

        // Get some users to act as reporters (excluding admin users)
        $users = User::where('role', '!=', 'admin')->limit(5)->get();

        if ($users->isEmpty()) {
            // If no regular users exist, create some
            $users = collect([
                User::create([
                    'name' => 'John Reporter',
                    'email' => 'john@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'user'
                ]),
                User::create([
                    'name' => 'Jane Whistleblower',
                    'email' => 'jane@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'user'
                ]),
                User::create([
                    'name' => 'Bob Moderator',
                    'email' => 'bob@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'user'
                ])
            ]);
        }

        // Create reports for posts
        $reasons = ['spam', 'abuse', 'misinfo', 'irrelevant', 'contradiction', 'other'];

        foreach ($posts as $index => $post) {
            // Create 2-4 reports per post from different users
            $reportCount = rand(2, 4);

            for ($i = 0; $i < $reportCount && $i < $users->count(); $i++) {
                Report::create([
                    'user_id' => $users[$i]->id,
                    'reportable_type' => 'App\Models\Post',
                    'reportable_id' => $post->id,
                    'reason' => $reasons[array_rand($reasons)],
                    'status' => 'pending',
                    'created_at' => now()->subDays(rand(1, 7)),
                    'updated_at' => now()->subDays(rand(1, 7))
                ]);
            }
        }

        // Create reports for references
        foreach ($references as $index => $reference) {
            // Create 1-3 reports per reference from different users
            $reportCount = rand(1, 3);

            for ($i = 0; $i < $reportCount && $i < $users->count(); $i++) {
                Report::create([
                    'user_id' => $users[$i]->id,
                    'reportable_type' => 'App\Models\Reference',
                    'reportable_id' => $reference->id,
                    'reason' => $reasons[array_rand($reasons)],
                    'status' => 'pending',
                    'created_at' => now()->subDays(rand(1, 5)),
                    'updated_at' => now()->subDays(rand(1, 5))
                ]);
            }
        }

        $this->command->info('Sample reports created successfully!');
        $this->command->info('Reports for posts: ' . Report::where('reportable_type', 'App\Models\Post')->count());
        $this->command->info('Reports for references: ' . Report::where('reportable_type', 'App\Models\Reference')->count());
    }
}
