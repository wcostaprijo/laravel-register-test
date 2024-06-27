<?php

namespace App\Providers;

use App\Services\CepService;
use Illuminate\Support\ServiceProvider;

class CepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CepService::class, fn() => new CepService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
