<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters'; 

    protected $primaryKey = 'id';

    public $timestamps = true; 

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];
}