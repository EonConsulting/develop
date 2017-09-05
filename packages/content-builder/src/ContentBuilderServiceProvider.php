<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ContentBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.content-builder');

        $this->publishes([
            __DIR__.'/assets' => base_path('public/vendor/content-builder'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
