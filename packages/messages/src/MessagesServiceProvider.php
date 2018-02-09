<?php

namespace EONConsulting\Messages;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;

class MessagesServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\Messages';

    /**
     * This middleware will be applied to all your routes .
     *
     * @var array
     */
    protected $middleware = [
        'web', 'auth'
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Illuminate\Notifications\DatabaseNotification' => 'EONConsulting\Messages\Policies\DatabaseNotificationPolicy',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews('messages');
        $this->registerRoutes();
        $this->loadMigrations();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPolicies();
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
