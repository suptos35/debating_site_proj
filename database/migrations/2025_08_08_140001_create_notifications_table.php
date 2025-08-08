<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who gets the notification
            $table->string('type'); // 'new_post_by_user', 'new_post_in_category'
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // The new post
            $table->foreignId('triggered_by_user_id')->constrained('users')->onDelete('cascade'); // Who created the post
            $table->string('notifiable_type')->nullable(); // 'App\Models\User' or 'App\Models\Category'
            $table->unsignedBigInteger('notifiable_id')->nullable(); // ID of followed user/category
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'is_read']);
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
