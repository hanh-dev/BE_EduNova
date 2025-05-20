<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SelfStudyService;

class SelfStudyController extends Controller
{
    protected $service;

    public function __construct(SelfStudyService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        $record = $this->service->getById($id);
        if (!$record) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($record);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'week_id' => 'required|integer',
            'date' => 'required|date',
            'skill_module' => 'required|string',
            'lesson_summary' => 'required|string',
            'time_allocation' => 'required|integer',
            'learning_resources' => 'required|string',
            'learning_activities' => 'required|string',
            'concentration' => 'required|integer',
            'follow_plan' => 'required|string',
            'evaluation' => 'required|string',
            'reinforcement' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:inprogress,done,cancel',
        ]);

        $record = $this->service->create($data);

        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|integer',
            'week_id' => 'sometimes|integer',
            'date' => 'sometimes|date',
            'skill_module' => 'sometimes|string',
            'lesson_summary' => 'sometimes|string',
            'time_allocation' => 'sometimes|integer',
            'learning_resources' => 'sometimes|string',
            'learning_activities' => 'sometimes|string',
            'concentration' => 'sometimes|integer',
            'follow_plan' => 'sometimes|string',
            'evaluation' => 'sometimes|string',
            'reinforcement' => 'sometimes|string',
            'notes' => 'nullable|string',
            'status' => 'sometimes|in:inprogress,done,cancel',
        ]);

        $result = $this->service->update($id, $data);

        if (!$result) {
            return response()->json(['message' => 'Not found or update failed'], 404);
        }

        return response()->json(['message' => 'Updated successfully']);
    }

    public function destroy($id)
    {
        $result = $this->service->delete($id);

        if (!$result) {
            return response()->json(['message' => 'Delete failed or not found'], 404);
        }

        return response()->json(['message' => 'Deleted successfully']);
    }
}
