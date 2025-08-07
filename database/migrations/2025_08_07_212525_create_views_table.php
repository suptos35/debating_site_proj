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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('view_count')->default(1);
            $table->string('session_id')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
            
            // Create a unique index to prevent duplicate entries
            $table->unique(['user_id', 'post_id', 'session_id', 'ip_address'], 'view_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
