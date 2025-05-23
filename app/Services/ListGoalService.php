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

    public function getGoalById($id)
    {
        return $this->repository->findById($id);
    }

    public function createGoal($data)
    {
        return $this->repository->create($data);
    }

    public function updateGoal($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteGoal($id)
    {
        return $this->repository->delete($id);
    }
}
