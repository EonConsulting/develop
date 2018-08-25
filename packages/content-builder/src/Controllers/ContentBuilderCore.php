<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\ContentBuilder\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use EONConsulting\ContentBuilder\Jobs\ContentElasicUpdate;

class ContentBuilderCore extends Controller {

    /**
     * Elastic Client
     *
     * @var \EONConsulting\Core\Services\Elastic\Elastic
     */
    protected $elastic;

    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $breadcrumbs = [
            'title' => 'Content Store',
        ];

        $categories = Category::all();

        return view('eon.content-builder::content.store', [
            'categories' => $categories,
            'breadcrumbs' => $breadcrumbs
        ]);

    }

    public function contentSearchToHTML(Request $request)
    {
        $data = $request->json()->all();

        $term = $data['term'];
        $cats = implode(',', $data['categories']);

        if($term === null && $cats === ''){
            $query = '{
                "query": {
                     "match_all": {}
                 }
             }';
        }else{
            $first = true;

            $query = '{
                "query": {
                    "bool": {
                        "must": [';

            if($term !== null){
                $first = false;
                $query = $query . '
                {
                    "query_string" : {
                        "query":    "*' . $term . '*",
                        "fields": [ "title", "description","content","tags" ]
                    }
                }';
            }

            if($cats !== ""){

                if(!$first){
                    $query = $query . ',';
                }

                $query = $query . '
                    {
                        "match": {
                            "categories":  "*' . $cats . '*"
                        }
                    }';
            }

            $query = $query . '
                            ]
                        }
                    }
                    }';
        }

        $meta = [
            "searchterm" => $term,
        ];

        $elastic_response = $this->elastic->index('content')->body($query)->paginate(10);

/*

        $term = array_get($data, 'term');
        $categories = array_get($data, 'categories', []);

        $elastic_response = $this->elastic
            ->index('content')
            ->search("*{$term}*", function($search)
            {
                $search->boost(2)->fields([
                    "title" => 2, "description" => 1, 'body' => 1, 'tags' => 1
                ]);
            })->search(implode(', ', $categories), 8)->paginate(15);
*/

        $renderedPag = view('eon.content-builder::content.partials.pagination', ['items' => $elastic_response])->render();

        if($elastic_response->total() < 1)
        {
            return response()->json(['renderedResults' => '', 'renderedPag' => $renderedPag, 'searchMeta' => $meta], 200);
        }

        $items = collect($elastic_response->items());

        $content_items = Content::with('categories')
            ->whereIn('id', $items->pluck('_id'))
            ->orderBy(\DB::raw('FIELD(`id`, '. $items->pluck('_id')->implode(',') .')'))
            ->get();

        $renderedResults = '';

        foreach($content_items as $content)
        {
            $renderedResults = $renderedResults . view('eon.content-builder::content.partials.result', ['content' => $content])->render();
        }

        return response()->json(['renderedResults' => $renderedResults, 'renderedPag' => $renderedPag, 'searchMeta' => $meta], 200);
    }

    /**
     * @param $content_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($content_id) {

        $content = Content::find($content_id);

        $content->tags = $this->get_tags($content);
        
        $breadcrumbs = [
            'title' => 'View Content',
            'href' => route('eon.contentbuilder'),
            'child' => [
                'title' => $content->title
            ]
        ];

        return view('eon.content-builder::content.view', ['content' => $content, 'breadcrumbs' => $breadcrumbs]);

    }
    
    public function preview($content_id){
           $content = Content::find($content_id);
           $content->tags = $this->get_tags($content);
           return view('eon.content-builder::content.preview', ['content' => $content]);
    }

    /**
     * @param $content_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($content_id){

        $content = Content::find($content_id);

        $breadcrumbs = [
            'title' => 'Edit Content',
            'href' => route('eon.contentbuilder'),
            'child' => [
                'title' => $content->title
            ]
        ];

        $categories = Category::all();

        foreach($categories as $k => $category){
            $categories[$k]->checked = false; 
            
            foreach($content->categories as $content_category){

                if($category->id === $content_category->id){
                    $categories[$k]->checked = true;
                }

            }

        }

        return view('eon.content-builder::content.edit', ['content' => $content,'categories'=> $categories, 'breadcrumbs' => $breadcrumbs]);

    }


    /**
     * @param $course
     * @return array
     */
    public function get_tags($course) {

        $tags = explode(',',$course->tags);

        foreach($course->categories as $category){

            $temp_tags = explode(',',$category->tags);

            $tags = array_merge($tags, $temp_tags);

        }

        $result = [];

        return array_count_values($tags);
    }


    /**
     * @param $content
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($content) {
        $breadcrumbs = [
            'title' => 'Content Builder',
        ];

        $categories = Category::all();
        $contents = Content::all();
        $assets = Asset::all();

        if($content !== "new"){
            $content_id = $content;
        } else {
            $content_id = "new";
        }
        

        return view('eon.content-builder::content.new', [
            'courseId'=>$content,
            'contents'  => $contents,
            'content_id' => $content_id,
            'categories' => $categories,
            'assets' => $assets,
            'breadcrumbs' => $breadcrumbs
        ]);

    }


    /**
     * ----------------------------------------------------------
     * API Functions
     * ----------------------------------------------------------
     */


    /**
     * @param $content
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($content){

        if($content === "all"){
            $result = Content::all();  
        } else {
            $result = Content::find($content);
            $result->categories = $result->categories()->get();
        }

        return response()->json($result);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *//*
    public function save(Request $request) {

        $content = new Content([
            'title' => $request->get('title'),
            'body' => $request->get('data'),
            'tags' => $request->get('tags'),
            'creator_id' => auth()->user()->id,
            'description' => $request->get('description')
        ]);
        
        $content->save();
        
        $categories = $request->get('categories');

        foreach($categories as $k => $category_id) {
            $temp = Category::find($category_id);
            $content->categories()->save($temp);
        }

        return redirect()->route('eon.contentbuilder');
       
    }*/

    /**
     * @param Request $request
     * @return int
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'sometimes',
            'title' => 'required',
            'body' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'categories' => 'sometimes',
        ]);

        $content = Content::updateOrCreate([
            'id' => array_get($data, 'id')
        ],[
            'title' => array_get($data, 'title'),
            'body' => array_get($data, 'body'),
            'tags' => array_get($data, 'tags'),
            'creator_id' => auth()->user()->id,
            'description' => array_get($data, 'description'),
            //'ingested' => 0,
        ]);

        $content->categories()->sync(array_get($data, 'categories'));

        ContentElasicUpdate::dispatch($content);

        return ['id' => $content->id];
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $content_id
     * @return void
     */
 /*   public function update(Request $request, $content_id){

        $content = Content::find($content_id);
        
        $content->title = $request->get('title');
        $content->body = $request->get('data');
        $content->tags = $request->get('tags');
        $content->creator_id = auth()->user()->id;
        $content->description = $request->get('description');
        
        $categories = $request->get('categories');
        $content->categories()->sync($categories);

        $content->save();

        return redirect()->route('eon.contentbuilder');

    }*/

    /**
     * Undocumented function
     *
     * @param [type] $content_id
     * @return void
     */
    public function delete($content_id){
        
        //TODO: Finish this

        $content = Content::find($content_id);
        $content->categories()->delete();

    }

    /**
     * Undocumented function
     *
     * @param [type] $category_id
     * @param [type] $keywords
     * @return void
     */
    public function search($category_id,$keywords){
        
    
        $content = Content::all();

        foreach($content as $k => $item){
            $content[$k]->tags = $this->get_tags($item);
        }

        //TODO: Finish this

    }


    /**
     * @param $request
     * @return mixed
     *
     */
    protected function new_file_request(Request $request) {
        $file_name = $request->get('file_name');
        if (str_word_count($file_name) > 1) {
            $new_file_name = preg_replace('/\s+/', '_', $file_name);
            return $new_file_name;
        } else {
            return $file_name;
        }
    }


    /**
     * Undocumented function
     *
     * @param [type] $title
     * @return void
     */
    public function title_exists(Request $request){

        $data = $request->json()->all();

        $title = $data['title'];

        $content = Content::where('title', $title)->first();

        //dd($content);

        if($content !== null){
            $result = [
                'exists' => true,
                'id' => "".$content->id
            ];
        } else {
            $result = [
                'exists' => false,
                'id' => "new"
            ];
        }

        return response()->json($result);

    }

}
