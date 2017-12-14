<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\AnalyticsLogIngester;
use App\Jobs\ElasticIndexAssets;
use App\Jobs\ElasticIndexContent;
use App\Jobs\ElasticIndexCourseInfo;
use App\Jobs\ElasticSearchSetup;
use App\Jobs\ElasticSearchRefresh;


class RunJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:runjob {jobname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a job by class name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        switch ($this->argument("jobname"))
        {
            case "AnalyticsLogIngester":
                AnalyticsLogIngester::dispatch();
                break;
            case "ElasticSearchRefresh":
                ElasticSearchRefresh::dispatch();
                break;
            case "ElasticIndexAssets":
                ElasticIndexAssets::dispatch();
                break;
            case "ElasticIndexContent":
                ElasticIndexContent::dispatch();
                break;
            case "ElasticIndexCourseInfo":
                ElasticIndexCourseInfo::dispatch();
                break;
            case "ElasticSearchSetup":
                ElasticSearchSetup::dispatch();
                break;
        }
    }
}
