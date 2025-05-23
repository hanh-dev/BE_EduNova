<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ListGoalService;

class ListGoalController extends Controller
{
    protected $service;

    public function __construct(ListGoalService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $goals = $this->service->getAllGoals();
        return response()->json($goals);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'goal_text' => 'required|string',
            'is_checked' => 'boolean',
        ]);
        $goal = $this->service->createGoal($data);
        return response()->json($goal, 201);
    }

    public function show($id)
    {
        $goal = $this->service->getGoalById($id);
        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }
        return response()->json($goal);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'goal_text' => 'sometimes|string',
            'is_checked' => 'sometimes|boolean',
        ]);
        $goal = $this->service->updateGoal($id, $data);
        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }
        return response()->json($goal);
    }

    public function destroy($id)
    {
        $deleted = $this->service->deleteGoal($id);
        if (!$deleted) {
            return response()->json(['message' => 'Goal not found'], 404);
        }
        return response()->json(null, 204);
    }
}
