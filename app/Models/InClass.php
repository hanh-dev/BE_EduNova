<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InClass extends Model
{
    use HasFactory;

    protected $table = 'in_class_journal';

    protected $fillable = [
        'user_id',
        'goal_id',
        'date',
        'skill_module',
        'lesson_summary',
        'self_assessment',
        'difficulties',
        'improvement_plan',
        'problem_solved',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
