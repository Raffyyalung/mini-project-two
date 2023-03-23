@extends('layouts.admin')
@section('content')
<div>
    <div class="row mt-4">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{route('admin.category.create')}}" class="btn btn-primary mt-1 float-end">Add Category</a>
                    </h3>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection