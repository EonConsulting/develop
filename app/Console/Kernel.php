<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use EONConsulting\ContentBuilder\Jobs\Bulk\AssetsElasticUpdate;
use EONConsulting\ContentBuilder\Jobs\Bulk\ContentsElasticUpdate;
use EONConsulting\Storyline2\Jobs\Bulk\CoursesElasticUpdate;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('taoclient:retry-jobs')->everyTenMinutes();
        $schedule->command('taoclient:remove-jobs')->daily();
        $schedule->command('jobs:runjob AnalyticsLogIngester')->everyMinute();


        $schedule->job(new AssetsElasticUpdate)->hourly();
        $schedule->job(new ContentsElasticUpdate)->hourly();
        $schedule->job(new CoursesElasticUpdate)->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
