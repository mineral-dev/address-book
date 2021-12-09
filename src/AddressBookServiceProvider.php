<?php

namespace Mineral\AddressBook;

use Illuminate\Support\ServiceProvider;

class AddressBookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('address-book.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'address-book');

        // Register the main class to use with the facade
        $this->app->singleton('address-book', function () {
            return new AddressBook;
        });
    }
}
