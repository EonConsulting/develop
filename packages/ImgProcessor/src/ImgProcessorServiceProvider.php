<?php
/**
 * Created by PhpStorm.
 * User: jharing10, peacengara
 * Date: 2017/02/12
 * Time: 12:27 AM
 */

namespace EONConsulting\ImgProcessor;
use Illuminate\Support\ServiceProvider;

class ImgProcessorServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'imgprocessor', function () {
            return new ImgProcessor;
        });
    }


    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/imgprocessor'),
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'imgprocessor');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

}