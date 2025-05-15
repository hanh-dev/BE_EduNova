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
        Schema::create('self_studies', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('skill_module');
            $table->text('my_lesson');
            $table->string('time_allocation');
            $table->text('learning_resources');
            $table->text('learning_activities');
            $table->enum('concentration', ['Yes', 'No', 'Not sure']);
            $table->text('plan_follow_plan');
            $table->string('evaluation'); 
            $table->text('reinforcing_learning');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selfstudy');
    }
};
