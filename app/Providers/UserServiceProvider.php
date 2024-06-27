<?php

namespace App\Providers;

use App\Services\CepService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, fn ($app) => new UserService($app->make(CepService::class)));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
