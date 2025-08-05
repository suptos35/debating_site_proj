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
        Schema::table('references', function (Blueprint $table) {
            //
        $table->boolean('is_valid')->default(false);
        $table->boolean('is_reputable')->default(false);
        $table->boolean('is_relevant')->default(false);
        $table->float('similarity_score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('references', function (Blueprint $table) {
            //
            $table->dropColumn(['is_valid', 'is_reputable', 'is_relevant', 'similarity_score']);
        });
    }
};
