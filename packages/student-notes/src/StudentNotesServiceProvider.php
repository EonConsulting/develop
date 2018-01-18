<?php

namespace EONConsulting\StudentNotes;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;

class StudentNotesServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\StudentNotes';

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
        $this->registerRoutes();
        $this->loadMigrations();
        $this->loadViews('student-notes');
    }

    /**
     * Register any application services.
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
