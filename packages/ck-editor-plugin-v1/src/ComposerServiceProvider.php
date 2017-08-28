<?php namespace EONConsulting\CKEditorPlugin;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //View::composer(['plugin','cklaunch'], 'EONConsulting\CKEditorPlugin\ViewComposers\ListDomainsComposer');

        //$this->app->make('view')->composer('plugins', 'EONConsulting\CKEditorPlugin\ViewComposers\ListDomainsComposer');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
