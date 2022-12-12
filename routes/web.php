<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('register', function () {
});
Route::get('/register', function () {
    if (session()->has('isLogin'))
        return redirect('/');
    return view('register');
})->name('register');


Route::get('/login', function () {
    if (session()->has('isLogin'))
        return redirect('/');
    return view('login');
})->name('login');


Route::prefix('products')->group(function () {
    Route::get('/', function () {
        return view('category');
    })->name('category');
    Route::get('/{id}', function ($id) {
        return view('single-product', ['id' => $id]);
    })->name('single-product');
});
Route::middleware(['checkLogin'])->prefix("user")->name("user.")->group(function () {
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('cart', function () {
        return view('cart');
    })->name('cart');
    Route::get('checkout', function () {
        return view('checkout');
    })->name('checkout');
    Route::get('comfirm', function () {
        return view('confirmation');
    })->name('confirmation');
    Route::get('/logout', function () {
        session()->flush();
        return redirect()->route('index');
    })->name('logout');
});




