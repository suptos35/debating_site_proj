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
            $table->text('ai_analysis')->nullable()->after('similarity_score');
            $table->boolean('supports_post')->nullable()->after('ai_analysis');
            $table->decimal('confidence_score', 3, 2)->nullable()->after('supports_post');
            $table->timestamp('last_checked_at')->nullable()->after('confidence_score');
            $table->text('content_extracted')->nullable()->after('last_checked_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropColumn(['ai_analysis', 'supports_post', 'confidence_score', 'last_checked_at', 'content_extracted']);
        });
    }
};
