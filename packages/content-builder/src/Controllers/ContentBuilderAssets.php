<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\Alfresco\Rest as ARC;
use Illuminate\Support\Facades\Storage;
use App\Tools\Elasticsearch\Elasticsearch;
use App\Jobs\ElasticIndexAssets;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;


class ContentBuilderAssets extends Controller {

    private $path;
    private $mimes;
    
    /*
     * Alfresco Rest Client
     *
     * @var \EONConsulting\Alfresco\Rest\Classes\AlfrescoRest
     */
    protected $alfresco;

    /**
     * Elastic Client
     *
     * @var \EONConsulting\Core\Services\Elastic\Elastic
     */
    protected $elastic;

    public function __construct(ARC\AlfrescoRest $alfresco, Elastic $elastic){

        $this->alfresco = $alfresco;
        $this->elastic = $elastic;
        
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


    public function assetSearchToHTML(Request $request)
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

        $elastic_response = $this->elastic->index('assets')->body($query)->paginate(10);

        $renderedPag = view('eon.content-builder::assets.partials.pagination', ['items' => $elastic_response])->render();

        if($elastic_response->total() < 1)
        {
            return response()->json(['renderedResults' => '', 'renderedPag' => $renderedPag, 'searchMeta' => $meta], 200);
        }

        $items = collect($elastic_response->items());

        $assets = Asset::with('categories')
            ->whereIn('id', $items->pluck('_id'))
            ->orderBy(\DB::raw('FIELD(`id`, '. $items->pluck('_id')->implode(',') .')'))
            ->get();

        $renderedResults = '';

        foreach($assets as $asset)
        {
            $renderedResults = $renderedResults . view('eon.content-builder::assets.partials.result', ['asset' => $asset])->render();
        }

        return response()->json(['renderedResults' => $renderedResults, 'renderedPag' => $renderedPag, 'searchMeta' => $meta], 200);
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
    
    // AJAX request
    public function export(Request $request) {
        $data = $request->all();

        // get the asset from DB
        $asset = Asset::find($data["id"]);

        if (count($asset) > 0) {
            // sync it to alfresco, overwriting existing
            // put this alfresco in a try catch so that we don't break anything
            try {
                // MH : this is where we need to export the asset to alfresco
                
                // always create the folder
                //$alfresco_folder = $this->alfresco->CreateFolder(null, $data['name'], $nodetype, $relativepath) 
                
                // now create an emtpy file and then upload its content
                // an HTML file if content != null
                if (!empty($asset->content)) {
                    $result = $this->alfresco->CreateFile(null, $data['name'] . ".html", "cm:content", $data['folder']);
                    if ($result["code"] === 409)
                    {
                        return response('Conflict', 409);
                    } else {
                        $html_file_node_id = $result["id"];
                    }
                    
                    // upload its contents
                    // if content = NULL, check for file
                    // upload content as HTML and file as mime-type
                    $this->alfresco->UpdateContent($html_file_node_id, $asset->content);
                }

                if (!empty($asset->file_name)) {
                    $pathparts = pathinfo($asset->file_name);
                    $result = $this->alfresco->CreateFile(null, $data['name'] . '.' . $pathparts['extension'], "cm:content", $data['folder']);
                    if ($result["code"] === 409)
                    {
                        return response('Conflict', 409);
                    } else {
                        $mime_file_node_id = $result["id"];
                    }
                    // read file contents and update
                    if (Storage::disk('uploads')->exists($asset['file_name']))
                    {
                        $contents = Storage::disk('uploads')->get($asset['file_name']);
                        $this->alfresco->UpdateContent($mime_file_node_id, $contents);
                    }
                }
                
                return response('OK', 200);
            } catch (Exception $ex) {
                Log::error("Unable to create asset in Alfresco for asset_id : " . $content->id . " : " . $ex->getMessage());
                return response('Server Error', 500);
            }
        }
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

        if ($request->isMethod('post')) {
            $assetFile = Asset::find($id);
            if ($request->hasFile('assetFile')){
                 $assetFile = Asset::find($id);
                 Storage::delete($assetFile->file_name);
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
               
            } else {
            $file_path = $assetFile->file_name;
            $file_mime = $assetFile->mime_type;
            $file_size = $assetFile->size;
            }

            $asset = Asset::find($id);
            $asset->title = $request->input('title');
            $asset->description = $request->input('description');
            $asset->content = $request->input('content');
            $asset->tags = $request->input('tags');
            $asset->file_name = $file_path;
            $asset->mime_type = $file_mime;
            $asset->size = $file_size;
            $asset->creator_id = auth()->user()->id;
            $asset->save();
            $asset->categories()->sync($request->input('categories'));
            return Redirect('content/assets?from=0&size=20&searchterm=')->with('msg', 'Asset has been updated successfully');
        }else{
           return Redirect::back()->withErrors('msg', 'An error occured, please try again.');
        }
    }


    

}
