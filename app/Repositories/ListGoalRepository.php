<?php

namespace App\Repositories;

use App\Models\ListGoal;

class ListGoalRepository
{
    protected $model;

    public function __construct(ListGoal $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $goal = $this->model->find($id);
        if ($goal) {
            $goal->update($data);
            return $goal;
        }
        return null;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
