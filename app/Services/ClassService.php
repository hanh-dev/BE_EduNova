<?php

namespace App\Services;
use App\Repositories\ClassRepository;

class ClassService
{
    protected $repository;
    public function __construct(ClassRepository $classRepository)
    {
        $this->repository = $classRepository;
    }

    public function getAll()
    {
        $response = $this->repository->getAllWithDetails();
        return $response;
    }
}