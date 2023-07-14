<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::post('/users/logout', [UserController::class, 'logout']);

    Route::apiResource('category', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('cart', CartController::class);

    Route::prefix('stripe')
        ->controller(PaymentController::class)
        ->group(function () {
            Route::get('payment', 'index');
            Route::post('payment', 'store');
        });
});

// Public routes
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);



