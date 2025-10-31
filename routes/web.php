<?php

use App\Http\WebControllers\AuthController;
use App\Http\WebControllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// });

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('register', [RegisterController::class, 'register']);