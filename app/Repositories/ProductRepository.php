<?php

namespace App\Repositories;

use App\Models\Student;

class ProductRepository
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($data) {
        return "Hello";
    }
}