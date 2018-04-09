<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CourseMetadata;
use App\Models\MetadataStore;
use EONConsulting\Storyline2\Models\Template;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Jobs\CourseElasticUpdate;

class CoursesController extends Controller
{
    public function index()
    {
        //Could actually filter the request and return view

        $breadcrumbs = [
            'title' => 'Modules',
        ];

        $courses = Course::with(['creator'])->orderBy('id', 'DESC')->get();

        return view('lecturer.courses.list', ['courses' => $courses, 'breadcrumbs' => $breadcrumbs]);
    }


    public function show($title)
    {
        if($title === 'my')
        {
            $courseCreator = Course::where('creator_id', auth()->user()->id)->with(['creator'])->get();

            $breadcrumbs = [
                'title' => 'My Modules'
            ];
        
        } else {
            $courseCreator = Course::with(['creator'])->get();

            $breadcrumbs = [
                'title' => 'All Modules'
            ];
        }
        
        return view('lecturer.courses.show', ['courses' => $courseCreator, 'breadcrumbs' => $breadcrumbs]);
    }

    public function edit(Request $request)
    {
        $id = (int)$request->get('id');
        if ($request->get('text') === 'Edit Module') {
            $templates = Template::all();
            $data = Course::find($id);
            return view('lecturer.courses.edit', ['data' => $data, 'templates' => $templates]);

        } elseif ($request->get('text') === 'Metadata') {

            $data = DB::table('course_metadata')->where('course_id', $id)->first();
            $MetaId = CourseMetadata::where('course_id', $id)->pluck('metadata_store_id')->all();
               
            $Metadata = MetadataStore::with(['course_metadata'=> function ($q) use ($id) {
                $q->where('course_id', $id);
            }])->where('metadata_type_id', $data->metadata_type_id)->get();
                              
            return view('lecturer.courses.editmetadata', ['data' => $Metadata,'MetaId'=>$MetaId,'course'=>$id]);
        }
    }

    /**
     * Update the course
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'description' => 'sometimes',
            'tags' => 'sometimes',
            'template' => 'sometimes'
        ]);

        $course = Course::find(array_get($data, 'id'));

        $course->update([
            'title' => array_get($data, 'title'),
            'description' => array_get($data, 'description'),
            'tags' => array_get($data, 'tags'),
            'creator_id' => auth()->user()->id,
            'template_id' => array_get($data, 'template'),
        ]);

        CourseElasticUpdate::dispatch($course);

        return response()->json(['success'=>'Module has been updated successfully.'], 200);
    }
}