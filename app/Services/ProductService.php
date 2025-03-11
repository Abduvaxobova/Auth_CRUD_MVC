<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getAll()
    {
        return $this->productRepository->getAll();
    }
    public function getById($id){
        return $this->productRepository->getById($id);
    }
    public function create(array $data){
        return $this->productRepository->create($data);
    }
    public function update(Product $product,array $data){
        return $this->productRepository->update($product, $data);
    }
    public function delete(Product $product){
        return $this->productRepository->delete($product);
    }
}
