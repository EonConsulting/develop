<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ElasticSearchSetup implements ShouldQueue {

    // how many times the job should be retried
    public $tries = 1;
    protected $courses_map;
    protected $content_map;
    protected $settings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        // init vars
        $this->courses_map = [
            "courses" => [
                "dynamic" => "true",
                "properties" => [
                    "suggest" => [
                        "type" => "completion"
                    ],
                    "id" => [
                        "type" => "integer"
                    ],
                    "title" => [
                        "type" => "string",
                        "analyzer" => "autocomplete"
                    ],
                    "description" => [
                        "type" => "string",
                        "analyzer" => "autocomplete"
                    ]
                ]
            ]
        ];

        $this->content_map = [
            "content" => [
                "dynamic" => "true",
                "properties" => [
                    "suggest" => [
                        "type" => "completion"
                    ],
                    "id" => [
                        "type" => "integer"
                    ],
                    "title" => [
                        "type" => "string",
                        "analyzer" => "autocomplete"
                    ],
                    "description" => [
                        "type" => "string",
                        "analyzer" => "autocomplete"
                    ],
                    "body" => [
                        "type" => "string",
                        "analyzer" => "autocomplete"
                    ],
                    "tags" => [
                        "type" => "string"
                    ]
                ]
            ]
        ];

        $this->settings = [
            "analysis" => [
                "filter" => [
                    "type" => "edge_ngram", //edge_ngram or ngram
                    "min_gram" => 3,
                    "max_gram" => 20
                ],
                "analyzer" => [
                    "autocomplete" => [
                        "type" => "custom",
                        "tokenizer" => "standard",
                        "filter" => [
                            "lowercase",
                            "autocomplete_filter"
                        ]
                    ]
                ]
            ],
            "mappings" => $this->mappings
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        echo "test";
        //ProcessPodcast::dispatch($podcast);
    }
    
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }

}
