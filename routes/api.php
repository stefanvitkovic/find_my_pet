<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PetController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProductController;

Route::prefix('v1')->name('api.')->group(function () {

    // Authentication Routes
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('login', [AuthController::class,'login']);

    Route::middleware(['auth:sanctum'])->group(function() {

        // User Management Routes
        Route::apiResource('users', UserController::class);
        Route::post('users/default', [UserController::class,'store_default']);

        // Pet Management Routes
        Route::post('pets/founded', [PetController::class, 'pet_founded'])->name('pet_founded');
        Route::put('pets/{id}/photo',[PetController::class, 'store_photo']);
        Route::post('pets/send_number', [PetController::class, 'send_number'])->name('send_number');
        Route::get('pets/missing',[PetController::class,'missing'])->name('pets.missing');
        Route::post('pets/set_missing_status',[PetController::class,'set_missing_status'])->name('pets.set_missing_status');
        Route::post('pets/set_status',[PetController::class,'set_status'])->name('pets.set_status');
        Route::apiResource('pets', PetController::class);
    });

    // Product Routes
    Route::get('products',[ProductController::class,'index']);
    Route::get('products/{product}',[ProductController::class,'show']);

});


