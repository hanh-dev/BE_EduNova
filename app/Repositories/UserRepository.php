<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getStudents()
    {
        $students = User::where('role', '=', 'student')->get();
        return $students;
    }

    public function getUserId($name)
    {
        $user = User::where('name', $name)->first();
        return $user?->id;
    }

    public function createUser($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function existUser($email)
    {
        return User::where('email', $email)->exists();
    }

    public function getTeachers()
    {
        $teachers = User::where('role', '=', 'teacher')->get();
        return $teachers;
    }
}