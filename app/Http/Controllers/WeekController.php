<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    protected $weekService;

    public function __construct(WeekService $weekService){
        $this -> weekService = $weekService;
    }
}
