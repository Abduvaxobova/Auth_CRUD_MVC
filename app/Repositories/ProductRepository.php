<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll(){
        return Product::all();
    }
    public function getById($id){
        return Product::findOrFail($id);
    }
    public function create(array $data){
        return Product::create($data);
    }
    public function update(Product $product, array $data)
    {
        $product->name = $data["name"] ?? $product->name;
        $product->price = $data["price"] ?? $product->price;
        $product->description = $data["description"] ?? $product->description;

        $product->save();
        return $product;
    }
    public function delete(Product $product)
    {
        $product->delete();
    }
}
