<?php

namespace App\Services;

use App\Repositories\TagTeacherRepository;
use App\Models\User;

class TagTeacherService
{
    protected $repository;

    public function __construct(TagTeacherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sendTagTeacher($teacherId, $message, $user_id, $goal_id)
    {
        $teacher = User::find($teacherId);
        if (!$teacher || $teacher->role !== 'teacher') {
            throw new \Exception('Teacher not found');
        }

        return $this->repository->create([
            'teacher_id' => $teacherId,
            'message' => $message,
            'user_id' => $user_id,
            'goal_id' => $goal_id,
            'is_read' => false, // Mặc định là chưa đọc
        ]);
    }

    public function getTagTeacher($teacherId)
    {
        $teacher = User::find($teacherId);
        if (!$teacher || $teacher->role !== 'teacher') {
            throw new \Exception('Teacher not found');
        }

        return $this->repository->getByTeacherId($teacherId);
    }

    public function getTagTeacherByGoal($goalId, $teacherId)
    {
        $teacher = User::find($teacherId);
        if (!$teacher || $teacher->role !== 'teacher') {
            throw new \Exception('Teacher not found');
        }

        return $this->repository->getByGoalIdAndTeacherId($goalId, $teacherId);
    }

    public function sendTeacherResponse($tagId, $teacherResponse)
    {
        $tag = $this->repository->find($tagId);
        if (!$tag) {
            throw new \Exception('Tag not found');
        }

        return $this->repository->update($tagId, [
            'teacher_response' => $teacherResponse,
            'is_read' => false,
        ]);
    }

    public function getStudentResponses($studentId)
    {
        $student = User::find($studentId);
        if (!$student || $student->role !== 'student') {
            throw new \Exception('Student not found');
        }

        return $this->repository->getByStudentId($studentId);
    }

    public function markResponseAsRead($tagId)
    {
        $tag = $this->repository->find($tagId);
        if (!$tag) {
            throw new \Exception('Tag not found');
        }

        return $this->repository->update($tagId, [
            'is_read' => true,
        ]);
    }
}