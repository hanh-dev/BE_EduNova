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
        Schema::create('weekgoal', function (Blueprint $table) {
            $table->id();
            $table->string('goal'); 
            $table->date('due_date'); 
            $table->enum('complete_status', ['doing', 'done'])->default('doing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeksoal');
    }
};
