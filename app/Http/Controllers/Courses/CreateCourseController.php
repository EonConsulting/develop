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

class CreateCourseController extends Controller {

    public function index() {

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

    public function store(Request $request) {
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

    public function metadatalist($id) {
        $breadcrumbs = [
            'title' => 'Modules',
            'href' => route('courses'),
            'child' => [
                'title' => 'Create Metadata',
            ],
        ];

        $MetadataStore = MetadataType::get();
        $CMetadataId = CourseMetadata::where(['course_id' => $id])->groupBy('metadata_type_id')->get();
        $ids = [];
        foreach ($CMetadataId as $value) {
            $ids[] = $value->metadata_type_id;
        }
        $MetaId = MetadataStore::pluck('id')->all();

        return view('lecturer.courses.metadatalist', ['ids' => $ids, 'MetaId' => $MetaId, 'breadcrumbs' => $breadcrumbs, 'course' => $id, 'MetadataStore' => $MetadataStore]);
    }

    public function viewmetadata(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'course' => 'required',
        ]);

        $course_meta_data = CourseMetadata::where(['course_id' => (int) $data['course']])->pluck('value', 'metadata_store_id');

        $meta_store = MetadataStore::where('metadata_type_id', (int) $data['id'])->get();

        return view('lecturer.courses.viewmetadata', ['meta_store' => $meta_store, 'course_meta_data' => $course_meta_data, 'metadata_type_id' => $data['id']]);
    }

    public function storemetadata(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required',
            'metadata_type_id' => 'required',
            'metadata_store_id' => 'sometimes',
            'value' => 'sometimes',
        ]);

        $course_meta_data = CourseMetadata::where('course_id', $data['course_id'])->where('metadata_type_id', $data['metadata_type_id'])->delete();

        if( ! array_has($data, 'metadata_store_id'))
        {
            return redirect()->back()->with('success', 'Course Metadata has been added successfully.');
        }

        $data['value'] = array_filter($data['value']);

        $meta_data_entries = array_map(function($key, $value)
        {
            return [
                'key' => $key,
                'value' => $value
            ];

        }, $data['metadata_store_id'], $data['value']);

        foreach($meta_data_entries as $meta_data_entry)
        {
            $course_meta_data = CourseMetadata::create([
                'course_id' => $data['course_id'],
                'metadata_type_id' => $data['metadata_type_id'],
                'metadata_store_id' => $meta_data_entry['key'],
                'value' => $meta_data_entry['value'],
            ]);
        }

        return redirect()->back()->with('success', 'Course Metadata has been added successfully.');
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
