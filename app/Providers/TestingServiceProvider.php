<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
//        dd('i am now registered');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//        dd('all service provider registered. Now i will be executed');
    }
}
