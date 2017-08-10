<?php

namespace App\Http\Controllers\Builders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StorylineBuilderController extends Controller {

    public function index() {
		
		
        return view('lecturer.builders.storyline');
    }

}
