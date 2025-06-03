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
        Schema::create('tag_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('goal_id');
            $table->text('message');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_teacher');
    }
};