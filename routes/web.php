<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    dd(generateSlug(App\Models\Post\Post::class, 'test', 0));

    return view('welcome');
});
