<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
    Route::resource('users', UserController::class, ['middleware' => 'auth:sanctum'])->only([
        'index', 'update', 'show', 'destroy'
    ]);
    Route::post('/users/logout', [UserController::class, 'logout']);
});

// Public routes
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/login', [UserController::class, 'login']);



