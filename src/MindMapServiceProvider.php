<?php namespace EONConsulting\MindMap;

use Illuminate\Support\ServiceProvider;

/**
 * Class MindMapServiceProvider
 * @package EONConsulting\MindMap
 */
class MindMapServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind( 'mindmap', function () {
            return MindMap;
        });
    }

    /**
     * What to boot with the package
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'mindmap');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ph');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/MindMap'), ], 'public');


        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
    }
}