<?php

namespace Hosein\Sliders;

use Illuminate\Support\ServiceProvider;

class SlidersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'SliderView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/SliderView'),
        ],"sliderview");
        $this->publishes([
            __DIR__.'/Migrations' => database_path('/migrations')
        ], 'slidermigrations');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
}
