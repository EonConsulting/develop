<?php

namespace EONConsulting\Core;

use Illuminate\Support\ServiceProvider;

class eContentCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // this is a class library, we have no views or other resources
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
