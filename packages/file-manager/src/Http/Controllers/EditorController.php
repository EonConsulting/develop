<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/22
 * Time: 7:37 AM
 */

namespace EONConsulting\FileManager\Http\Controllers;


use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use App\Http\Controllers\Controller;

class EditorController extends Controller {


    public function index() {
        $page = request()->get('p');
        if(!$page) {
            return redirect()->back();
        }

        return view('eon.filemanager::editor', ['page' => $page]);
    }

}