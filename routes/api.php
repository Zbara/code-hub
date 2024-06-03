<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'logout');
    });
});

Route::prefix('posts')->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{post}', 'show');
    });
});
