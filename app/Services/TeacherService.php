<?php

namespace App\Services;

use App\Repositories\TeacherRepository;

class TeacherService
{
    protected $repository;
    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->repository = $teacherRepository;
    }

    public function getAll()
    {
        return $this->repository->getAllWithDetails();
    }

}