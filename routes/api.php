<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Admin\AdminOrderController;
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


Route::middleware(['auth:admin','checkUserIsActive'])->prefix('admin/users')->group(function () {
    Route::put('/{id}/status', [UserController::class, 'updateStatus']);
    // Route::get('/test', [RegisterController::class, 'test']); // test route
});

Route::middleware(['auth:admin','checkUserIsActive'])->prefix('admin/products')->group(function () {
    Route::post('/', [ProductController::class, 'create']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

/**
 *  ===== ADMIN - ORDER =====
 *  index --> list all orders from db
 *  getById --> available 
 *  confirm --> change order status from 'pending' to 'confirmed' --> check and update stock --> handle transaction with 2 operations.
 *  cancel --> change order status from 'pending' to 'cancelled'.
 */

Route::middleware(['auth:admin','checkUserIsActive'])->prefix('admin/orders')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index']); // all order
    Route::get('/{id}', [AdminOrderController::class, 'getById']); // order id
    Route::put('/{id}/confirm', [AdminOrderController::class, 'confirm']); // approve order
    Route::put('/{id}/cancel', [AdminOrderController::class, 'cancel']); // cancel order
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

/**
 *  ===== CUSTOMER - ORDER =====
 *  myOrders --> list all orders of current customer --> based on token customer by sanctum in request.
 *  getById --> get order by id --> need to check if order belongs to current customer ????.
 *  create --> create new order --> authenticated.
 *  update --> update order --> authenticated + order belongs to current customer + order status is 'pending'.
 */
Route::middleware(['auth:customer'])->prefix('customer/orders')->group(function () {
    Route::get('/', [OrderController::class, 'myOrders']); // all orders of current customer
    Route::get('/{id}', [OrderController::class, 'getById']); // order id
    Route::post('/', [OrderController::class, 'create']); // create order
    Route::put('/{id}', [OrderController::class, 'update']); // update order
});

// ================== PRODUCT PUBLIC ==================
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'getById']);
});

