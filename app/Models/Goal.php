<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Goal extends Model
{
    use HasFactory;

    protected $table = 'goals';

    protected $fillable = [
        'user_id',
        'course',
        'goals',
        'courseExpectations',
        'teacherExpectations',
        'selfExpectations',
        'dueDate',
        'completeStatus', 
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định dạng ngày hết hạn (dueDate)
    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['dueDate'] = Carbon::parse($value)->toDateString();
    }

    // Trạng thái hoàn thành: nếu trạng thái là 'done', trả về màu xanh, nếu 'doing', trả về màu vàng
    public function getCompleteStatusAttribute($value)
    {
        return $value === 'done' ? 'done' : 'doing'; // Trả về trạng thái hoàn thành
    }

    // Cập nhật trạng thái hoàn thành
    public function setCompleteStatusAttribute($value)
    {
        $this->attributes['completeStatus'] = $value === 'done' ? 'done' : 'doing'; // Đảm bảo trạng thái hợp lệ
    }
    public function getCompletionPercentage()
{
    // Lấy dữ liệu từ service
    $data = $this->goalService->getCompletionPercentage();

    // Trả về kết quả
    return response()->json($data, 200);
}

}
