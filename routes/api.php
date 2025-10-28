<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('test', [RegisterController::class, 'test']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('products')->group(function () {
    Route::get('/',[ProductController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/create',[ProductController::class,'create']);
    });
});

