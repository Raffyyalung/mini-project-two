@extends('layouts.admin')
@section('title', 'Products')
@section('content')
<div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $errors }}</div>
                            @endforeach
                        </div>
                    @endif
                <div class="card-body">
                    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Whole Beans</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Ground Beans</button>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                   
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
                                                                    <th>Coffee Type</th>
                                                                    <th>Category</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($products as $product)
                                                                @if ($product->category && $product->category->name == 'Whole beans')
                                                                    <tr>
                                                                        <td>{{ $product->id }}</td>
                                                                        <td>{{$product->name}}</td>
                                                                        <td>
                                                                            @if ($product->category)
                                                                                {{ $product->category->name}}
                                                                            @else
                                                                                No Category Available
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$product->quantity}}</td>
                                                                        <td>{{$product->price}}</td>
                                                                        <td @if ($product->quantity < 10) style="color: red; font-weight: bold;" @endif>
                                                                            @if ($product->quantity >= 10)
                                                                                Normal
                                                                            @else
                                                                                Need to restock
                                                                            @endif
                                                                        </td>
                                                                        
                                                                        
                                                                        <td class="d-flex">
                                                                            <a href="{{route('admin.product.edit', ['id'=>$product->id])}}" class="btn btn-sm btn-success me-1" >Edit</a>
                                                                            <form action="{{route('admin.product.destroy', ['id'=>$product->id])}}" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <input type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" value="Delete">
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
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

                                    
                                       
                                </div>
                                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                  
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
                                                                    <th>Coffee Type</th>
                                                                    <th>Category</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($products as $product)
                                                                @if ($product->category && $product->category->name == 'Ground beans')
                                                                    <tr>
                                                                        <td>{{ $product->id }}</td>
                                                                        <td>{{$product->name}}</td>
                                                                        <td>
                                                                            @if ($product->category)
                                                                                {{ $product->category->name}}
                                                                            @else
                                                                                No Category Available
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$product->quantity}}</td>
                                                                        <td>{{$product->price}}</td>
                                                                        <td @if ($product->quantity < 10) style="color: red; font-weight: bold;" @endif>
                                                                            @if ($product->quantity >= 10)
                                                                                Normal
                                                                            @else
                                                                                Need to restock
                                                                            @endif
                                                                        </td>
                                                                        
                                                                        
                                                                        <td class="d-flex">
                                                                            <a href="{{route('admin.product.edit', ['id'=>$product->id])}}" class="btn btn-sm btn-success me-1" >Edit</a>
                                                                            <form action="{{route('admin.product.destroy', ['id'=>$product->id])}}" method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <input type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" value="Delete">
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
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


                                </div>
                               
                          </div>
                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection









