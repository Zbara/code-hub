<?php

use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\App;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/testDataApp',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /**
         * We display an error if this is a web environment
         */
        if (!App::runningInConsole()) {
            $exceptions->renderable(function (InvalidFormatException $e) {
                return response()->json([
                    'error' => 'Invalid date format. Please provide a valid date.',
                ], 422);
            });
        }
    })->create();
