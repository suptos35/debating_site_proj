<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->boot();

// Update posts with meaningful content for testing
$updates = [
    1 => "Climate change is causing global temperatures to rise rapidly due to increased greenhouse gas emissions",
    2 => "The war in Ukraine has significant geopolitical implications for Eastern Europe and global security"
];

foreach ($updates as $postId => $content) {
    $post = App\Models\Post::find($postId);
    if ($post) {
        $post->content = $content;
        $post->save();
        echo "Updated post {$postId}: {$content}\n";
    }
}

echo "\nNow run: php artisan references:check-ai --force\n";
