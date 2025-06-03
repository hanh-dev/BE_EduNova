<?php

namespace App\Repositories;

use App\Models\TagTeacher;

class TagTeacherRepository
{
    public function create(array $data)
    {
        return TagTeacher::create($data);
    }

    public function getByTeacherId($teacherId)
    {
        return TagTeacher::with('student')
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByGoalIdAndTeacherId($goalId, $teacherId)
    {
        return TagTeacher::with('student')
            ->where('goal_id', $goalId)
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function find($id)
    {
        return TagTeacher::find($id);
    }

    public function update($id, array $data)
    {
        $tag = TagTeacher::find($id);
        if ($tag) {
            $tag->update($data);
            return $tag;
        }
        return null;
    }

    public function getByStudentId($studentId)
    {
        return TagTeacher::with(['student', 'teacher'])
            ->where('user_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}