<?php

namespace App\Http\Controllers\LTI\Courses;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Core\Services\Elastic\Elastic;

class CoursesLTIController extends LTIBaseController
{

    /**
     * @var \EONConsulting\Core\Services\Elastic\Elastic
     */
    protected $elastic;

    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;
    }

    public function index(Request $request)
    {
        $breadcrumbs = [
            'title' => 'Modules',
        ];

        $searchterm = "*" . $request->get('searchterm') . "*" ?? '*';

        $elastic_response = $this->elastic->index('courses')->body([
            'query' => [
                'query_string' => [
                    'query' => $searchterm
                ]
            ]
        ])->paginate(10);

        if($elastic_response->total() < 1)
        {
            return view('student.courses.list', ['courses' => [], 'paginate' => $elastic_response, 'breadcrumbs' => $breadcrumbs]);
        }

        $items = collect($elastic_response->items());

        $courses = Course::whereIn('id', $items->pluck('_id'))
            ->orderBy(\DB::raw('FIELD(`id`, '. $items->pluck('_id')->implode(',') .')'))
            ->get();

        $courses = $items->map(function ($item) use ($courses)
        {
            $course = $courses->where('id', array_get($item, '_id'))->first();

            return (object) [
                "id" => array_get($item, '_id'),
                "title" => array_get($item, '_source.title'),
                "description" =>  array_get($item, '_source.description'),
                "tags" => array_get($item, '_source.tags'),
                "has_sl" => $course ? true : false,
            ];
        })->toArray();

        return view('student.courses.list', ['courses' => $courses, 'paginate' => $elastic_response, 'breadcrumbs' => $breadcrumbs]);
    }
}