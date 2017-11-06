<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ElasticSearchSetup implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    // how many times the job should be retried
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->setupCourseIndex();
        $this->setupContentIndex();
    }

    function setupCourseIndex() {
        $courses_map = [
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

        $settings = [
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
            "mappings" => $courses_map
        ];

        // create re-usable client
        $indexname = "courses";
        // GuzzleHttp\Client
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('app.es_uri'),
            // You can set any number of default request options.
            'timeout' => 30,
        ]);
        
        // just drop the index in ES in-case it exists
        try {
            $response = $client->request('DELETE', $indexname);
            switch ($response->getStatusCode()) {
                case "200":
                    Log::info("DELETE of index " . $indexname . " successful");
                    break;
            }
        } catch (\Exception $e) {
            Log::error("DELETE of index " . $indexname . " failed :: " . $e->getMessage());
        }

        // now create the index from scratch
        try {
            $response = $client->request('PUT', $indexname, $settings);
            switch ($response->getStatusCode()) {
                case "200":
                    Log::info("PUT of index " . $indexname . " successful");
            }
        } catch (\Exception $e) {
            Log::error("PUT of index " . $indexname . " failed :: " . $e->getMessage());
        }
    }

    function setupContentIndex() {
        $content_map = [
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

        $settings = [
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
            "mappings" => $content_map
        ];
        
        // create re-usable client
        $indexname = "content";
        // GuzzleHttp\Client
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('app.es_uri'),
            // You can set any number of default request options.
            'timeout' => 30,
        ]);
        
        // just drop the index in ES in-case it exists
        try {
            $response = $client->request('DELETE', $indexname);
            switch ($response->getStatusCode()) {
                case "200":
                    Log::info("DELETE of index " . $indexname . " successful");
                    break;
            }
        } catch (\Exception $e) {
            Log::error("DELETE of index " . $indexname . " failed :: " . $e->getMessage());
        }

        // now create the index from scratch
        try {
            $response = $client->request('PUT', $indexname, $settings);
            switch ($response->getStatusCode()) {
                case "200":
                    Log::info("PUT of index " . $indexname . " successful");
            }
        } catch (\Exception $e) {
            Log::error("PUT of index " . $indexname . " failed :: " . $e->getMessage());
        }
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
