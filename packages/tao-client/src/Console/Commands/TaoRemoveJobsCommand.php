<?php

namespace EONConsulting\TaoClient\Console\Commands;

use Illuminate\Console\Command;

use EONConsulting\TaoClient\Services\TaoApi;
use EONConsulting\TaoClient\Models\Tao\ResultIdentifiers;
use EONConsulting\TaoClient\Models\Tao\ResultsStorage;
use EONConsulting\TaoClient\Models\TaoResult;
use Log;

class TaoRemoveJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taoclient:remove-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $tao_results = TaoResult::byIncomplete()->get();

        $tao_results->each->delete();

        $this->info('Incomplete results removed!');

    }
}