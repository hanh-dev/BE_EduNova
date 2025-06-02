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

    public function createStudent($data)
    {
        return $this->repository->createStudent($data);
    }

    public function destroyStudent($id)
    {
        return $this->repository->destroy($id);
    }

    public function updateStudent($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function getUserIdByEmail($email)
    {
        return $this->repository->getUserIdByEmail($email);
    }

    public function getUserNameById($userId)
    {
        return $this->repository->getUserNameById($userId);
    }
}