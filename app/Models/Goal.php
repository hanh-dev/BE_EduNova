<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Goal extends Model
{
    use HasFactory;

    protected $table = 'goals';

    // Các thuộc tính có thể gán giá trị đại diện cho cột trong bảng
    protected $fillable = [
        'user_id',
        'course',
        'goals',
        'courseExpectations',
        'teacherExpectations',
        'selfExpectations',
        'dueDate'
    ];

    // Quan hệ giữa Mục tiêu và Người dùng: một người dùng có nhiều mục tiêu.
    public function user()
    {
        return $this->belongsTo(User::class);  // Mỗi Goal thuộc về một User
    }

    // Phương thức lấy ngày hoàn thành (due date) với định dạng dễ đọc hơn.
    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y'); // Định dạng lại ngày
    }

    // Phương thức set lại ngày hoàn thành (due date) dưới dạng chuẩn.
    public function setDueDateAttribute($value)
    {
        $this->attributes['dueDate'] = Carbon::parse($value)->toDateString(); // Lưu lại dưới dạng chuẩn
    }

    // Phương thức lưu mục tiêu với kiểm tra.
    public function saveGoal(array $data)
    {
        // Kiểm tra nếu user_id trùng khớp và không có mục tiêu trùng
        $existingGoal = $this->where('user_id', $data['user_id'])
                             ->where('course', $data['course'])
                             ->where('dueDate', $data['dueDate'])
                             ->first();

        if ($existingGoal) {
            // Nếu mục tiêu đã tồn tại, trả về thông báo lỗi
            return response()->json(['error' => 'Goal already exists for this user and course'], 400);
        }

        // Nếu không có mục tiêu trùng, tạo mục tiêu mới
        try {
            return $this->create($data);  // Tạo mục tiêu mới
        } catch (\Exception $e) {
            // Nếu có lỗi trong quá trình tạo, trả về thông báo lỗi
            return response()->json(['error' => 'Error creating goal: ' . $e->getMessage()], 500);
        }
    }
}

