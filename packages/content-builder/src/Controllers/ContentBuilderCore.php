<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;

class ContentBuilderCore extends Controller {


    
    public function index() {

        $content = Content::all();

        foreach($content as $k => $item){

            $categories = $content->categories();

            foreach($categories as $category){
                
            }


        }

        $breadcrumbs = [
            'title' => 'Content Store',
        ];

        return view('eon.content-builder::store', ['content' => $content, 'breadcrumbs' => $breadcrumbs]);
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function create() {
        $breadcrumbs = [
            'title' => 'Content Builder',
        ];

        $categories = Category::all();

        return view('eon.content-builder::create', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request) {

        $content = new Content([
            'title' => $request->get('title'),
            'body' => $request->get('data'),
            'tags' => $request->get('tags'),
            'creator_id' => auth()->user()->id
        ]);

        $categories = $request->get('categories');

        foreach($categories as $k => $category_id) {
            $temp = Category::find($category_id);
            $content->categories()->save($temp);
        }

        $content->save();

        return redirect()->route('eon.contentbuilder');
    }


    /**
     * @param $request
     * @return mixed
     *
     */
    protected function new_file_request($request) {
        $file_name = $request->get('file_name');
        if (str_word_count($file_name) > 1) {
            $new_file_name = preg_replace('/\s+/', '_', $file_name);
            return $new_file_name;
        } else {
            return $file_name;
        }
    }

}
