<?php

/**
 *@package  Storyline Table
 *@author   Reginald Bossman <reggiestain@gmail.com>
 *@version  $Revision: 1.0 $
 *@since    1.0
 *
 */

namespace EONConsulting\Storyline\Table;

use Illuminate\Support\ServiceProvider;

class StorylineTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/csvfileupload'),
        ],'public');

            require __DIR__.'/Http/routes.php';
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'fileupload');
    }

    public function register()
    {
        \App::bind('reader', function () {
            return new Reader();
        });

        \App::bind('writer', function () {
            return new Writer();
        });


    }
}
