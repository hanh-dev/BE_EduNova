<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name', 'description', 'image', 'teacher_id', 'status'];

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classUsers()
    {
        return $this->hasMany(ClassUser::class, 'class_id');
    }
}
