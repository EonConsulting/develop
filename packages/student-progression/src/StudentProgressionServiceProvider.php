<?php

/**
 * @package  Storyline Table
 * @author   Reginald Bossman <reggiestain@gmail.com>
 * @version  $Revision: 1.0 $
 * @since    1.0
 *
 */

namespace EONConsulting\Student\Progression;

use Illuminate\Support\ServiceProvider;

class StudentProgressionServiceProvider extends ServiceProvider {

    public function boot() {

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'student-progression');
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/student-progression'),
                ], 'public');
    }

    public function register() {
    }

}
