<?php

namespace App\Providers;

use App\Contracts\RegisterUserInterface;
use App\Services\RegisterUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisterUserInterface::class => RegisterUserService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
