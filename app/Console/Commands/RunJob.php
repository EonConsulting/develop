<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ElasticSearchSetup;

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
            case "ElasticSearchSetup":
                ElasticSearchSetup::dispatch();
                break;
        }
    }
}
