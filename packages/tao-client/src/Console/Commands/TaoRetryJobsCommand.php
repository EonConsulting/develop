<?php

namespace EONConsulting\TaoClient\Console\Commands;

use Illuminate\Console\Command;

use EONConsulting\TaoClient\Services\TaoApi;
use EONConsulting\TaoClient\Models\Tao\ResultIdentifiers;
use EONConsulting\TaoClient\Models\Tao\ResultsStorage;
use EONConsulting\TaoClient\Models\TaoResult;
use EONConsulting\TaoClient\Jobs\TaoResultJob;
use Log;

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

    protected $tao_api;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TaoApi $tao_api)
    {
        parent::__construct();

        $this->tao_api = $tao_api;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $tao_results = TaoResult::with(['result_identifier'])
            ->byFailed()
            ->get();

        foreach($tao_results as $integrate_tao_result)
        {

            if( ! $tao_storage = optional($integrate_tao_result->result_identifier)->result_storage)
            {
                $integrate_tao_result->status = 0;
                $integrate_tao_result->status_message = 'TaoResultJob: Test not completed on tao';

                $integrate_tao_result->save();

                Log::debug('TaoRetryJobsCommand: Test not completed on tao!');
                $this->error('TaoRetryJobsCommand: Test not completed on tao!');

                continue;
            }

            try {

                $tao_api_response = $this->tao_api->getLatestResults($tao_storage->test_taker, $tao_storage->delivery);

                $api_response = $tao_api_response->toArray();

            } catch(\Exception $e)
            {
                $integrate_tao_result->status = 0;
                $integrate_tao_result->status_message = 'TaoRetryJobsCommand: ' . $e->getMessage();

                $integrate_tao_result->save();

                Log::debug('TaoRetryJobsCommand: ' . $e->getMessage());
                $this->error('TaoRetryJobsCommand: ' . $e->getMessage());

                continue;
            }

            $integrate_tao_result->delivery_execution_id = $tao_storage->delivery;
            $integrate_tao_result->test_taker = $tao_storage->test_taker;
            $integrate_tao_result->response = $api_response;
            $integrate_tao_result->status = 1;
            $integrate_tao_result->status_message = 'API Response captured';

            $integrate_tao_result->save();

            $this->info('TaoRetryJobsCommand: result saved!');

        }

        $this->info('Finished retrying jobs.');
    }
}