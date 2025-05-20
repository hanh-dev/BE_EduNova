<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class WeekGoal extends Model
{
    use HasFactory;

    protected $table = 'weeksgoal';

    protected $fillable = [
        'user_id',
        'goal',
        'complete_status',
        'due_date',
    ];

    protected $dates = ['due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value)->toDateString();
    }

    public function setCompleteStatusAttribute($value)
    {
        $this->attributes['complete_status'] = in_array($value, ['done', 'doing']) ? $value : 'doing';
    }
}