<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\ContentBuilder\Models\Category;


class ContentBuilderAssets extends Controller {

    private $path;

    public function __construct(){

        $this->path = url('assets');
        
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

        $breadcrumbs = [
            'title' => 'Create an Asset'
        ];

        return view('eon.content-builder::assets.create', ['breadcrumbs' => $breadcrumbs]);

    }

    public function store(Request $request){
        $data = $request->json()->all();

        $asset = new Asset([
            'title' => $data['title'],
            'description' => $data['description'],
            'tags' => $data['tags'],
            'file_name' => $data['file_name'],
            'mime_type' => $data['mime_type'],
            'size' => $data['size'],
            'creator_id' => auth()->user()->id
        ]);
        
        $asset->save();
        //TODO: Add handling of mimetype and saving of file

        $result = [
            msg => ''
        ];

        return response()->json($result);

    }

    public function show($id){

        $result = [];
        
        $asset = Asset::find($id);

        if($asset !== null){
            $result['found'] = true;
            $result['asset'] = $asset;
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
