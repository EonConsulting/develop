<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Category;
use Validator;


class ContentBuilderCategories extends Controller {


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $breadcrumbs = [
            'title' => 'Content Categories'
        ];

        $categories = Category::all();

        return view('eon.content-builder::categories.categories', ['categories' => $categories, 'breadcrumbs' => $breadcrumbs]);
        
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'tags' => 'required',
        ]);

        $category = Category::create($data);

        return response()->json(['message' => 'Category created!'], 200);
    }
    
    /**
     * 
     * @param type $id
     */
     public function edit($id){
        
        $category = Category::find($id);
        return view('eon.content-builder::categories.edit', ['category' => $category]);
     }
    /**
     * @param Request $request
     * @param $category
     * @return int
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'tags' => 'required',
        ]);

        $category = Category::find($data['id']);

        $category->name = $data['name'];
        $category->tags = $data['tags'];

        $category->save();

        return response()->json(['message'=>'Content category has been updated successfully.'], 200);
    }

    /**
     * @param $category_id
     * @return int
     */
    public function destroy($category_id){

       $Cat = Category::destroy($category_id);
       if($Cat){
         return redirect('content/categories')->with('msg', 'Category has been deleted successsfully.'); 
       }
       return redirect('content/categories')->with('error', 'An error occured, please try again.');
    }



}
