<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/22
 * Time: 12:53 PM
 */

namespace EONConsulting\Storyline\Menu;


use Illuminate\Support\ServiceProvider;

class StorylineMenuServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_menu', function () {
            return new StorylineMenu;
        });
    }

    public function boot() {
        $this->views();
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.menu');
    }

}