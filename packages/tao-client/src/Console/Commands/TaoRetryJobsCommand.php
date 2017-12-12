<?php

namespace EONConsulting\TaoClient\Console\Commands;

use Illuminate\Console\Command;

use EONConsulting\TaoClient\Models\TaoResult;
use EONConsulting\TaoClient\Jobs\TaoResultJob;

class TaoRetryJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taoclient:retry-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry jobs with no results';

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

        $tao_results = TaoResult::byFailed()->get();

        foreach($tao_results as $result)
        {
            TaoResultJob::dispatch($result->lis_result_sourcedid);
        }

        $this->info('Finished retrying jobs.');
    }
}