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

    }

    public function create(){
        return view('eon.storyline2::templates.designer');
    }

}