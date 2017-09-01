<?php

namespace App\Http\Controllers\LTI\Courses;

use App\Models\Course;
use App\Tools\Elasticsearch\Elasticsearch;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;

class CourseLectureLTIController extends LTIBaseController {

    public function index(Course $course) {

        $data = storyline_core()->getIndex($course);

        $latest_storyline = $course->latest_storyline()->items()->first();


        return redirect()->route('lti.courses.single.lectures.item', [$course->id, $latest_storyline->id]);

//        dd($data);

        $styles = [];
        $scripts = [];
        $custom_scripts = [];
        $custom_styles = [];

        $nav = '';
        if(function_exists('storyline_nav')) {
//            $nav = storyline_nav()->getNavHTML();
            $nav = storyline_nav()->getNavHTMLFromCourse($course);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        $menu = '';

        if(function_exists('storyline_nav')) {
            $menu = storyline_menu()->getMenuHTMLFromCourse($course);
//            $styles = array_merge($styles, storyline_menu()->getStyles());
//            $scripts = array_merge($scripts, storyline_menu()->getScripts());
//            $custom_scripts[] = storyline_menu()->getCustomScripts();
        }

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('lti.courses'),
            'child' => [
                'title' => $course->title,
                'href' => '',
                'child' => [
                    'title' => 'Lectures'
                ],
            ],
        ];

        return view('student.courses.lectures', [
            'data' => $data,
            'course' => $course,
            'nav' => $nav,
            'styles' => $styles,
            'scripts' => $scripts,
            'custom_scripts' => $custom_scripts,
            'custom_styles' => $custom_styles,
            'menu' => $menu,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function search(Request $request, Elasticsearch $elasticsearch)
    {
        $term = $request->get('term');
        $from = $request->get('from');
        $size = $request->get('size');

        $query = '{
            "query":{
                "function_score":{
                    "query":{
                        "bool":{
                            "must":[
                                {
                                    "multi_match":{
                                        "fields":[
                                            "title^10","description^5"
                                        ],
                                        "type":"cross_fields",
                                        "query": "'.$term.'",
                                        "minimum_should_match":"2<-1 5<70%"
                                    }
                                }
                            ]
                        }
                    }
                }
            }
        }';

        try {
            $output = $elasticsearch->search($query, $from, $size);
            $output = json_decode($output);

            $hits = $output->hits->hits;
            $total = $output->hits->total;

            $fromNext = $request->get('from') + 1 * $size;
            $fromPrev = $request->get('from') - 1 * $size;

            $finalOutput = [];
            foreach ($hits as $hit) {
                $finalOutput[] = array(
                    'total' => $total,
                    "id" => $hit->_id,
                    "title" => $hit->_source->title,
                    "description" => $hit->_source->description,
                    "fromNext" => $fromNext,
                    "fromPrev" => $fromPrev,
                    "size" => $size,
                    "term" => $term
                );
            };

            if ($request->ajax()) {
                return response()
                    ->json($finalOutput);
            } else {
                return response()
                    ->view('student.courses.searchOutput', ['finalOutput' => $finalOutput], 200);
            }

        } catch(\ErrorException $e) {
            return back();
        }
    }
}
