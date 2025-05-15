<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InClass extends Model
{
    use HasFactory;

    protected $table = 'inclass';

    protected $fillable = [
        'user_id',      
        'date',
        'skill_module',
        'MyLesson',
        'SelfAssesment',
        'MyDifficulties',
        'MyPlan',
        'ProblemSolved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
