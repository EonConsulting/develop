<?php

namespace EONConsulting\Storyline2;

use Illuminate\Support\ServiceProvider;
use EONConsulting\Storyline2\Middleware\ContentLocked as ContentLockedMiddleware;

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

        $this->bootMiddleware();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function bootMiddleware()
    {
        app('router')->aliasMiddleware('content_locked', ContentLockedMiddleware::class);
    }
}
