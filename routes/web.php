<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/categories', 'index')->name('admin.category');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category/store', 'store')->name('admin.category.store');
        Route::get('/category/{id}/edit', 'edit')->name('admin.category.edit');
        Route::put('/category/{id}/update', 'update')->name('admin.category.update');
        Route::delete('/category/{id}/delete', 'destroy')->name('admin.category.delete');
    });

    Route::controller(ProductController::class)->group(function() {
        Route::get('/products', 'index')->name('admin.product');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product/store', 'store')->name('admin.product.store');
        Route::get('/porduct/{id}/edit', 'edit')->name('admin.product.edit');
        Route::put('/product/{id}/update', 'update')->name('admin.product.update');
        Route::delete('product/{id}/delete', 'destroy')->name('admin.product.destroy');
    });
});
