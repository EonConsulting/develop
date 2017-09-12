<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Category;


class ContentBuilderCategories extends Controller {

   

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request) {

        if ($request->all())
        {
            $category = new Category([
                'name' => $request->get('name'),
                'tags' => $request->get('tags')
            ]);
    
            $category->save();
    
            return redirect()->route('eon.contentbuilder.categories');

        } else {
            
            $breadcrumbs = [
                'title' => 'Content Categories'
            ];

            $categories = Category::all();

            return view('eon.content-builder::categories', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);

        }
        
    }


    /**
     * Undocumented function
     *
     * @param [type] $category_id
     * @return void
     */
    public function json($category_id){

        if($category_id === "all"){
            $result = Category::all();
        } else {
            $result = Category::find($category_id);   
        }

        return json_encode($result);

    }


    /*public function update(Request $request){
        
    }*/

    /**
     * Undocumented function
     *
     * @param [type] $catgory_id
     * @return void
     */
    public function delete($catgory_id){

        Category::delete($category_id);

        return redirect()->route('eon.contentbuilder.categories');

    }



}
