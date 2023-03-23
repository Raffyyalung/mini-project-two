@extends('layouts.admin')
   @section('title', 'Dashboard')
@section('content')
   @if (session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
   @endif

   <div class="container-fluid" px-4>
        <h1 class="mt-4">Dashboard</h1>
        <p class="mb-4">Dashboard</p>
        <div class="row">
        </div>
   </div>

@endsection