<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\ProductoptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('products', ProductsController::class);
//Route::resource('orders', OrderController::class);
//Route::resource('categories', CategoryController::class);
Route::resource('carts', CartsController::class);
//Route::resource('oderdetails', OrderdetailsController::class);
Route::resource('users', UserController::class);
Route::resource('options',OptionsController::class);
Route::resource('productoptions',ProductoptionsController::class);
Route::get('product', [ProductsController::class, 'getProducts']);
Route::get('productIndex',[ProductsController::class,'productIndex']);
Route::get('sort', [ProductsController::class, 'sortDesc']);
Route::post('/loginApi', [UserController::class, 'login'])->name('loginApi');
Route::post('deleteAll',[CartsController::class,'deleteAll'])->name('deleteAll');

Route::post('/registerApi', [UserController::class, 'store'])->name('registerApi');

Route::get('/search', [ProductsController::class, 'SearchProduct']);
