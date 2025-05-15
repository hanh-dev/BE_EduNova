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
        Schema::create('inclass', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('skill_module');
            $table->string('MyLesson');
            $table->enum('SelfAssesment', ['1', '2', '3']);
            $table->string('MyDifficulties');
            $table->string('MyPlan');
            $table->enum('ProblemSolved', ['Yes', 'No']);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inclass');
    }
};
