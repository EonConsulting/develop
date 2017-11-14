<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\ContentBuilder\Models\Category;


class ContentBuilderAssets extends Controller {

    private $path;

    public function __construct(){

        $this->path = url('uploads/');
        
    }

    //resource method
    public function index() {

        $assets = Asset::all();
        $categories = Category::all();

        $breadcrumbs = [
            'title' => 'Asset Store'
        ];

        return view('eon.content-builder::assets.index', ['assets' => $assets, 'categories' => $categories, 'breadcrumbs' => $breadcrumbs]);
    
    }

    public function create(){

        $categories = Category::all();

        $breadcrumbs = [
            'title' => 'Create an Asset'
        ];

        return view('eon.content-builder::assets.create', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);

    }


    public function store(Request $request){

        $data = $request->all();

        //dd($data);

        if ($request->hasFile('assetFile'))
        {
            $file = $request->file('assetFile');

            $extension = $file->getExtension();


            switch ($extension){
                case 'mp3':
                    break;
                default:

            }

            $file_path = $file->store($file->getMimeType(),'uploads');
            $file_mime = $file->getMimeType();
            $file_size = $file->getClientSize();

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

        return redirect('content/assets');



    }

    public function show($id){

        $result = [];
        
        $asset = Asset::find($id);

        if($asset !== null){
            $result['found'] = true;
            $result['asset'] = $asset;
            $result['asset']->categories = $result['asset']->categories()->get();
        } else {
            $result['found'] = false;
        }
        
        return response()->json($asset);

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
