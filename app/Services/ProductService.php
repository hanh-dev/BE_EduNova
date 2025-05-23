<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createProduct(array $data)
    {
        if ($data['price'] <= 0) {
            throw new \Exception("Giá sản phẩm phải > 0");
        }
        return $this->repository->create($data);
    }
}