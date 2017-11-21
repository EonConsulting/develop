<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Tools\Elasticsearch\Elasticsearch;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CoursesLTIController extends LTIBaseController {

    public function index(Request $request, Elasticsearch $elasticsearch) {
        $breadcrumbs = [
            'title' => 'Modules',
        ];

        $searchterm = $request->get('searchterm');
        $from = $request->get('from');
        $size = $request->get('size');

        if (empty($searchterm)) {
           $query = '{
               "query": {
                    "match_all": {}
                }
            }';
        } else {
            $query = '{
                "query":{
                    "function_score":{
                        "query":{
                            "bool":{
                                "must":[
                                    {
                                        "multi_match":{
                                            "fields":[
                                                "title^10","description^5","tags^5"
                                            ],
                                            "type":"cross_fields",
                                            "query": "' . $searchterm . '",
                                            "minimum_should_match":"2<-1 5<70%"
                                        }
                                    }
                                ]
                            }
                        }
                    }
                }
            }';
        }

        try {
            $output = $elasticsearch->search($query, $from, $size);
            $output = json_decode($output);

            $hits = $output->hits->hits;
            $total = $output->hits->total;

            $fromNext = $request->get('from') + $size; //from = 0 then this = 10, 10+1*10=110
            $fromPrev = $request->get('from') - $size;

            $finalOutput = [
                "fromNext" => $fromNext,
                "fromPrev" => $fromPrev,
                "total" => $total,
                "size" => $size,
                "searchterm" => $searchterm,
                "results" => []
            ];

            foreach ($hits as $hit) {
                $finalOutput['results'][] = array(
                    "id" => $hit->_id,
                    "title" => $hit->_source->title,
                    "description" => $hit->_source->description,
                    "tags" => $hit->_source->tags
                );
            }
        } catch (\ErrorException $e) {
            Log::error("Unable to perform search: " . $e->getMessage());
            $finalOutput = array();
        }

        return view('student.courses.list', ['searchResults' => $finalOutput, 'breadcrumbs' => $breadcrumbs]);
    }

}
