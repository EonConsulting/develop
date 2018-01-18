<?php

namespace EONConsulting\Exports;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;

class ExportServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\Exports';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViews('eon.exports');
        $this->loadMigrations();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the pat of this package
     *
     * @return string
     */
    protected function getPackageFolder()
    {
        return realpath(__DIR__);
    }
}