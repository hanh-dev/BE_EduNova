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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Gọn hơn & đúng chuẩn
            $table->string('course');
            $table->text('goals'); // Đổi từ string -> text vì nội dung có thể dài
            $table->text('courseExpectations');
            $table->text('teacherExpectations');
            $table->text('selfExpectations');
            $table->date('dueDate');
            $table->enum('completeStatus', ['doing', 'done'])->default('doing'); // Thêm dòng này đúng với validate
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
