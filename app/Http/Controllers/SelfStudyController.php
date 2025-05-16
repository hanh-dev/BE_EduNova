<?php

namespace App\Http\Controllers;

use App\Services\SelfStudyService;
use Illuminate\Http\Request;

class SelfStudyController extends Controller
{
    protected $selfStudyService;

    public function __construct(SelfStudyService $SelfStudyService)
    {
        $this->selfStudyService = $SelfStudyService;
    }
    public function index()
    {
        return response()->json($this->selfStudyService->getAllClass(), 200);
    }

    public function show($id)
    {
        $goal = $this->selfStudyService->getSelfClassById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
            'date' => 'required|date',
            'skill_module' => 'required|string|max:255',
            'lesson_summary' => 'required|string',
            'time_allocation' => 'required|string|max:255',
            'learning_resources' => 'required|string',
            'learning_activities' => 'required|string',
            'concentration' => 'required|integer|min:1|max:5',
            'follow_plan' => 'required|boolean',
            'evaluation' => 'required|string',
            'reinforcement' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:inprogress,done,cancel',
        ]);
    
        $goal = $this->selfStudyService->createGoal($validated);
    
        return response()->json($goal, 201);
    }

    public function update (Request $request, $id){
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
            'date' => 'required|date',
            'skill_module' => 'required|string|max:255',
            'lesson_summary' => 'required|string',
            'time_allocation' => 'required|string|max:255',
            'learning_resources' => 'required|string',
            'learning_activities' => 'required|string',
            'concentration' => 'required|integer|min:1|max:5',
            'follow_plan' => 'required|boolean',
            'evaluation' => 'required|string',
            'reinforcement' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:inprogress,done,cancel',
        ]);
        $selfClass = $this->selfStudyService->updateSelfStudy($id, $validated);

        if (!$selfClass) {
            return response()->json(['message' => 'selfClass not found'], 404);
        }

        return response()->json($selfClass,200);
    }


    public function edit($id)
    {
        $selfClass = $this->selfStudyService->getSelfClassById($id);

        if (!$selfClass) {
            return redirect()->route('selfClass.index')->with('error', 'Record not found');
        }

        return view('selfClass.edit', compact('selfClass'));
    }
}
