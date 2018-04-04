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
    public function update(Request $req){

        $validator = Validator::make($req->all(), [
                    'name' => 'required',
        ]);
        
        if ($validator->passes()) {
            $cat = Category::find((int)$req->id);
            $cat->name = $req->name;
            $cat->tags = $req->tags;
            $cat->save();
            return response()->json(['success'=>'Content category has been updated successfully.']);
        }
        return response()->json(['error' => $validator->errors()->all()]);        
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
