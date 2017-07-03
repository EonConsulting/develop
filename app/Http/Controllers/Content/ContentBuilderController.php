<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentBuilderController extends Controller {

    public function index() {
        return view('lecturer.builders.page');
    }

    public function store(Request $request) {
        $page = public_path().'/EON/system/public/vendor/storyline/core/files/content/' . $request->get('file_name') . '.html';

        $file = fopen($page, "w");
        fwrite($file, json_decode($request->get('data')));
        fclose($file);

        session()->flash('success_message', 'File saved under ' . $request->get('file_name') . '.html');
        return redirect()->route('content.builder');
    }

}