<?php

namespace App\Http\Controllers\Courses;

use App\Http\Requests\Instructors\Courses\StoreCourseRequest;
use App\Models\Course;
use App\Models\MetadataStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MetadataType;
use App\Models\CourseMetadata;
use Validator;

class CreateCourseController extends Controller {

    public function index() {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create a Module',
            ],
        ];
        
        
        $metadataType = MetadataType::pluck('description', 'id');

        return view('lecturer.courses.create', ['breadcrumbs' => $breadcrumbs,'metadataType'=>$metadataType]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
        ]);

        if ($validator->passes()) {
            $Course = new Course([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'tags' => $request->get('tags'),         
                'creator_id' => auth()->user()->id,    
            ]);
            
            $Course->save();
            return response()->json(['success'=>'Module has been added successfully.','course'=>$Course->id]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }
    
    public function metadatalist($id) {
        
        $Metadata = MetadataStore::where('metadata_type_id', $id)->get();
        $MetaId = MetadataStore::pluck('id')->all();
       
        return view('lecturer.courses.metadatalist',['metaStore' => $Metadata,'MetaId'=>$MetaId]);
        
    }
    
    public function storemetadata(Request $request) {
            
            foreach($request->get('metadata_store_id') as $selected_id){
                $Metadata = [
                'course_id' => $request->get('course_id'),
                'metadata_store_id' => (int) $selected_id,
                'value' => $request->get('value'),             
                ];
                
               $status = new CourseMetadata($Metadata);
               $check = $status->save();
            }
      
            if($check){
            return response()->json(['success'=>'Metadata has been added successfully.']);            
            }
            
         return response()->json(['error' => 'An error occured, pleas try again']);       
    }

    public function fill_metadata_store(Request $request) {

        if ($request->ajax()) {
            // which entities should we use?
            $entities = $request->input('entities');
            // get the metadata store array
            //$metadata_store = Models\MetadataStore::all()->sortBy('metadata_type');
            $metadata_store = MetadataStore::where('entities', 'like', '%' . $entities . '%')
               ->orderBy('metadata_type', 'ASC')
               ->get();
            //$all_metadata_types = array_column($metadata_store, 'metadata_type');
            //$metadata_types = array_unique($all_metadata_types);
            //dd(DB::getQueryLog());
            return response()->json($metadata_store);
        }
    }
    
    

}
