<?php

namespace App\Repositories;

use App\Models\ListGoal;

class ListGoalRepository
{
    public function getAll()
    {
        return ListGoal::all();
    }

    public function create(array $data)
    {
        return ListGoal::create($data);
    }

    public function updateStatus($id, $status)
    {
        $goal = ListGoal::findOrFail($id);
        $goal->is_checked = $status;
        $goal->save();

        return $goal;
    }
}
