<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Tools\Elasticsearch\Elasticsearch;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use EONConsulting\Storyline2\Models\Storyline;

class CoursesLTIController extends LTIBaseController {

    public function index(Request $request) {
        $breadcrumbs = [
            'title' => 'Modules',
        ];

        $elasticsearch = new Elasticsearch;
        $searchterm = $request->get('searchterm');
        $from = $request->get('from');
        $size = $request->get('size');

        $index = 'courses';

        //dd($searchterm);

        if ($searchterm === '') {

            Log::debug("Get ALL content");

            $query = '{
               "query": {
                    "match_all": {}
                }
            }';
        } else {
            $query = '{
                "query": {
                    "query_string" : {
                        "query" : "*' . $searchterm . '*"
                    }
                }
            }';
            
        }

        Log::debug("Query String---------------------------------------------------");
        Log::debug($query);

        $success = false;

        try {
            $output = $elasticsearch->search($index, $query, $from, $size);
            $success = true;
            Log::debug("Elastic search success---------------------------------------------------");
        } catch (\ErrorException $e) {
            Log::error("Unable to perform search: " . $e->getMessage());
            
        }

        //dd($output);

        if($success) {
            //$output = $elasticsearch->search($index, $query, $from, $size);
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

                $course = Course::find($hit->_id);
                if ($course) {
                    $sl = $course->latest_storyline();

                    $finalOutput['results'][] = array(
                        "id" => $hit->_id,
                        "title" => $hit->_source->title,
                        "description" => $hit->_source->description,
                        "tags" => $hit->_source->tags,
                        "has_sl" => ($sl !== null ? true : false)
                    );
                }
            }
        } else {
            $searchOutput = false;
        }

        //dd($finalOutput);

        return view('student.courses.list', ['searchResults' => $finalOutput, 'breadcrumbs' => $breadcrumbs]);
    }

}
