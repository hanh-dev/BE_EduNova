<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function getStudents()
    {
        try {
            $students = $this->service->index();

            return response()->json([
                'status' => 'success',
                'data' => $students
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch students.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeachers()
    {
        try {
            $teachers = $this->service->getTeachers();

            return response()->json([
                'status' => 'success',
                'data' => $teachers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch students.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $uploadResult = Cloudinary::uploadApi()->upload(
            $request->file('image')->getRealPath(),
            [
                'folder' => 'images',
                'public_id' => 'product_'.time(),
                'transformation' => [
                    'quality' => 'auto:eco',
                    'fetch_format' => 'auto',
                    'width' => 800,
                    'crop' => 'limit'
                ]
            ]
        );

        $imageUrl = $uploadResult['secure_url'];
        $student = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $imageUrl
        ];

        $newStudent = $this->service->createStudent($student);

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully.',
            'student' => $newStudent
        ], 201);
    }

    public function destroyStudent($id)
    {
        $deletedUser = $this->service->destroyStudent($id);

        return response()->json([
            'status' => true,
            'message' => 'Student deleted successfully.',
            'student' => $deletedUser
        ], 201);
    }
}
