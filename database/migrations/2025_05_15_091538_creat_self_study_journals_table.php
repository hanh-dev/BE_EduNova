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
        Schema::create('self_study_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('week_id')->constrained('weeks')->onDelete('cascade');
            $table->date('date');
            $table->string('skill_module');
            $table->text('lesson_summary');
            $table->integer('time_allocation');
            $table->text('learning_resources');
            $table->text('learning_activities');
            $table->unsignedTinyInteger('concentration');
            $table->text('follow_plan');
            $table->text('evaluation');
            $table->text('reinforcement');
            $table->text('notes')->nullable();
            $table->enum('status', ['inprogress', 'done', 'cancel'])->default('inprogress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_study_journals');
    }
};
