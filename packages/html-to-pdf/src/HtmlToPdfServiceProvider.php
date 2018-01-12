<?php

namespace EONConsulting\HtmlToPdf;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;

class HtmlToPdfServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\HtmlToPdf';

    /**
     * This middleware will be applied to all your routes .
     *
     * @var array
     */
    protected $middleware = [
        'web', 'auth'
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/html-to-pdf.php' => config_path('html-to-pdf.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/resources/views', 'html-to-pdf');

        $this->registerRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/html-to-pdf.php', 'html-to-pdf'
        );
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
