<?php
namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class SelfStudy extends Model
    {
        use HasFactory;

        protected $table = 'self_study_journals';

        protected $fillable = [
            'user_id',    
            'week_id',  
            'date',
            'skill_module',
            'lesson_summary',
            'time_allocation',
            'learning_resources',
            'learning_activities',
            'concentration',
            'follow_plan',
            'self_assessment',
            'evaluation',   
            'reinforcement',
            'notes',
            'status',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        
    }
