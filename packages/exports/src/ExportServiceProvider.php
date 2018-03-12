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
     * This middleware will be applied to all your routes .
     *
     * @var array
     */
    protected $middleware = [
        'web', 'auth'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews('exports');
        $this->registerRoutes();
        $this->loadCommands();
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