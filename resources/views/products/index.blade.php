@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Product CRUD</h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('products.create')}}" class="btn btn-primary mb-3">Add New Product</a>

                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)

                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                <a href="{{route('products.show', $product->id)}}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{route('products.destroy',$product->id)}}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Add more products here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
