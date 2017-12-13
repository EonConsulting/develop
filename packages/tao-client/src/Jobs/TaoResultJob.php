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
     * Unqiue tao
     *
     * \EONConsulting\TaoClient\Models\TaoResult
     */
    protected $tao_result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TaoResult $tao_result)
    {
        $this->tao_result = $tao_result;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(TaoApi $tao_api)
    {

        if( ! $tao_storage = optional($this->tao_result->result_identifier)->result_storage)
        {
            $this->tao_result->status = 0;
            $this->tao_result->status_message = 'TaoResultJob: Test not completed on tao';

            $this->tao_result->save();

            Log::debug('TaoResultJob: Test not completed on tao!');
            return false;
        }

        try {

            $tao_api_response = $tao_api->getLatestResults($tao_storage->test_taker, $tao_storage->delivery);

            $api_response = $tao_api_response->toArray();

        } catch(\Exception $e)
        {
            $this->tao_result->status = 0;
            $this->tao_result->status_message = 'TaoResultJob: ' . $e->getMessage();

            $this->tao_result->save();

            Log::debug('TaoResultJob: ' . $e->getMessage());
            return false;
        }

        $this->tao_result->delivery_execution_id = $tao_storage->delivery;
        $this->tao_result->test_taker = $tao_storage->test_taker;
        $this->tao_result->response = $api_response;
        $this->tao_result->status = 1;
        $this->tao_result->status_message = 'API Response captured';

        $this->tao_result->save();
    }

}
