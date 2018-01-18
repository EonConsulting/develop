<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\ContentBuilder\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Tools\Elasticsearch\Elasticsearch;
use App\Jobs\ElasticIndexContent;

class ContentBuilderCore extends Controller {


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

    public function contentSearchToHTML(Request $request){
        $data = $request->json()->all();
        
        $from = $data['from'];
        $size = $data['size'];

        $results = $this->contentSearch($data['term'], $data['categories'], $from, $size);

        $fromNext = $from + $size;
        $fromPrev = $from - $size;

        $renderedResults = "";

        foreach($results['results'] as $result){
            $renderedResults = $renderedResults . view('eon.content-builder::content.partials.result', ['item' => $result])->render();
        }

        $meta = $results['meta'];
        $meta['fromNext'] = $fromNext;
        $meta['fromPrev'] = $fromPrev;
        $meta['size'] = $size;

        $renderedPag = view('eon.content-builder::content.partials.pagination', ['meta' => $meta])->render();

        return ['renderedResults' => $renderedResults, 'renderedPag' => $renderedPag, 'searchMeta' => $meta];

    }

    function contentSearch($term,$categories = [], $from, $size){

        $elasticsearch = new Elasticsearch;
        $index = 'content';

        $cats = implode(',',$categories);

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
                        "fields": [ "title", "description","body","tags" ]
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



        $success = false;

        try {
            $output = $elasticsearch->search($index, $query, $from, $size);
            $success = true;
        } catch (\ErrorException $e) {
            Log::error("Unable to perform search: " . $e->getMessage());
            
        }

        if($success){
            $output = json_decode($output);

            $hits = $output->hits->hits;
            $total = $output->hits->total;
    
            $searchOutput = [
                "meta" => [
                    "total" => $total,
                    "searchterm" => $term,
                ],
                "results" => []
            ];
    
            foreach ($hits as $hit) {
    
                $content = Content::find($hit->_id);
                $content->tags = $this->get_tags($content);
                $content->categories = $content->categories();
    
                $searchOutput['results'][] = $content;
            }
        } else {
            $searchOutput = false;
        }



        return $searchOutput;

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
            'contents'  => $contents,
            'content_id' => $content_id,
            'categories' => $categories,
            'assets' => $assets,
            'breadcrumbs' => $breadcrumbs]
        );

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
    public function store(Request $request){

        $data = $request->json()->all();

        if($data['id'] === "new"){
            $content = new Content([
                'title' => $data['title'],
                'body' => $data['body'],
                'tags' => $data['tags'],
                'creator_id' => auth()->user()->id,
                'description' => $data['description'],
                'ingested' => 0
            ]);
        }else{

            $content = Content::find($data['id']);

            $content->title = $data['title'];
            $content->body = $data['body'];
            $content->tags = $data['tags'];
            $content->creator_id = auth()->user()->id;
            $content->description = $data['description'];
            $content->ingested = 0;

        }
        
        $content->save();
        
        $categories = $data['categories'];

        foreach($categories as $k => $category_id) {
            $temp = Category::find($category_id);
            $content->categories()->save($temp);
        }

        ElasticIndexContent::dispatch();

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
