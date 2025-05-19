<?php

namespace App\Http\Controllers;

use App\Services\SemesterService;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    protected $semesterService;

    public function __construct(SemesterService $semesterService)
    {
        $this->semesterService = $semesterService;
    }

    public function index()
    {
        return response()->json($this->semesterService->getAllSemesters());
    }

    public function show($id)
    {
        return response()->json($this->semesterService->getSemesterById($id));
    }

public function store(Request $request)
{
    $data = $request->only(['name', 'start_date', 'end_date']);

    $newSemester = $this->semesterService->createSemester($data);

    return response()->json($newSemester, 201);
}

}
