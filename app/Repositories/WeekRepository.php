<?php

namespace App\Repositories;

use App\Models\Week;

class WeekRepository
{
    protected $weekModel;

    public function __construct(Week $weekModel){
        $this->weekModel = $weekModel;
    }

    public function getAll()
    {
        return $this->weekModel->all(); 
    }

    public function create(array $data)
    {
        return $this->weekModel->create($data);
    }
}
