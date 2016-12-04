<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:08 AM
 */

namespace EONConsulting\PHPSaasWrapper\src;


use Illuminate\Support\ServiceProvider;

class PHPSaasWrapperServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( 'phpsaaswrapper', function () {
            return new PHPSaasWrapper;
        });
    }

    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/database/seeds' => $this->app->databasePath() . '/seeds'
        ], 'seeders');
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views'),
        ]);
    }

}