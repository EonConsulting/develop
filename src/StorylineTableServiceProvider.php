<?php

namespace EONConsulting\Storyline\Table;

use Illuminate\Support\ServiceProvider;
//use EONConsulting\Csv\Reader\Commands\Export;
//use EONConsulting\Csv\Reader\Commands\Import;

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
