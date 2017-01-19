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

    }

}