<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassService;

class ClassController extends Controller
{
    protected $service;

    public function __construct(ClassService $classService)
    {
        $this->service = $classService;
    }

    public function index()
    {
        $classes = $this->service->getAll();
        return response()->json($classes);
    }
}
