<?php

namespace App\Services;
use App\Repositories\ClassUserRepository;

class ClassUserService
{
    protected $repository;
    public function __construct(ClassUserRepository $classUserRepository)
    {
        $this->repository = $classUserRepository;
    }

    public function create($student_id, $class_id)
    {
        return $this->repository->create($student_id, $class_id);
    }

    public function checkUserAlreadyInClass($student_id, $class_id)
    {
        return $this->repository->checkStudentExistInClass($student_id, $class_id);
    }
}