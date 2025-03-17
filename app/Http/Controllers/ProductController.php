<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        return ProductResource::collection($this->productService->getAll());
    }
    public function store(StoreProductRequest $request)
    {
        return new ProductResource($this->productService->create($request->all()));
    }

    public function show(string $id)
    {
        return new ProductResource($this->productService->getById($id));
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        return new ProductResource($this->productService->update($product, $request->all()));
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return response()->json(['message' => 'Product deleted'], 200);
    }
}
