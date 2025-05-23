<?php

namespace App\Services;

use App\Repositories\WeekGoalRepository;

class WeekGoalService
{
    protected $weekGoalRepository;

    public function __construct(WeekGoalRepository $weekGoalRepository)
    {
        $this->weekGoalRepository = $weekGoalRepository;
    }

    public function createWeekGoal(array $data)
    {
        return $this->weekGoalRepository->create($data);
    }

    public function getAllWeekGoals()
    {
        return $this->weekGoalRepository->getAll();
    }

    public function getAllWeekGoalsByUserId($userId)
    {
        return $this->weekGoalRepository->getAllByUserId($userId);
    }

    public function getWeekGoalById($id)
    {
        return $this->weekGoalRepository->find($id);
    }

    public function updateWeekGoal($id, array $data)
    {
        return $this->weekGoalRepository->update($id, $data);
    }

    public function updateWeekGoalStatus($id, $status)
    {
        return $this->weekGoalRepository->updateGoalStatus($id, $status);
    }

    public function deleteWeekGoal($id)
    {
        return $this->weekGoalRepository->deleteGoal($id);
    }

    public function getWeekGoalsByStatus($status)
    {
        return $this->weekGoalRepository->getGoalsByStatus($status);
    }
}