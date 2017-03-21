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
        $this->app->bind( 'phpstencil', function () {
            return new PHPStencil();
        });
    }

    /**
     * What to boot with the package
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/Factories/WebService/Routes/routes_rest.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'phpstencil');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ph');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
    }
}