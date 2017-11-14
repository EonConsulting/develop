<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Category;


class ContentBuilderCategories extends Controller {


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param $category
     * @return \Illuminate\Http\JsonResponse
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
     * @param Request $request
     * @return int
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
     * @param Request $request
     * @param $category
     * @return int
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
     * @param $category_id
     * @return int
     */
    public function destroy($category_id){

        Category::destroy($category_id);

        return 200;

    }



}
