<?php namespace EONConsulting\Graphs;

use Illuminate\Support\ServiceProvider;

/**
 * Class PHPStencilServiceProvider
 * @package EONConsulting\InteractiveGraphs
 */
class GraphsServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton( 'graphs', function () {
            return new Graphs;
        });

    }

    /**
     * What to boot with the package
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'graphs');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ph');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
    }
}