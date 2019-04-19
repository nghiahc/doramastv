<?php

namespace App\Providers;

use App\Services\MovieService;
use Illuminate\Support\ServiceProvider;

class DeferredServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function provides()
    {
        return [
            MovieService::class
        ];
    }

    public function register()
    {
        $this->app->singleton(
            MovieService::class,
            function () {
                return new MovieService(env('BACKEND_HOST', '127.0.0.1'), env('BACKEND_PORT', '8080'));
            }
        );
    }
}
