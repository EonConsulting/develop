<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Jobs\ElasticIndexCourseInfo;
use App\Models\CourseMetadata;
use App\Models\MetadataStore;
use App\Models\MetadataType;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Template;
use Illuminate\Http\Request;

class CreateCourseController extends Controller
{
    public function index()
    {

        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create a Module',
            ],
        ];

        $templates = Template::all();

        $metadataType = MetadataType::pluck('description', 'id');

        return view('lecturer.courses.create', [
            'breadcrumbs' => $breadcrumbs,
            'templates' => $templates,
            'metadataType' => $metadataType,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'sometimes',
            'tags' => 'sometimes',
            'template' => 'sometimes',
        ]);

        $Course = Course::create([
            'title' => array_get($data, 'title'),
            'description' => array_get($data, 'description'),
            'tags' => array_get($data, 'tags'),
            'creator_id' => auth()->user()->id,
            'template_id' => array_get($data, 'template'),
            'ingested' => 0,
        ]);

        $request->session()->flash('alert-success', 'Module has been added successfully.');

        ElasticIndexCourseInfo::dispatch();

        return redirect()->action('Courses\CreateCourseController@metadatalist', ['id' => $Course->id]);
    }

    public function metadatalist($id)
    {
        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create Metadata',
            ],
        ];

         $MetadataStore = MetadataType::get();
         $CMetadataId = CourseMetadata::where(['course_id'=>$id])->groupBy('metadata_type_id')->get();
         $ids = [];
         foreach ($CMetadataId as $value) {
              $ids[] = $value->metadata_type_id;
         }
        $MetaId = MetadataStore::pluck('id')->all();
        $html = "style='color:red'";
        return view('lecturer.courses.metadatalist', ['html'=>$html,'ids'=>$ids,'MetaId'=>$MetaId,'breadcrumbs' => $breadcrumbs, 'course' => $id, 'MetadataStore'=>$MetadataStore]);
    }

    public function viewmetadata($id)
    {
        $MetadataStore = MetadataStore::where('metadata_type_id', $id)->get();

        $MetaId = MetadataStore::pluck('id')->all();
        return view('lecturer.courses.viewmetadata', ['MetaId'=>$MetaId,'MetadataStore'=>$MetadataStore,'MetaTypeId'=>$id]);
    }

    public function storemetadata(Request $request)
    {
        $MetadataType = CourseMetadata::where(['metadata_type_id'=>$request->get('metadata_type_id')]);
        if(!$MetadataType->first()){
        $value = $request->get('value');       
        foreach ($request->get('metadata_store_id') as $key => $selected_id) {
            $Metadata = [
                'course_id' => $request->get('course_id'),
                'metadata_type_id' => $request->get('metadata_type_id'),
                'metadata_store_id' => (int) $selected_id,
                'value' => $value[$key],
            ];

            $status = new CourseMetadata($Metadata);
            $check = $status->save();
        }
        
        if ($check) {
            return redirect()->back()->with('success','Course Metadata has been added successfully.');
            //return response()->json(['success' => 'Metadata has been added successfully.']);
           }
           return redirect()->back()->with('error','An error occured, please try again.');
        //return response()->json(['error' => 'An error occured, pleas try again']);
        }
     return redirect()->back()->with('error','The metadata selected has already been saved.');
    }

    public function updatemetadata(Request $request)
    {
        $value = $request->get('value');
        foreach ($request->get('metadata_store_id') as $key => $selected_id) {
            $Metadata = [
                'course_id' => $request->get('course_id'),
                'metadata_type_id' => $request->get('metadata_type_id'),
                'metadata_store_id' => (int) $selected_id,
                'value' => $value[$key],
            ];

            $status = new CourseMetadata($Metadata);
            $check = $status->save();
        }

        if ($check) {
            return response()->json(['success' => 'Metadata has been added successfully.']);
        }

        return response()->json(['error' => 'An error occured, pleas try again']);
    }

    public function fill_metadata_store(Request $request)
    {
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
