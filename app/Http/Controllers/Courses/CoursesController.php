<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
//use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use Validator;

class CoursesController extends Controller {

    public function index() {
        //Could actually filter the request and return view

        $breadcrumbs = [
            'title' => 'Modules',
        ];

        return view('lecturer.courses.list', ['courses' => $this->allCourses(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function allCourses() {
        $courses = Course::get();
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
    
    public function edit(Request $request,$id) {
        
        $breadcrumbs = [
            'title' => 'Modules',
            'child' => [
                'title' => 'Edit'
            ]
        ];
        
        
            $Course = Course::find($id);
            
           return view('lecturer.courses.edit', ['courses' => $this->allCourses(), 'breadcrumbs' => $breadcrumbs,'course'=>$Course]);
          
    }
    
    public function update(Request $request,$id) {
        
        $validator = Validator::make($request->all(), [
                    'title' => 'required',                   
        ]);
        
        if ($validator->passes()) {
            $Course = Course::find($id);
            $Course->title = $request->get('title');
            $Course->description = $request->get('description');
            $Course->tags = $request->get('tags');
            $Course->save();       
           return response()->json(['success'=>'Module has been updated successfully.']);
        }        
       return response()->json(['error' => $validator->errors()->all()]);      
    }
}
