<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ProductController;

// Home and Static Pages
Route::get('/', fn() => view('welcome'));
Route::get('/how_to_use', fn() => view('how_to_use'));

// Authentication Routes (disabled registration and password reset)
Auth::routes(['register' => false, 'reset' => false]);

// Pet Management Routes
Route::post('/pet_founded', [PetController::class, 'pet_founded'])->name('pet_founded');
Route::post('/send_number', [PetController::class, 'send_number'])->name('send_number');
Route::get('/identify/{token}', [PetController::class, 'identify']);
Route::get('/missing', [PetController::class, 'missing'])->name('pets.missing');
Route::post('/set_missing_status', [PetController::class, 'set_missing_status'])->name('pets.set_missing_status');
Route::post('/set_status', [PetController::class, 'set_status'])->name('pets.set_status');
Route::resource('pets', PetController::class)->names(['index' => 'pets']);

// User Management Routes
Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [UserController::class, 'updatePassword'])->name('update-password');
Route::get('users/profile/complete', [UserController::class, 'complete'])->name('complete');
Route::post('users/activate', [UserController::class, 'activate'])->name('activate');
Route::post('/questions', [UserController::class, 'questions'])->name('questions');
Route::resource('users', UserController::class)->names(['index' => 'users']);

// Product Routes
Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product', [ProductController::class, 'product'])->name('products.product');

// Cart Routes
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('finish-cart', [CartController::class, 'finishCart'])->name('cart.finish');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

// QR Code Routes
Route::get('/qr/{id}', [QrCodeController::class, 'index'])->name('qr');
