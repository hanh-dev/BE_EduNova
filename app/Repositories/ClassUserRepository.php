<?php

namespace App\Repositories;
use App\Models\ClassUser;

class ClassUserRepository
{
    protected $model;

    public function __construct(ClassUser $classUserModel)
    {
        $this->model = $classUserModel;
    }
}