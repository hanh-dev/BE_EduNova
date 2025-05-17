<?php

namespace App\Services;
use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        $tasks = $this->taskRepository->getAllTasks();

        if ($tasks->isEmpty()) {
            return [
                'success' => true,
                'message' => 'No tasks found.',
                'data' => [],
            ];
        }

        return [
            'success' => true,
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks,
        ];
    }
}