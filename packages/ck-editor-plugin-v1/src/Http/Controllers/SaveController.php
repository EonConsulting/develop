<?php

namespace EONConsulting\CKEditorPlugin\Http\Controllers;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 3/15/2017
 * Time: 2:38 PM
 */
class SaveController extends LTIBaseController {

    protected $hasLTI = false;

    //.Parse Parameters

    public function update(Request $request) {

        $page = md5('eonunisafile');
        if(!$page) {
            return redirect()->back();
        }
        //dd($request->get('data'));

        $ext = 'html';
        $file_name = pathinfo($page, PATHINFO_FILENAME) . '-' . time() . '.' . $ext;
        $file = @fopen(public_path($file_name), "w");
        fwrite($file, "<html><body>");
        fwrite($file, $request->get('data'));
        fwrite($file, "</body></html>");
        fclose($file);
        return response()->json(['success' => true, 'success_message' => 'Page saved.' . $file_name]);
    }

}