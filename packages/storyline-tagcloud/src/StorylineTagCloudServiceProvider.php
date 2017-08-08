<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 12:07 PM
 */

namespace EONConsulting\Storyline\TagCloud;


use Illuminate\Support\ServiceProvider;

class StorylineTagCloudServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_tag_cloud', function () {
            return new StorylineTagCloud();
        });
    }

    public function boot() {
        $this->views();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/storyline/tagcloud'),
        ], 'public');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'eon.tagcloud');
    }

}