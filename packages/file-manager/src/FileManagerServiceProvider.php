<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/21
 * Time: 10:40 PM
 */

namespace EONConsulting\FileManager;


use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'file_manager', function () {
            return new FileManager;
        });
    }


    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/filemanager'),
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.filemanager');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

}