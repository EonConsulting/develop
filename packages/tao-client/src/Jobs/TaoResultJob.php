<?php

namespace EONConsulting\TaoClient\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EONConsulting\TaoClient\Services\TaoApi;
use EONConsulting\TaoClient\Models\TaoResult;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

class TaoResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Unique tao reference number
     *
     * @var $unique_reference
     */
    protected $unique_reference;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($unique_reference)
    {
        $this->unique_reference = $unique_reference;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(TaoApi $tao_api)
    {

        try {

            $integrate_tao_result = TaoResult::with(['result_identifier'])
                ->bySourceId($this->unique_reference)
                ->byPendingApi()
                ->firstOrFail();

        } catch(ModelNotFoundException $e)
        {
            Log::debug('TaoResultJob: ' . $e->getMessage());
            return false;
        }

        if( ! $tao_storage = optional($integrate_tao_result->result_identifier)->result_storage)
        {
            $integrate_tao_result->status = 0;
            $integrate_tao_result->status_message = 'TaoResultJob: Test not completed on tao';

            $integrate_tao_result->save();

            Log::debug('TaoResultJob: Test not completed on tao!');
            return false;
        }

        try {

            $tao_api_response = $tao_api->getLatestResults($tao_storage->test_taker, $tao_storage->delivery);

            $api_response = $tao_api_response->toArray();

        } catch(\Exception $e)
        {
            $integrate_tao_result->status = 0;
            $integrate_tao_result->status_message = 'TaoResultJob: ' . $e->getMessage();

            $integrate_tao_result->save();

            Log::debug('TaoResultJob: ' . $e->getMessage());
            return false;
        }

        $integrate_tao_result->delivery_execution_id = $tao_storage->delivery;
        $integrate_tao_result->test_taker = $tao_storage->test_taker;
        $integrate_tao_result->response = $api_response;
        $integrate_tao_result->status = 1;
        $integrate_tao_result->status_message = 'API Response captured';

        $integrate_tao_result->save();
    }

}