<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['student_id', 'content', 'is_read'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
