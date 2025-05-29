<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TagTeacher extends Model
{
    protected $table = 'tag_teacher';
    protected $fillable = ['user_id', 'teacher_id', 'message', 'goal_id'];

    public $timestamps = true;

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use App\Models\User;

// class TagTeacher extends Model
// {
//     protected $table = 'teacher_tags';
    
//     protected $fillable = [
//         'user_id', 
//         'teacher_id', 
//         'message', 
//         'goal_id',
//         'context_url',
//         'context_type',
//         'is_read'
//     ];

//     public $timestamps = true;

//     // Quan hệ với giáo viên được tag
//     public function teacher()
//     {
//         return $this->belongsTo(User::class, 'teacher_id');
//     }

//     // Quan hệ với sinh viên tag
//     public function student()
//     {
//         return $this->belongsTo(User::class, 'user_id');
//     }

//     // Scope để lấy thông báo chưa đọc
//     public function scopeUnread($query)
//     {
//         return $query->where('is_read', false);
//     }

//     // Scope để lấy thông báo theo giáo viên
//     public function scopeForTeacher($query, $teacherId)
//     {
//         return $query->where('teacher_id', $teacherId);
//     }

//     // Đánh dấu đã đọc
//     public function markAsRead()
//     {
//         $this->update(['is_read' => true]);
//     }
// }