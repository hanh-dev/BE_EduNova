<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use Illuminate\Http\Request;
use App\Services\ClassService;
use App\Services\ClassUserService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

        DB::beginTransaction();

        try {
            $validated['teacher_id'] = $teacher_id;
            $class = $this->service->createClass($validated);

            if (!$class) {
                DB::rollBack();
                return response()->json(['status' => false, 'error' => 'Failed to create class'], 500);
            }

            $class_id = $class->id;

            $validated['students'] = json_decode($validated['students'], true);
            if (!is_array($validated['students'])) {
                DB::rollBack();
                return response()->json(['status' => false, 'error' => 'Invalid student data'], 422);
            }

            foreach ($validated['students'] as $studentData) {
                if ($this->userService->emailExists($studentData['email'])) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'error' => 'Email already exists: ' . $studentData['email']
                    ], 422);
                }

                $studentData['image'] = $studentData['image'] ?? 'ItEnglish.png';
                $student = $this->userService->create($studentData);
                if (!$student) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'error' => 'Failed to create student'], 500);
                }

                $this->classUserService->create($student->id, $class_id);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Class created successfully',
                'data' => $class
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'error' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $removed = $this->service->delete($id);

        if (!$removed) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete class.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Class deleted successfully.'
        ], 200);
    }

    public function updateClass(Request $request, $id)
    {
        try {
            $classExists = $this->service->classExists($id);
            if (!$classExists) {
                return response()->json(['status' => false, 'message' => 'Class Not Found'], 404);
            }

            $data = $request->only(['className', 'teacherName', 'description', 'image', 'students']);
            $mappedData = [
                'name' => $data['className'] ?? null,
                'teacher_name' => $data['teacherName'] ?? null,
                'description' => $data['description'] ?? null,
                'image' => $data['image'] ?? null,
                'students' => $data['students'] ?? null,
            ];

            $this->service->updateClass($id, $mappedData);

            return response()->json(['status' => true, 'message' => 'Class updated successfully']);
        } catch (\Exception $e) {
            Log::error("Class update failed for id {$id}: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
