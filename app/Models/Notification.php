<?php

// app/Models/Notification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'link',
        'is_read',
    ];

    // Thông báo gửi từ sinh viên
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Thông báo gửi tới giáo viên
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function scopeUnread($query)
{
    return $query->where('is_read', false);
}

}
