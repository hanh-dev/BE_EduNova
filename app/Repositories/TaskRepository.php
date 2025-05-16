<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    protected $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getAllTasks()
    {
        return $this->model
            ->select('id', 'skill_module', 'lesson_summary', 'user_id')
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'image');
            }])
            ->get();
    }
}