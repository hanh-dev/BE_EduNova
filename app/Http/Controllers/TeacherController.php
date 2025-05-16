<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;

class TeacherController extends Controller
{
    protected $service;

    public function __construct(TeacherService $teacherService)
    {
        $this->service = $teacherService;
    }

    public function index()
    {
        $teachers = $this->service->getAll();
        return response()->json($teachers);
    }

}
