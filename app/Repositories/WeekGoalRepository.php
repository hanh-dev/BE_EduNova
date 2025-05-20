<?php

namespace App\Repositories;

use App\Models\WeekGoal;

class WeekGoalRepository
{
    protected $weekGoalModel;

    public function __construct(WeekGoal $weekGoalModel)
    {
        $this->weekGoalModel = $weekGoalModel;
    }

    public function create(array $data)
    {
        return $this->weekGoalModel->create($data);
    }

    public function find($id)
    {
        return $this->weekGoalModel->find($id);
    }

    public function update($id, array $data)
    {
        $goal = $this->weekGoalModel->find($id);
        if (!$goal) {
            return null;
        }
        $goal->update($data);
        return $goal;
    }

    public function getAll()
    {
        return $this->weekGoalModel->all();
    }

    public function getAllByUserId($userId)
    {
        return $this->weekGoalModel->where('user_id', $userId)->get();
    }

    public function deleteGoal($id)
    {
        $goal = $this->weekGoalModel->find($id);
        if (!$goal) {
            return null;
        }
        $goal->delete();
        return true;
    }

    public function updateGoalStatus($id, $status)
    {
        $goal = $this->weekGoalModel->find($id);
        if (!$goal) {
            return null;
        }
        // $goal->complete_status = $status;
        $goal->save();
        return $goal;
    }

    public function getGoalsByStatus($status)
    {
        return $this->weekGoalModel->where('complete_status', $status)->get();
    }
}
