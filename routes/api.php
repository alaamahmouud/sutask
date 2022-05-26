<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});

Route::group(['namespace'=>'Api'], function () {

   //Auth
    Route::post('login', [UserController::class,'login']);
    Route::post('register', [UserController::class,'register']);

    //products
    Route::get('products', [ProductController::class,'index']);
    Route::get('products/{id}/show', [ProductController::class,'show']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('products/{id}/rate', [ProductController::class,'rate']);

    // cart
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/{id}/add', [CartController::class, 'store']);

    // checkout
    Route::get('checkout', [OrderController::class, 'store']);
    });
    // Route::get('category_services/{id}', [CategoriesController::class,'CategoryServices']);
    // Route::get('servicedetails/{id}', [CategoriesController::class,'servicedetails']);


    Route::get('payment/callback', [OrderController::class, 'callback'])->name('payment.callback');

    Route::fallback(function(){
        return response()->json(['message' => 'Not Found!'], 404);
    });
});
