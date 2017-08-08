<?php
/**
 * Created by PhpStorm.
 * User: jharing10, peacengara
 * Date: 2017/02/12
 * Time: 12:27 AM
 */

namespace EONConsulting\CKEditorPluginV2;
use EONConsulting\CKEditorPlugin\Http\Controllers\ListDomainsController;

use Illuminate\Support\ServiceProvider;

class CKEditorPluginV2ServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'ckeditorpluginv2', function () {
            return new CKEditorPluginV2;
        });

    }


    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/ckeditorpluginv2'),
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'ckeditorpluginv2');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

}