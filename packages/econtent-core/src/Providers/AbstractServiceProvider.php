<?php

namespace EONConsulting\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Console\Application as Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use ReflectionClass;
use Illuminate\Support\Facades\Gate;

abstract class AbstractServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * Middleware to be used for all routes
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Prefix to be added to all routes
     *
     * @var string
     */
    protected $route_prefix = '';

    /**
     * The policy mappings for this package.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Abstract method that must be registered in classes that use this abstract class
     */
    abstract protected function getPackageFolder();

    /**
     * Register all the commands by scanning the commands folder in the package
     *
     * @param $paths
     */
    protected function loadCommands()
    {
        if ( ! $this->app->runningInConsole()) {
            return;
        }

        $paths = $this->getPackageFolder() . '/Console/Commands';

        $paths = array_unique(is_array($paths) ? $paths : (array) $paths);

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });

        if (empty($paths)) {
            return;
        }

        foreach ((new Finder)->in($paths)->files() as $command)
        {
            $command = $this->namespace.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($command->getPathname(), $this->getPackageFolder())
                );

            if (is_subclass_of($command, Command::class) && ! (new ReflectionClass($command))->isAbstract())
            {
                Artisan::starting(function ($artisan) use ($command) {
                    $artisan->resolve($command);
                });
            }
        }
    }

    /**
     * Register the routes using the routes Facade
     */
    protected function registerRoutes()
    {
        Route::middleware($this->middleware)
            ->namespace($this->namespace . '\Http\Controllers')
            ->prefix($this->route_prefix)
            ->group($this->getPackageFolder() .'/routes/web.php');
    }

    /**
     * Load resource view files
     *
     * @param $namespace
     */
    protected function loadViews($namespace)
    {
        $this->loadViewsFrom($this->getPackageFolder() . '/resources/views', $namespace);
    }

    /**
     * Load database migrations from package root folder
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom($this->getPackageFolder() . '/../database/migrations');
    }

    /**
     * Register package specific policies
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $model => $policy)
        {
            Gate::policy($model, $policy);
        }
    }

}