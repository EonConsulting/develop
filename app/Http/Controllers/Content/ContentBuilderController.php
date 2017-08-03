<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentBuilderController extends Controller {

    public function index() {

        $breadcrumbs = [
            'title' => 'Content Builder',
        ];

        return view('lecturer.builders.page', ['breadcrumbs' => $breadcrumbs]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
            $page = public_path() . '/EON/system/public/vendor/storyline/core/files/content/' . $this->new_file_request($request) . '.html';
            $file = fopen($page, "w");
            fwrite($file, json_decode($request->get('data')));
            fclose($file);

            session()->flash('success_message', 'File saved under ' . $this->new_file_request($request) . '.html');
            return redirect()->route('content.builder');
    }


    /**
     * @param $request
     * @return mixed
     *
     */
    protected function new_file_request($request) {
        $file_name = $request->get('file_name');
        if (str_word_count($file_name) > 1) {
            $new_file_name = preg_replace('/\s+/', '_', $file_name);
            return $new_file_name;
        } else {
            return $file_name;
        }
    }

}
