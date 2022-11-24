<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
});
Route::get('/register',function(){
    return view('register');
});


Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('category', function(){
    return view('category');
})->name('category');

Route::get('category/{id}',function($id){
    return view('single-product',['id'=>$id]);
})->name('single-product');

Route::middleware(['auth'])->prefix("user")->name("user.")->group(function () {
    Route::get('profile',function(){
        return view('profile');
    });
    Route::get('cart',function(){
        return view('cart');
    });
    Route::get('checkout',function(){
        return view('checkout');
    });
    Route::get('comfirm',function(){
        return view('confirmation');
    });
});




Route::middleware(['dashboard'])->prefix("dashboard")->name("dashboard.")->group(function () {
    Route::get('/',function(){
        return view('profile');
    });
    Route::get('products',function(){
        return view('cart');
    });

    Route::get('checkout',function(){
        return view('checkout');
    });
    Route::get('comfirm',function(){
        return view('confirmation');
    });
});
