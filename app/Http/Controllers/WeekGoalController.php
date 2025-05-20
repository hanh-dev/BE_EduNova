<?php

namespace App\Http\Controllers;

use App\Services\WeekGoalService;
use Illuminate\Http\Request;

class WeekGoalController extends Controller
{
    protected $weekGoalService;

    public function __construct(WeekGoalService $weekGoalService)
    {
        $this->weekGoalService = $weekGoalService;
    }

    public function getAllWeekGoals(Request $request)
    {
        $userId = $request->query('user_id');
        if ($userId) {
            $goals = $this->weekGoalService->getAllWeekGoalsByUserId($userId);
        } else {
            $goals = $this->weekGoalService->getAllWeekGoals();
        }
        return response()->json($goals, 200);
    }

    public function getWeekGoal($id)
    {
        $goal = $this->weekGoalService->getWeekGoalById($id);
        if (!$goal) {
            return response()->json(['message' => 'Week goal not found'], 404);
        }
        return response()->json($goal, 200);
    }

    public function storeWeekGoal(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'goal' => 'required|string',
            'complete_status' => 'in:doing,done',
            'due_date' => 'required|date',
        ]);

        $goal = $this->weekGoalService->createWeekGoal($validated);
        return response()->json($goal, 201);
    }

    public function updateWeekGoal(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'goal' => 'required|string',
            'complete_status' => 'in:doing,done',
            'due_date' => 'required|date',
        ]);

        $goal = $this->weekGoalService->updateWeekGoal($id, $validated);
        if (!$goal) {
            return response()->json(['message' => 'Week goal not found'], 404);
        }
        return response()->json($goal, 200);
    }

    public function updateWeekGoalStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'complete_status' => 'required|in:doing,done',
        ]);

        $goal = $this->weekGoalService->updateWeekGoalStatus($id, $validated['complete_status']);
        if (!$goal) {
            return response()->json(['message' => 'Week goal not found'], 404);
        }
        return response()->json($goal, 200);
    }

    public function deleteWeekGoal($id)
    {
        $goal = $this->weekGoalService->getWeekGoalById($id);
        if (!$goal) {
            return response()->json(['message' => 'Week goal not found'], 404);
        }
        $this->weekGoalService->deleteWeekGoal($id);
        return response()->json(['message' => 'Week goal deleted successfully'], 200);
    }

    public function getWeekGoalsByStatus($status)
    {
        if (!in_array($status, ['doing', 'done'])) {
            return response()->json(['message' => 'Invalid status'], 400);
        }
        $goals = $this->weekGoalService->getWeekGoalsByStatus($status);
        return response()->json($goals, 200);
    }
}