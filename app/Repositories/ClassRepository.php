<?php

namespace App\Repositories;
use App\Models\ClassModel;
use Illuminate\Support\Facades\DB;

class ClassRepository
{
    protected $model;

    public function __construct(ClassModel $classModel)
    {
        $this->model = $classModel;
    }

    public function getAllWithDetails()
    {
        $classes = DB::table('classes')
            ->join('users as teachers', 'classes.teacher_id', '=', 'teachers.id')
            ->leftJoin('class_user', 'classes.id', '=', 'class_user.class_id')
            ->select(
                'classes.id',
                'classes.name',
                'classes.description',
                'classes.image',
                'teachers.name as teacher_name',
                'teachers.image as teacher_image',
                DB::raw('COUNT(class_user.student_id) as total_students')
            )
            ->groupBy('classes.id', 'classes.name', 'classes.description', 'classes.image', 'teachers.name', 'teachers.image')
            ->get();

        return $classes;
    }
}