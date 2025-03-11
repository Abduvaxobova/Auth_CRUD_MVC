@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h1 class="text-center">Create New Product</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form id="createForm" method="POST" action="{{route('products.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="body" name="description" rows="3" placeholder="Enter product description"
                        required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Enter price"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
                <a href="{{route('products.index')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
