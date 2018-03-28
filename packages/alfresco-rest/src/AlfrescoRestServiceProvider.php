<?php

namespace EONConsulting\Alfresco\Rest;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;
use EONConsulting\Alfresco\Rest as ARC;
use GuzzleHttp\Client as GuzzleClient;

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
            __DIR__.'/config/alfresco.php' => config_path('alfresco.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/alfresco.php', 'alfresco'
        );
        
        $this->app->bind(ARC\AlfrescoRest::class, function($app){
            return new AlfrescoRest(new GuzzleClient([
                // Base URI is used with relative requests
                'base_uri' => config('alfresco.api-base-url'),
                // You can set any number of default request options.
                'timeout' => 2.0, // 2 minutes
            ])); //, config('alfresco-rest'));
        });

        
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
