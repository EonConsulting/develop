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
    public function index() {

        $breadcrumbs = [
            'title' => 'Content Categories'
        ];

        $categories = Category::all();

        //dd($categories);

        return view('eon.content-builder::categories', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);
        
    }

    /**
     * Undocumented function
     *
     * @param [type] $category_id
     * @return void
     */
    public function show($category){

        if($category === "all"){
            $result = Category::all();  
        } else {
            $result = Category::find($category);
        }

        //dd($result);

        return response()->json($result);

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request){

        $data = $request->json()->all();

        $category = new Category([
            'name' => $data['name'],
            'tags' => $data['tags']
        ]);

        $category->save();

        return 200;

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $category
     * @return void
     */
    public function update(Request $request, $category){

        $category = Category::find($category);

        $data = $request->json()->all();

        $category->name = $data['name'];
        $category->tags = $data['tags'];

        $category->save();

        return 200;

    }

    /**
     * Undocumented function
     *
     * @param [type] $catgory_id
     * @return void
     */
    public function destroy($category_id){

        Category::destroy($category_id);

        return 200;

    }



}
