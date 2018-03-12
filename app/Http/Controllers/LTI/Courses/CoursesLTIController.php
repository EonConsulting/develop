<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Tools\Elasticsearch\Elasticsearch;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Course;
use EONConsulting\Core\Helpers\CourseExportHelper;

class CoursesLTIController extends LTIBaseController
{

    public function index(Request $request)
    {
        $breadcrumbs = [
            'title' => 'Modules',
        ];

        $elasticsearch = new Elasticsearch;

        $searchterm = $request->get('searchterm') ?? '';
        $from = $request->get('from') ?? 0;
        $size = $request->get('size') ?? 12;

        $index = 'courses';

        $search_query = $this->buildQuery($searchterm);

        Log::debug("Query String---------------------------------------------------");
        Log::debug($search_query);

        $success = false;

        try {
            $response = $elasticsearch->search($index, $search_query, $from, $size);
            $success = true;

            Log::debug("Elastic search success---------------------------------------------------");
        } catch (\ErrorException $e) {
            Log::error("Unable to perform search: " . $e->getMessage());
        }

        if($success)
        {
            $output = json_decode($response);

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

            $hits = collect($hits);

            $courses = Course::whereIn('id', $hits->pluck('_id'))->pluck('id');

            $results = $hits->reject(function ($hit) use ($courses) {
                return ! $courses->contains(optional($hit->_source)->id);
            })->map(function ($hit) {

                $full_course_html = CourseExportHelper::hasHtmlCourse(optional($hit->_source)->id);

                return [
                    "id" => $hit->_id,
                    "title" => $hit->_source->title,
                    "description" => $hit->_source->description,
                    'full_course_html' => $full_course_html,
                    "tags" => $hit->_source->tags,
                    "has_sl" => true
                ];
            })->toArray();

            $finalOutput['results'] = $results;

        } else {
            $searchOutput = false;
        }

        return view('student.courses.list', ['searchResults' => $finalOutput, 'breadcrumbs' => $breadcrumbs]);
    }

    /*
     * Build the search query for Elastic
     */
    protected function buildQuery($searchterm = '')
    {
        if($searchterm == '')
        {
            return json_encode([
                'query' => [
                    'match_all' => []
                ]
            ], JSON_FORCE_OBJECT);
        }

        return json_encode([
            'query' => [
                'query_string' => [
                    'query' => "*$searchterm*"
                ]
            ]
        ], JSON_FORCE_OBJECT);
    }
}