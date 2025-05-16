<?php

namespace App\Services;
use App\Repositories\UserRepository;

class UserService
{
    protected $repository;
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function index()
    {
        return $this->repository->getStudents();
    }

    public function create($data)
    {
        return $this->repository->createUser($data);
    }

    public function getUserIdByUserName($name)
    {
        return $this->repository->getUserId($name);
    }

    public function emailExists($email)
    {
        return $this->repository->existUser($email);
    }

    public function getTeachers()
    {
        return $this->repository->getTeachers();
    }
}