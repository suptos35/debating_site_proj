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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('followable_type'); // 'App\Models\User' or 'App\Models\Category'
            $table->unsignedBigInteger('followable_id');
            $table->timestamps();

            $table->unique(['user_id', 'followable_type', 'followable_id']);
            $table->index(['followable_type', 'followable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
