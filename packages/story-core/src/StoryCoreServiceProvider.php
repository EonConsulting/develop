<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\StoryCore;


use Illuminate\Support\ServiceProvider;

class StoryCoreServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storycore', function () {
            return new StoryCore;
        });
    }

    public function boot() {
//        $this->publishes([
//            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations'
//        ], 'migrations');
//        $this->publishes([
//            __DIR__ . '/database/seeds' => $this->app->databasePath() . '/seeds'
//        ], 'seeders');

        $this->routes();
        $this->views();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/storycore'),
        ], 'public');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.lti');
    }

}