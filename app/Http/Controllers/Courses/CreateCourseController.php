<?php

namespace App\Http\Controllers\Courses;

use App\Http\Requests\Instructors\Courses\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateCourseController extends Controller {

    public function index() {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create a Module',
            ],
        ];

        return view('lecturer.courses.create', [ 'breadcrumbs' => $breadcrumbs ]);
    }

    public function store(Request $request) {
        $title = $request->get('title', '');
        $description = $request->get('description', '');
        $tags = $request->get('tags', '');
        $featured_images = $request->file('featured_image');
        $course = new Course;

        $course->title = $title;
        $course->description = $description;
        $course->tags = $tags;
        $course->creator_id = $request->user()->id;

        $course->save();

        session()->flash('success_message', 'Course saved.');
        return redirect()->route('courses');

        // put all the metadata
        // MH: to implement after storyline2 rewrite
        /*$meta_array = [
            array(
                "lk_table" => "lk_qualification_type",
                "lk_table_id" => $request->get("qualification_type", 0)
            ),
            array(
                "lk_table" => "lk_content_difficulty_type",
                "lk_table_id" => $request->get("content_difficulty_type", 0)
            ),
            array(
                "lk_table" => "lk_pedagogical_type",
                "lk_table_id" => $request->get("pedagogical_type", 0)
            ),
            array(
                "lk_table" => "lk_discipline_type",
                "lk_table_id" => $request->get("discipline_type", 0)
            ),
            array(
                "lk_table" => "lk_duration_type",
                "lk_table_id" => $request->get("duration_type", 0)
            ),
            array(
                "lk_table" => "lk_college_type",
                "lk_table_id" => $request->get("college_type", 0)
            ),
            array(
                "lk_table" => "lk_school_type",
                "lk_table_id" => $request->get("school_type", 0)
            ),
            array(
                "lk_table" => "lk_department_type",
                "lk_table_id" => $request->get("department_type", 0)
            ),
            array(
                "lk_table" => "lk_centre_type",
                "lk_table_id" => $request->get("centre_type", 0)
            ),
            array(
                "lk_table" => "lk_institute_type",
                "lk_table_id" => $request->get("institute_type", 0)
            ),
        ];

        // begin transaction
        try {
            DB::beginTransaction();

            // create course
            $course = new Course;
            $course->title = $title;
            $course->description = $description;
            $course->tags = $tags;
            $course->creator_id = $request->user()->id;
            $course->save();

            if ($course->id > 0) {
                foreach ($meta_array as $m) {
                    // check whether it is not 0 so we can save it
                    if ($m["lk_table_id"] > 0) {
                        // set course_id and re-use object
                        $metadata = new StorylineMetadata;
                        $metadata->course_id = $course->id;
                        $metadata->lk_table = $m["lk_table"];
                        $metadata->lk_table_id = $m["lk_table_id"];
                        $metadata->save();
                    }
                }
            }
            // transaction successful.
            DB::commit();

            session()->flash('success_message', 'Course saved.');
            return redirect()->route('courses');
        } catch (\Exception $e) {

            // transaction failed.
            DB::rollback();

            session()->flash('error_message', 'Unable to save course, please try again');
            return redirect()->route('courses');
        } */
    }
    
    public function fill_metadata_store(Request $request)
    {
        // get the metadata store array
        $metadata_store = Models\MetadataStore::all()->sortBy('metadata_type');
        //$all_metadata_types = array_column($metadata_store, 'metadata_type');
        //$metadata_types = array_unique($all_metadata_types);
        return response()->json($metadata_store);
    }

}
