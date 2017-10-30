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
        //$this->setupContentIndex();
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
        $client = new Client(); // GuzzleHttp\Client
        
        // just drop the index in ES in-case it exists
        $response = $client->delete(config('app.es_uri') . "/" . $indexname);
        switch ($reponse->getStatusCode()) {
            case "200":
                Log::info("DELETE of index " . $course . " successful");
                break;
            default:
                Log::error("DELETE of index " . $course . " failed");
                break;
        }

        // now create the index from scratch
        $result = $client->put(config('app.es_uri' . "/" . $indexname), $settings);
        switch ($response->getStatusCode())
        {
            case "200":
                Log::info("PUT of index " . $course . " successful");
            default:
                Log::error("PUT of index " . $course . " failed");
                break;
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
    }

    public function failed(\Exception $exception) {
        Log::critical("Job has failed: " . $exception->getMessage());
    }

}
