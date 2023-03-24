@extends('layouts.admin')
@section('title', 'Products')
@section('content')
<div>
    <div class="row mt-4">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        <a href="{{route('admin.product.create')}}" class="btn btn-primary mt-1 float-end">Add Products</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Flavors</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name}}
                                        @else
                                            No Category Available
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->Status == '1' ? 'Hidden':'Visible'}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('admin.product.edit', ['id'=>$product->id])}}" class="btn btn-sm btn-success me-1" >Edit</a>
                                        <form action="{{route('admin.product.destroy', ['id'=>$product->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6">No Products Available</td>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection