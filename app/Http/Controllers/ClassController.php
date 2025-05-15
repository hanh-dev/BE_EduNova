<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use Illuminate\Http\Request;
use App\Services\ClassService;
use App\Services\ClassUserService;
use App\Services\UserService;

class ClassController extends Controller
{
    protected $service;
    protected $userService;
    protected $classUserService;

    public function __construct(ClassService $classService, UserService $userService, ClassUserService $classUserService)
    {
        $this->service = $classService;
        $this->userService = $userService;
        $this->classUserService = $classUserService;
    }

    public function index()
    {
        $classes = $this->service->getAll();
        return response()->json($classes);
    }

    public function create(StoreClassRequest $request)
    {
        $validated = $request->validated();
        $teacher_id = $this->userService->getUserIdByUserName($validated['teacherName']);
        
        if (!$teacher_id) {
            return response()->json(['error' => 'Teacher not found.'], 404);
        }

        $validated['teacher_id'] = $teacher_id;
        $class = $this->service->createClass($validated);

        if (!$class) {
            return response()->json(['error' => 'Failed to create class'], 500);
        }

        $class_id = $class->id;

        $validated['students'] = json_decode($validated['students'], true);
        if (!is_array($validated['students'])) {
            return response()->json(['error' => 'Invalid student data'], 422);
        }

        foreach($validated['students'] as $studentData)
        {
            $student = $this->userService->create($studentData);
            if ($student) {
                $this->classUserService->create($student->id, $class_id);
            }
        }
        return response()->json([
            'message' => 'Class created successfully',
            'data' => $class
        ], 201);
    }
}
