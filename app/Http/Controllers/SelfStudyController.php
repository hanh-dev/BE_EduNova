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
        $goal = $this->selfStudyService->getInClasServiceById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }



}
