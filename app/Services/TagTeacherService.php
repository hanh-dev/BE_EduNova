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
        ]);
    }
}
