<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderdetailsController;

Route::middleware([])->prefix("api")->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::post('users', [UserController::class, 'store']);
});
Route::middleware([])->prefix("api")->group(function () {
    Route::get('products', [ProductsController::class, 'product']);
    Route::delete('products/{id}', [ProductsController::class, 'destroy']);
    Route::post('products', [ProductsController::class, 'store']);
    Route::get('products/{id}',[ProductsController::class, 'edit']);
    Route::put('products/{id}',[ProductsController::class, 'edit']);
});
Route::middleware([])->prefix("api")->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}',[OrderController::class, 'edit']);
});
Route::middleware([])->prefix("api")->group(function () {
    Route::get('orderdetails/{id}', [OrderdetailsController::class, 'index']);
});
