<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Customer\CustomerController;

// ================== ADMIN/USER ==================
Route::prefix('admin/auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']); // Admin register
    Route::post('/login', [AuthController::class, 'login']); // Admin login

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [UserController::class, 'profile'])->middleware('checkUserIsActive'); // Admin profile
    });
});

Route::middleware(['auth:admin','checkUserIsActive'])->prefix('admin/products')->group(function () {
    Route::post('/', [ProductController::class, 'create']); 
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::middleware(['auth:admin','checkUserIsActive'])->prefix('admin/users')->group(function () {
    Route::put('/{id}/status', [UserController::class, 'updateStatus']);
    // Route::get('/test', [RegisterController::class, 'test']); // test route
});

// ================== CUSTOMER ==================
Route::prefix('customer')->group(function () {
    // Route::get('/test', [RegisterController::class, 'test']); // test route
    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login', [CustomerController::class, 'login']);

    Route::middleware(['auth:customer'])->group(function () {
        Route::post('/logout', [CustomerController::class, 'logout']);
        Route::get('/me', [CustomerController::class, 'profile']); // Customer profile
        Route::put('/profile/update', [CustomerController::class, 'updateProfile']); // Customer profile
    });
});

// ================== PRODUCT PUBLIC ==================
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
});
