<?php



use Illuminate\Support\Facades\Route;

Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/login', function() {
    return view('admin.auth.login');
})->name('login');

Route::get('/register', function() {
    return view('admin.auth.register');
})->name('register');

Route::get('/product',function() {
    return view('admin.product.index');
})->name('product');
Route::get("/product/{id}", function($id) {
    return view("admin.product.detail",['id' => $id]);
})->name('product-detail');

Route::get("/order", function(){
    return view('admin.order.index');
})->name('order');