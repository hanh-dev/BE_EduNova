<?php

namespace App\Services;

use App\Repositories\ListGoalRepository;

class ListGoalService
{
    protected $repository;

    public function __construct(ListGoalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllGoals()
    {
        return $this->repository->getAll();
    }

    public function createGoal($data)
    {
        return $this->repository->create($data);
    }

    public function updateGoalStatus($id, $status)
    {
        return $this->repository->updateStatus($id, $status);
    }
}
