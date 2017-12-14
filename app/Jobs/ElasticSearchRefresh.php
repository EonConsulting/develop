<?php

namespace App\Jobs;

use App\Jobs\ElasticSearchSetup;
use App\Jobs\ElasticIndexCourseInfo; 
use App\Jobs\ElasticIndexContent; 
use App\Jobs\ElasticIndexAssets;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;

class ElasticSearchRefresh implements ShouldQueue {
    
    use Dispatchable,
    InteractsWithQueue,
    Queueable,
    SerializesModels;

    // how many times the job should be retried
    public $tries = 1;
    private $client = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function handle(){
        
        ElasticSearchSetup::dispatch();

        ElasticIndexCourseInfo::dispatch(true);
        ElasticIndexContent::dispatch(true);
        ElasticIndexAssets::dispatch(true);

    }

}
