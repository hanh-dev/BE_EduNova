<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deadline_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id');
            $table->date('dueDate');
            $table->timestamps();

            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deadline_assignments');
    }
};
