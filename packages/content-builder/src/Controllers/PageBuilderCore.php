<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageBuilderCore extends Controller {

    public function index() {

        return view('eon.content-builder::student.view', ['breadcrumbs' => $breadcrumbs]);
    }

}
