<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Product\ProductController;

Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/login', function() {
    return view('admin.auth.login');
})->name('login');
Route::post('api/login', [AuthController::class, 'login']);

Route::get('/register', function() {
    return view('admin.auth.register');
})->name('register');
Route::post('api/register', [RegisterController::class, 'register']);

Route::post('api/logout', [AuthController::class, 'logout']);

Route::get('/product',function() {
    return view('admin.product.index');
})->name('product');
Route::get('api/products', [ProductController::class, 'index']);
