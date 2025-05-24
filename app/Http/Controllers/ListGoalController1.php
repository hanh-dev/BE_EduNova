<?php

//namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ListGoalService;
use Illuminate\Support\Facades\Log;

class ListGoalController1 extends Controller
{
    protected $service;

    public function __construct(ListGoalService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try{
        return response()->json($this->service->getAllGoals());
        }catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        
            }}

    public function store(Request $request)
    {
        $request->validate([
            'goal_text' => 'required|string',
        ]);

        return response()->json($this->service->createGoal($request->only('goal_text')), 201);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'is_checked' => 'required|boolean',
        ]);

        return response()->json($this->service->updateGoalStatus($id, $request->is_checked));
    }
}
