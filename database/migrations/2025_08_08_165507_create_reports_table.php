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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Who reported
            $table->string('reportable_type'); // 'App\Models\Post' or 'App\Models\Reference'
            $table->unsignedBigInteger('reportable_id'); // ID of reported item
            $table->string('reason'); // 'spam', 'abuse', 'misinfo', 'irrelevant', 'contradiction', 'other'
            $table->text('details')->nullable(); // Additional details from reporter
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who reviewed
            $table->timestamp('reviewed_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index(['reportable_type', 'reportable_id']);
            $table->index(['status', 'created_at']);
            $table->unique(['user_id', 'reportable_type', 'reportable_id']); // Prevent duplicate reports from same user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
