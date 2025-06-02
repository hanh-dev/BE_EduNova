<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncementUser extends Model
{
    use HasFactory;

    protected $table = 'announcement_user';

    protected $fillable = [
        'announcement_id',
        'user_id',
        'is_read',
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
