<?php

namespace App\Http\Controllers\Setup;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ElasticSearchSetupController extends Controller {

    public function index() {
        
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
        
    }


    public function create_mappings($mappings = []) {
        
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
            "mappings" => $mappings
        ];

    }

}
