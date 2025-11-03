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
            $table->string('type'); // 'maintenance_request', 'work_order'
            $table->string('title');
            $table->text('message');
            $table->unsignedBigInteger('user_id'); // recipient
            $table->unsignedBigInteger('sender_id')->nullable(); // who triggered the notification
            $table->unsignedBigInteger('related_id')->nullable(); // maintenance_request_id or work_order_id
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sender_id')->references('id')->on('users');
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
