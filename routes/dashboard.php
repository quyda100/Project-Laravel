<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

Route::middleware(['checkLogin'])->name("dashboard.")->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');
    Route::get('products', function () {
        return view('product');
    })->name('product');

    Route::name('account.')->prefix('account')->group(function () {
        Route::get('/', function () {
            return view('dashboard.tables');
        })->name('index');
        Route::get('create', function () {
            return view('dashboard.account.create');
        })->name('create');
        Route::get('edit/{id}', function ($id) {
            return view('dashboard.account.edit',['id'=>$id]);
        });
    });
});

Route::prefix("api")->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'edit']);
    Route::put('users/{id}', [UserController::class, 'update']);
});
