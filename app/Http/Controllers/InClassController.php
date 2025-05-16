<?php

namespace App\Http\Controllers;

use App\Services\InClassService;
use Illuminate\Http\Request;

class InClassController extends Controller
{
    protected $inClassService;

    public function __construct(InClassService $inClassService)
    {
        $this->inClassService = $inClassService;
    }
    public function index()
    {
        return response()->json($this->inClassService->getAllClass(), 200);
    }

    public function show($id)
    {
        $goal = $this->inClassService->createSeflClass($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'skill_module' => 'required|string',
            'MyLesson' => 'required|string',
            'SelfAssesment' => 'required|in:1,2,3',
            'MyDifficulties' => 'nullable|string',
            'MyPlan' => 'nullable|string',
            'ProblemSolved' => 'required|in:Yes,No'
        ]);

        $inclass = $this->inClassService->updateInclass($id, $validated);

        if (!$inclass) {
            return response()->json(['message' => 'Inclass record not found'], 404);
        }

        return response()->json($inclass, 200);
    }


}
