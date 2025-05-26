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

    public function create($stuent_id, $class_id)
    {
        DB::table('class_user')->insert([
            'class_id' => $class_id,
            'student_id' => $stuent_id,
            'joined_at' => now()
        ]);
    }

    public function checkStudentExistInClass($student_id, $class_id)
    {
        return DB::table('class_user')
            ->where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->exists();
    }
}