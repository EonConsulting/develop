<?php

namespace EONConsulting\Alfresco\Rest;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;
use EONConsulting\Alfresco\Rest\Classes\AlfrescoRest;
use GuzzleHttp\Client;

class AlfrescoRestServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\Alfresco\Rest';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/alfresco-rest.php' => config_path('alfresco-rest.php'),
        ]);

        //$this->loadViews('html-to-pdf');
        //$this->registerRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $x = config('alfresco-rest');
        $this->app->bind(AlfrescoRest::class, function($app){
            return new AlfrescoRest(new Client([
                // Base URI is used with relative requests
                'base_uri' => config('alfresco-rest.api-base-url'),
                // You can set any number of default request options.
                'timeout' => 2.0, // 2 minutes
            ]), config('alfresco-rest'));
        });

        //$this->mergeConfigFrom(
        //    __DIR__.'/config/alfresco-rest.php', 'alfresco-rest'
        //);
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
