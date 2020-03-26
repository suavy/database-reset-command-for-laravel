<?php

namespace Suavy\DatabaseResetCommandForLaravel;

use Illuminate\Support\ServiceProvider;
use Suavy\DatabaseResetCommandForLaravel\app\Console\Commands\DatabaseReset;

class DatabaseResetCommandForLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'database-reset-command-for-laravel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'database-reset-command-for-laravel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            /*$this->publishes([
                __DIR__.'/../config/config.php' => config_path('database-reset-command-for-laravel.php'),
            ], 'config');*/

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/database-reset-command-for-laravel'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/database-reset-command-for-laravel'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/database-reset-command-for-laravel'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                DatabaseReset::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'database-reset-command-for-laravel');

        // Register the main class to use with the facade
        $this->app->singleton('database-reset-command-for-laravel', function () {
            return new DatabaseResetCommandForLaravel;
        });
    }
}
