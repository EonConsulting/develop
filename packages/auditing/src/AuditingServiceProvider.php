<?php

namespace EONConsulting\Auditing;

use EONConsulting\Core\Providers\AbstractServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AuditingServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'EONConsulting\Auditing';

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
        $this->loadViews('auditing');
        $this->registerRoutes();
        $this->bootBladeDirective();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function bootBladeDirective()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('d M Y H:i'); ?>";
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
