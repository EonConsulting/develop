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
            __DIR__ . '/migrations' => $this->app->databasepath() . '/migrations'], 'migrations');

        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('EONConsulting\AnalyticsLogger\AnalyticsLoggerController');
    }
}
