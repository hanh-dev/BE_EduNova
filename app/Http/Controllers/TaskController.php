<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $taskService)
    {
        $this->service = $taskService;
    }

    public function index()
    {
        $tasks = $this->service->getAllTasks();
        return response()->json($tasks);
    }


    public function update(Request $request, $id)
{
    $data = $request->only(['status']);
    $task = $this->service->updateTask($id, $data);
    if ($task) {
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data' => $task,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Task not found or update failed.',
        ], 404);
    }
}
}