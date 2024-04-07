<?php

namespace Izica\EnvSecure;

use Illuminate\Support\ServiceProvider;
use Izica\EnvSecure\Commands\EnvSecureCommand;

class EnvSecureServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/env-secure.php' => config_path('env-secure.php'),
            ], 'config');
            $this->commands([
                EnvSecureCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/env-secure.php', 'env-secure');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-env-secure', function () {
            return new EnvSecure();
        });
    }
}
