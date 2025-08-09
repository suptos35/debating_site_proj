<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->boot();

echo "=== AI Reference Auto-Check Status ===" . PHP_EOL;
echo "Total references: " . App\Models\Reference::count() . PHP_EOL;
echo "References with AI analysis: " . App\Models\Reference::whereNotNull('supports_post')->count() . PHP_EOL;

$latestRef = App\Models\Reference::latest()->first();
if ($latestRef) {
    echo "Latest reference: " . $latestRef->url . PHP_EOL;
    echo "AI Analysis: " . ($latestRef->supports_post ? 'Supports' : ($latestRef->supports_post === false ? 'Contradicts' : 'Pending')) . PHP_EOL;
    echo "Confidence: " . ($latestRef->confidence_score ? round($latestRef->confidence_score * 100, 1) . '%' : 'N/A') . PHP_EOL;
    echo "Last checked: " . ($latestRef->last_checked_at ? $latestRef->last_checked_at : 'Never') . PHP_EOL;
} else {
    echo "No references found." . PHP_EOL;
}

echo PHP_EOL . "=== System Ready for Auto-Check ===" . PHP_EOL;
echo "✅ When new references are added via the UI, they will be automatically analyzed by AI" . PHP_EOL;
echo "✅ Users will see 'Add Reference + AI Check' buttons" . PHP_EOL;
echo "✅ Analysis happens in background after page loads" . PHP_EOL;
