<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'logout');
    });
});

Route::controller(RegisterController::class)->prefix('register')->group(function () {
    Route::post('/', 'register');
    Route::get('/verify/{id}', 'verify')->name('verification.verify');
    Route::post('/sendNewCode', 'sendNewCode');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/getUser', [UserController::class, 'getUser']);

    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'index');
        Route::get('/{post}', 'show');
    });
});
