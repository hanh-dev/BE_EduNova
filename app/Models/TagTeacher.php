<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Goal;

class TagTeacher extends Model
{
    protected $table = 'tag_teacher';
    protected $fillable = ['user_id', 'teacher_id', 'message', 'goal_id', 'teacher_response', 'is_read'];

    public $timestamps = true;

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}