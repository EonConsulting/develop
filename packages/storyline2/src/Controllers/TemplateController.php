<?php


namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use EONConsulting\Storyline2\Transformers\TemplateTransformer;
use EONConsulting\Storyline2\Models\Template;


class TemplateController extends BaseController {

    public function index() {

        $breadcrumbs = [
            'title' => 'Templates'
        ];

        $data = [
            'templates' => Template::all(),
            'breadcrumbs' => $breadcrumbs
        ];

        return view('eon.storyline2::templates.index', $data);

    }

    public function create(){

        $breadcrumbs = [
            'title' => 'Templates',
            'href' => url('storyline2/templates'),
            'child' => [
                'title' => 'Create a Template'
            ]
        ];

        $data = [
            'edit' => false,
            'breadcrumbs' => $breadcrumbs
        ];

        return view('eon.storyline2::templates.designer', $data);
    }

    public function edit($template){

        $breadcrumbs = [
            'title' => 'Templates',
            'href' => url('storyline2/templates'),
            'child' => [
                'title' => 'Edit a Template'
            ]
        ];

        $template = Template::find($template);

        $data = [
            'edit' => true,
            'template' => $template,
            'breadcrumbs' => $breadcrumbs
        ];

        return view('eon.storyline2::templates.designer', $data);
    }

    public function store(Request $request){

        $data = $request->json()->all();

        //dd($data);

        $new_template = new Template([
            'name' => $data['name'],
            'styles' => $data['styles'],
            'creator_id' => auth()->user()->id
        ]);

        //dd($new_template);

        $new_template->save();
    
        return response()->json([
            'msg' => 'success',
            'template' => $new_template
        ]);
    }

    public function update(Request $request, $template){
        
        $data = $request->json()->all();

        $template = Template::find($template);

        $template->name = $data['name'];
        $template->styles = $data['styles'];

        $template->save();

    }
}