<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\dashboard\ProductsController;
use App\Http\Middleware\AdminCheck;
use App\Models\dashboard\Product;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => ['auth:admin'],
    'prefix' => '/admin/dashboard'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('maindashboard');
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
});
