<?php

namespace App\Http\Controllers\Builders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageBuilderCore extends Controller {

    public function index() {
        return view('lecturer.builders.page');
    }

}
