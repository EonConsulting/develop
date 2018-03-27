<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\ContentBuilder\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Tools\Elasticsearch\Elasticsearch;
use App\Tools\Alfresco\Alfresco;
use App\Jobs\ElasticIndexAssets;
use Illuminate\Support\Facades\Log;

class ContentBuilderAssets extends Controller {

    private $path;
    private $mimes;

    public function __construct(){

        $this->path = url('uploads/');

        $this->mimes = $mimes = [
            'image' => [
                'icon' => "<i class='fa fa-file-image-o'></i> Image"
            ],
            'video' => [
                'icon' => "<i class='fa fa-file-video-o'></i> Video"
            ],
            'audio'=> [
                'icon' => "<i class='fa fa-file-audio-o'></i> Audio"
            ],
            'text'=> [
                'icon' => "<i class='fa fa-file-text-o'></i> Text"
            ],
            'application'=> [
                'msword' => [
                    'icon' => "<i class='fa fa-file-word-o'></i> Word Document"
                ],
                'vnd.openxmlformats-officedocument.wordprocessingml.document' => [
                    'icon' => "<i class='fa fa-file-word-o'></i> Word Document"
                ],
                'vnd.ms-excel' => [
                    'icon' => "<i class='fa fa-file-excel-o'></i> Excel Spreadsheet"
                ],
                'vnd.openxmlformats-officedocument.spreadsheetml.sheet' => [
                    'icon' => "<i class='fa fa-file-excel-o'></i> Excel Spreadsheet"
                ],
                'vnd.ms-powerpoint' => [
                    'icon' => "<i class='fa fa-file-powerpoint-o'></i> Power Point Presentation"
                ],
                'vnd.openxmlformats-officedocument.presentationml.presentation'=> [
                    'icon' => "<i class='fa fa-file-powerpoint-o'></i> Power Point Presentation"
                ],
                'pdf' => [
                    'icon' => "<i class='fa fa-file-pdf-o'></i> PDF Document"
                ]
            ]
        ];

    }

    //resource method
    public function index() {

        $breadcrumbs = [
            'title' => 'Asset Store'
        ];

        $categories = Category::all();

        return view('eon.content-builder::assets.index', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);
    
    }

    public function assetSearchToHTML(Request $request){
        $data = $request->json()->all();
        
        $from = $data['from'];
        $size = $data['size'];

        $results = $this->assetSearch($data['term'], $data['categories'], $from, $size);
        
        $fromNext = $from + $size;
        $fromPrev = $from - $size;

        $renderedResults = "";

        foreach($results['results'] as $result){
            $renderedResults = $renderedResults . view('eon.content-builder::assets.partials.result', ['item' => $result])->render();
        }

        $meta = $results['meta'];
        $meta['fromNext'] = $fromNext;
        $meta['fromPrev'] = $fromPrev;
        $meta['size'] = $size;

        $renderedPag = view('eon.content-builder::content.partials.pagination', ['meta' => $meta])->render();

        return ['renderedResults' => $renderedResults, 'renderedPag' => $renderedPag, 'searchMeta' => $meta];
    }

    function assetSearch($term,$categories = [], $from, $size){

        $elasticsearch = new Elasticsearch;
        $index = 'assets';

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
   
                $assets = Asset::with('categories')->find((int)$hit->_id);
                if(!empty($assets))
                //$assets->categories = $assets->categories();                
                $searchOutput['results'][] = $assets;
                if(empty($assets))
                $searchOutput;
            }
        } else {
            $searchOutput = false;
        }
        return $searchOutput;

    }

    public function create(){

        $categories = Category::all();

        $breadcrumbs = [
            'title' => 'Create an Asset'
        ];

        return view('eon.content-builder::assets.create', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);

    }

    public function delete($asset_id){

        $asset = Asset::find($asset_id);

        if($asset['file_name'] !== null){
            Storage::delete($asset['file_name'],'uploads');
        }

        Asset::destroy($asset_id);

        return redirect('content/assets?from=0&size=20&searchterm=');
    }
    
    public function edit($asset_id){

        $breadcrumbs = [
            'title' => 'Edit Asset'
        ];
        
        $asset = Asset::find($asset_id);
        foreach ($asset->categories as $cat) {
            $catArray[] = $cat->id;
        }
        $categories = Category::get();
        return view('eon.content-builder::assets.edit',['asset' => $asset,'catArray'=>$catArray,'categories'=>$categories,
                    'assetId'=>$asset_id,'breadcrumbs'=>$breadcrumbs]);
    }
     
    public function store(Request $request){
        $data = $request->all();
        if ($request->hasFile('assetFile'))
        {
            $file = $request->file('assetFile');

            $file_size = $file->getClientSize();
            $file_mime = $file->getMimeType();

            switch ($file_mime){
                case 'audio/mpeg':
                case 'application/octet-stream':
                    $file_mime = 'audio/mp3';
                    $file_path = $file->storeAs($file_mime,explode(".",$file->hashName())[0].".mp3",'uploads');
                    break;
                default:
                    $file_path = $file->store($file->getMimeType(),'uploads');
                    break;
            }


            /**
             * TODO: Figure out why this returns success but no file shows
             * Might be authentication, although I set the folder to public for this test
             */
            $alfresco = new Alfresco;

            try {
                $output = $alfresco->upload(json_encode([
                    'filedata' => $request->file('assetFile'),
                    'filename' => $data['title'],
                    'siteid' => 'unisa-e-content',
                    'containerid' => 'documentLibrary ',
                    'uploaddirectory' => 'Uploads'
                ]));

                Log::info("Performed upload, output: " . $output);
            } catch (\ErrorException $e) {
                Log::error("Unable to perform upload: " . $e->getMessage());
            }

        } else {
            $file_path = null;
            $file_mime = null;
            $file_size = null;
        }

        $asset = new Asset([
            'title' => $data['title'],
            'description' => $data['description'],
            'tags' => $data['tags'],
            'file_name' => $file_path,
            'content' => $data['content'],
            'mime_type' => $file_mime,
            'size' => $file_size,
            'creator_id' => auth()->user()->id
        ]);
        
        $asset->save();

        $categories = $request->get('categories');

        foreach($categories as $k => $category_id) {
            $temp = Category::find($category_id);
            $asset->categories()->save($temp);
        }

        ElasticIndexAssets::dispatch();

        return redirect('content/assets?from=0&size=20&searchterm=');

    }

    public function show($id){

        $result = [];
        
        $asset = Asset::find($id);

        if($asset !== null){
            $result['found'] = true;
            $result['asset'] = $asset;
            $result['asset']->html = $this->generate_asset_html_block($asset);
            $result['asset']->icon = $this->generate_asset_mime_icon($asset);
            $result['asset']->categories = $result['asset']->categories()->get();
        } else {
            $result['found'] = false;
        }
        
        return response()->json($asset);

    }

    public function generate_asset_mime_icon($asset){

        if ($asset['file_name'] !== null) {

            $mime = explode("/", $asset['mime_type']);

            if ($mime[0] === 'application') {

                if (array_key_exists($mime[1], $this->mimes['application'])) {
                    return $this->mimes['application'][$mime[1]]['icon'];
                } else {
                    return "<i class='fa fa-file'></i> File";
                }

            } else {

                if (array_key_exists($mime[0], $this->mimes)) {
                    return $this->mimes[$mime[0]]['icon'];
                } else {
                    return "<i class='fa fa-file'></i> File";
                }
            }

        } else {
            return "<i class='fa fa-file'></i> Content";
        }


    }

    public function generate_asset_html_block($asset){

        $html = '';


        if ($asset['file_name'] !== null) {
            $mime = explode("/", $asset['mime_type']);

            switch ($mime[0]) {
                case 'image':
                    $html = $html . "<img width='100%' src='" . $this->path . '/' . $asset['file_name'] . "' />";
                    break;
                case 'video':
                    $html = $html . "<video width='100%' controls>";
                    $html = $html . "<source src='" . $this->path . "/" . $asset['file_name'] . "' type='" . $asset['mime_type'] . "'>";
                    $html = $html . "Your browser does not support the video tag.";
                    $html = $html . "</video>";
                    break;
                case 'audio':
                    $html = $html . "<audio controls>";
                    $html = $html . "<source src='" . $this->path . "/" . $asset['file_name'] . "' type='" . $asset['mime_type'] . "'>";
                    $html = $html . "Your browser does not support the video tag.";
                    $html = $html . "</audio>";
                    break;
                default:
                    $html = $html . '<a href="' . $this->path . "/" . $asset['file_name'] . '" >';
                    $html = $html . '<strong>Download </strong>' . $asset['title'];
                    $html = $html . '</a>';
                    break;
            }

        }

        return $html;

    }

    public function update(Request $request, $id){

        $asset = Asset::find($id);
        $data = $request->json()->all();

        $asset->title = $data['title'];
        $asset->description = $data['description'];
        $asset->tags = $data['tags'];
        $asset->file_name = $data['file_name'];
        $asset->mime_type = $data['mime_type'];
        $asset->size = $data['size'];
        $asset->creator_id = auth()->user()->id;

        $asset->save();

    }


    

}
