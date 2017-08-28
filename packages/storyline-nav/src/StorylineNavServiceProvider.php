<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/23
 * Time: 11:52 AM
 */

namespace EONConsulting\Storyline\Nav;

use Illuminate\Support\ServiceProvider;

class StorylineNavServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_nav', function () {
            return new StorylineNav;
        });
    }

    public function boot() {
        $this->views();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/storyline/nav'),
        ], 'public');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.nav');
    }

}