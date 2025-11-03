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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('assigned_to_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('generated_by_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('source_task_id')->nullable()->constrained('maintenance_tasks')->onDelete('cascade');
            $table->foreignId('source_request_id')->nullable()->constrained('maintenance_requests')->onDelete('cascade');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled']);
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->string('title');
            $table->text('description');
            $table->timestamp('scheduled_start_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
