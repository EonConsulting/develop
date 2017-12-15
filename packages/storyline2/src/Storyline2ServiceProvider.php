<?php

namespace EONConsulting\Storyline2;

use Illuminate\Support\ServiceProvider;

class Storyline2ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.storyline2');

        $this->publishes([
            __DIR__.'/assets' => base_path('public/vendor/storyline2'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
