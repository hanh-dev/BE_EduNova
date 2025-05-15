<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Services\TeacherService;
use App\Services\UserService;
use GuzzleHttp\Psr7\Request;

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
