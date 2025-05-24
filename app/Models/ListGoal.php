<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListGoal extends Model
{
    protected $table = 'listgoal';

    protected $fillable = [
        'goal_text',
        'is_checked',
    ];
}
