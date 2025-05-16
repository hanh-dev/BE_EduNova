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
        Schema::create('in_class_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('week_id')->constrained('weeks')->onDelete('cascade');
            $table->date('date');
            $table->string('skill_module');
            $table->text('lesson_summary');
            $table->unsignedTinyInteger('self_assessment');
            $table->text('difficulties');
            $table->text('improvement_plan');
            $table->boolean('problem_solved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_class_journals');
    }
};
