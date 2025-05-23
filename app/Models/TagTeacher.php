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
}
