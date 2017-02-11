<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:27 AM
 */

namespace EONConsulting\AppStore;


use Illuminate\Support\ServiceProvider;

class AppStoreServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'app_store', function () {
            return new AppStore;
        });
    }


    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/appstore'),
        ], 'public');
    }

    private function publishMigrations() {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getMigrationsPath() {
        return __DIR__ . '/database/migrations/';
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.appstore');
    }

}