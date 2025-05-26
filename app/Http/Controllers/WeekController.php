<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;
use App\Services\WeekService;

class WeekController extends Controller
{
    protected $weekService;

    public function __construct(WeekService $weekService)
    {
        $this->weekService = $weekService;
    }

    public function getAllWeeks()
    {
        $weeks = $this->weekService->getAllWeeks();
        return response()->json($weeks);
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'week_number' => 'required|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $week = Week::create([
            'semester_id' => $request->semester_id,
            'week_number' => $request->week_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json($week, 201);
    }


    public function createWeek(Request $request)
    {
        $data = $request->validate([
            'week_number' => 'required|integer',
            'semester_id' => 'required|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);


        try {
            $week = $this->weekService->createWeek($data);
            return response()->json($week, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create week', 'message' => $e->getMessage()], 500);
        }
    }

}
