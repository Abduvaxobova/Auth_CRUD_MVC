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
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function create(){
        return view('products.create');
    }
    public function store(StoreProductRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index');
    }

    public function show(string $id)
    {
        $product = $this->findProduct($id);
        return view("products.show", compact("product"));
    }
    public function edit($id){
        $product = $this->findProduct($id);
        return view("products.edit", compact("product"));
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->findProduct($id);
        $product->update($request->all());
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = $this->findProduct($id);
        $product->delete();
        return redirect()->route('products.index');
    }
    public function findProduct($id){
        return Product::findOrFail($id);
    }
}
