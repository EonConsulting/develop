<?php
namespace EONConsulting\AnalyticsLogger;

use Illuminate\Support\ServiceProvider;

class AnalyticsLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';

        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/analytics-logger'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->make('EONConsulting\AnalyticsLogger\AnalyticsLoggerController');
    }
}
