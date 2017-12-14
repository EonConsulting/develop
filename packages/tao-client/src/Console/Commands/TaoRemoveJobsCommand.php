<?php

namespace EONConsulting\TaoClient\Console\Commands;

use Illuminate\Console\Command;
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
    protected $description = 'Clear tao results that was not completed.';

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
        $tao_results = TaoResult::byIncomplete()->get();

        $tao_results->each->delete();

        Log::info('Incomplete tests removed!');
        $this->info('Incomplete results removed!');
    }
}