<?php

namespace EONConsulting\CKEditorPluginV2\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 3/15/2017
 * Time: 2:38 PM
 */
class CKEditorSaveController extends LTIBaseController {
    /**
     * @var bool
     */
    protected $hasLTI = false;
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {

        $page = md5('eonunisafile');
        if(!$page) {
            return redirect()->back();
        }

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