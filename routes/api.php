<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{post}', 'show');
    });
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
