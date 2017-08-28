<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/30
 * Time: 9:28 AM
 */

namespace EONConsulting\Storyline\Breadcrumbs;


use Illuminate\Support\ServiceProvider;

class StorylineBreadcrumbServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_breadcrumbs', function () {
            return new StorylineBreadcrumbs;
        });
    }

    public function boot() {
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/storyline/breadcrumbs'),
        ], 'public');
    }

}