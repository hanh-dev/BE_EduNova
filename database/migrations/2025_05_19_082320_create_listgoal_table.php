<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('listgoal', function (Blueprint $table) {
            $table->id(); // tạo cột id auto-increment (primary key)
            $table->text('goal_text'); // cột text chứa mục tiêu
            $table->boolean('is_checked')->default(false); // cột checkbox đánh dấu mục tiêu hoàn thành
            $table->timestamps(); // tạo 2 cột created_at và updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listgoal');
    }
};
