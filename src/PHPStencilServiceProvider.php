<?php namespace EONConsulting\PHPStencil;

use Illuminate\Support\ServiceProvider;

class PHPStencilServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'phpstencil', function () {
            return new PHPStencil();
        });

        /* $this->mergeConfigFrom(
             __DIR__ . '/config/boilerplate.php', 'boilerplate'
         );*/
    }

    public function boot()
    {
        // Configuring with main route file
        // Loading package view files directly from vendor directory as
//        require __DIR__ . '/../Http/routes.php';
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'phpstencil');

        // Publishing packages views to /views
//        $this->publishes([
//            __DIR__ . '/views' => base_path('resources/views'),
//        ]);

        // Publishing config file to /config
//        $this->publishes([
//            __DIR__ . '/config' => config_path(),
//        ]);

        // Publishing Migration File
//        $this->publishes([
//            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
//        ], 'migrations');

        // Publishing seeds file
//        $this->publishes([
//            __DIR__ . '/seeds' => $this->app->databasePath() . '/seeds'
//        ], 'seeds');
    }
}