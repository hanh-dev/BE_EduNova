<?php

namespace App\Repositories;
use App\Models\ClassUser;
use Illuminate\Support\Facades\DB;

class ClassUserRepository
{
    protected $model;

    public function __construct(ClassUser $classUserModel)
    {
        $this->model = $classUserModel;
    }

    public function create($stuentId, $classId)
    {
        DB::table('class_user')->insert([
            'class_id' => $classId,
            'student_id' => $stuentId,
            'joined_at' => now()
        ]);
    }
}