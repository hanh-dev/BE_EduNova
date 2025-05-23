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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'goal_id' => 'required|exists:goals,id',
            'date' => 'required|date',
            'skill_module' => 'required|string|max:255',
            'lesson_summary' => 'required|string',
            'self_assessment' => ['required', 'integer', 'in:1,2,3'],
            'difficulties' => 'nullable|string',
            'improvement_plan' => 'nullable|string',
            'problem_solved' => 'required|boolean'
        ]);

        $goal = $this->inClassService->createGoal($validated);

        return response()->json($goal, 201);
    }
    public function show($id)
    {
        $goal = $this->inClassService->getInClasServiceById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }
    public function update(Request $request, $id)
    {
        if ($request->has('problem_solved')) {
            $request->merge([
                'problem_solved' => $request->problem_solved ? 1 : 0
            ]);
        } else {

            $request->merge([
                'problem_solved' => 0
            ]);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'goal_id' => 'required|exists:goals,id',
            'date' => 'required|date',
            'skill_module' => 'required|string|max:255',
            'lesson_summary' => 'required|string',
            'self_assessment' => ['required', 'integer', 'in:1,2,3'],
            'difficulties' => 'nullable|string',
            'improvement_plan' => 'nullable|string',
            'problem_solved' => 'required|boolean',
        ]);

        $inclass = $this->inClassService->updateInclass($id, $validated);

        if (!$inclass) {
            return response()->json(['message' => 'Inclass record not found'], 404);
        }

        return response()->json($inclass, 200);
    }

    public function edit($id)
    {
        $inclass = $this->inClassService->getInClasServiceById($id);

        if (!$inclass) {
            return redirect()->route('inclass.index')->with('error', 'Record not found');
        }

        return view('inclass.edit', compact('inclass'));
    }

    public function destroy($id)
    {
        $inclass = $this->inClassService->getInClassById($id);

        if (!$inclass) {
            return response()->json(['message' => 'InClass not found'], 404);
}

        $this->inClassService->deleteInClass($id);

        return response()->json(['message' => 'InClass deleted successfully'], 200);
    }

}