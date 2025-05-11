<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        try {
            $product = $this->service->createProduct($request->all());
            // $test = $this->service->getProduct();
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get()
    {
        return response()->json(['message' => 'Test Nha']);
    }
}