<?php namespace EONConsulting\CKEditorPlugin;

use Illuminate\Support\ServiceProvider;
use EONConsulting\CKEditorPlugin\Http\Controllers\ListDomainsController;


/**
 * Class CKEditorPlugin
 * @package EONConsulting\CKEditorPlugin
 */
class CKEditorPluginServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton( 'ckeditorplugin', function () {
            return new CKEditorPlugin();
        });
       // View::composer(['plugin','cklaunch'], 'CKEditorPlugin');
    }

    /**
     * What to boot with the package
     */
    public function boot() {
        $this->publishMigrations();
        $this->views();
        $this->routes();
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/ckeditorplugin'),
        ], 'public');
    }

    private function publishMigrations() {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getMigrationsPath() {
        return __DIR__ . '/database/migrations/';
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'ckeditorplugin' );
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}