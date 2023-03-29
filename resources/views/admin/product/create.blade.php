@extends('layouts.admin')
@section('title', 'Products')
@section('content')
<div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Products
                        <a href="{{route('admin.product')}}" class="btn btn-primary mt-1 float-end">Back</a>
                    </h3>
                </div>
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
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Image</button>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class= "mb-3">
                                        <label>Category</label>
                                        <select name="category_id" class="form-select">
                                            <option selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Coffee Type</label>
                                            <select name="name" class="form-control">
                                                <option value="BARAKO">BARAKO</option>
                                                <option value="EXCELSIA">EXCELSIA</option>
                                                <option value="ROBUSTA">ROBUSTA</option>
                                                <option value="ARABICA">ARABICA</option>
                                                <option value="HAZELNUT">HAZELNUT</option>
                                                <option value="VANILLA">VANILLA</option>
                                                <option value="CARAMEL">CARAMEL</option>
                                                <option value="DARKCHOCO">DARKCHOCO</option>
                                                </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Small Description</label>
                                        <textarea name="description" class="form-control" rows="4"></textarea>
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                    <div class="row">
                                        <div class="mb-3 col-12 col-md-4">
                                            <label>Price</label>
                                            <input type="number" name="price" class="form-control">
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-12 col-md-4">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control">
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label> Upload Product Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                          </div>
                          <div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection