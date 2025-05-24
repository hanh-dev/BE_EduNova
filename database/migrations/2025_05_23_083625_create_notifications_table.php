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
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');  // người gửi tag (sinh viên)
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // người nhận tag (giáo viên)
            $table->text('content'); // nội dung có chứa tag hoặc trích đoạn
            $table->string('link')->nullable(); // link tới vị trí cụ thể trong portfolio
            $table->boolean('is_read')->default(false);
            $table->timestamps();
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
