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
}