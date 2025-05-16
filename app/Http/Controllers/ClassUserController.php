<?php

namespace App\Http\Controllers;

use App\Services\ClassUserService;
use Illuminate\Http\Request;

class ClassUserController extends Controller
{
    protected $service;
    public function __construct(ClassUserService $classUserService)
    {
        $this->service = $classUserService;
    }
}
