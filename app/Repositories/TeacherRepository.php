<?php

namespace App\Repositories;
use App\Models\User;

class TeacherRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAllWithDetails()
    {
        return User::where('role', 'teacher')->get();
    }
}