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

<<<<<<< HEAD
Route::middleware([])->prefix('dashboard')->name("dashboard.")->group(function () {
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
        Route::get('edit', function () {
            return view('dashboard.account.create');
        });
    });
    // Gọi Route của product về view index
    Route::name('product.')->prefix('product')->group(function () {
        Route::get('/', function () {
            return view('dashboard.product.index');
        })->name('index');
        Route::get('create', function () {
            return view('dashboard.product.create');
        })->name('create');
        Route::get('edit', function () {
            return view('dashboard.product.edit');
        });
    });
});
=======

>>>>>>> 63e7ca1f81320d61e2f2fb95d8273c611e4650c0


