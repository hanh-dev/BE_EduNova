<?php

namespace App\Http\Controllers;

use App\Services\WeekGoalService;
use Illuminate\Http\Request;

class weekGoal extends Controller
{
    protected $weekGoalService;
    public function __construct(WeekGoalService $weekGoalService)
    {
        $this->weekGoalService = $weekGoalService;
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
