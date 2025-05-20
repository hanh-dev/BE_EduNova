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

    public function create(array $data)
    {
        if (empty($data['image'])) {
            $data['image'] = 'ItEnglish.png';
        }
        return ClassModel::create($data);
    }

    public function delete($id)
    {
        return ClassModel::where('id', '=', $id)->delete();
    }

    public function classExists($id)
    {
        return ClassModel::where('id', $id)->exists();
    }

    public function updateClass($id, $data)
    {
        $class = ClassModel::findOrFail($id);
        $class->fill($data);
        $class->save();
        return $class;
    }

}