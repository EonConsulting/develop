<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/25
 * Time: 10:07 AM
 */

namespace EONConsulting\Storyline\Search;


use Illuminate\Support\ServiceProvider;

class StorylineSearchServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->singleton( 'storyline_search', function () {
            return new StorylineSearch();
        });
    }

    public function boot() {

    }

}