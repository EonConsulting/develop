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



    public function update(){
        
    }



}
