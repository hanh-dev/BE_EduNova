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

    public function createClass(array $data)
    {
        $reponse = $this->repository->create($data);
        return $reponse;
    }

    public function delete($id)
    {
        $reponse = $this->repository->delete($id);
        return $reponse;
    }

    public function classExists($id)
    {
        $response = $this->repository->classExists($id);
        return $response;
    }

    public function updateClass($id, $data)
    {
        $response = $this->repository->updateClass($id, $data);
        return $response;
    }
}