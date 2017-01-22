<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline\Core;


use Illuminate\Support\ServiceProvider;

class StorylineCoreServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_core', function () {
            return new StorylineCore;
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
            __DIR__.'/assets' => public_path('vendor/storyline/core'),
        ], 'public');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.lti');
    }

}