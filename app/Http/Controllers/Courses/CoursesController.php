<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
//use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CourseMetadata;
use App\Models\MetadataStore;
use App\Models\ContentTemplates;
use Validator;

class CoursesController extends Controller
{
    public function index()
    {
        //Could actually filter the request and return view

        $breadcrumbs = [
            'title' => 'Modules',
        ];

        return view('lecturer.courses.list', ['courses' => $this->allCourses(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function allCourses()
    {
        $courses = Course::orderBy('id', 'DESC')->get();
        return $courses;
    }

    public function show()
    {
        $courseCreator = Course::where('creator_id', auth()->user()->id)->get();

        $breadcrumbs = [
            'title' => 'My Modules'
        ];

        return view('lecturer.courses.show', ['createdCourse' => $courseCreator, 'breadcrumbs' => $breadcrumbs]);
    }
    
    public function edit(Request $request)
    {
        $id = (int)$request->get('id');
        if ($request->get('text') === 'Edit Module') {

            $templates = ContentTemplates::all();
            $data = Course::find($id);
            return view('lecturer.courses.edit', ['data' => $data, 'templates' => $templates]);

        } elseif ($request->get('text') === 'Metadata') {

            $data = DB::table('course_metadata')->where('course_id', $id)->first();
            $MetaId = CourseMetadata::where('course_id', $id)->pluck('metadata_store_id')->all();
               
            $Metadata = MetadataStore::with(['course_metadata'=> function ($q) use ($id) {
                $q->where('course_id', $id);
            }])
                                              ->where('metadata_type_id', $data->metadata_type_id)->get();
                              
            return view('lecturer.courses.editmetadata', ['data' => $Metadata,'MetaId'=>$MetaId,'course'=>$id]);
        }
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
        ]);
        
        $Course = Course::find((int)$request->get('id'));
        if ($validator->passes()) {
            $Course->title = $request->get('title');
            $Course->description = $request->get('description');
            $Course->tags = $request->get('tags');
            $Course->creator_id = $request->get('creator_id');
            $Course->template_id = $request->get('template');
            $Course->save();
            return response()->json(['success'=>'Module has been updated successfully.']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
}
