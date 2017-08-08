<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:28 AM
 */

namespace EONConsulting\CKEditorPluginV2;
use EONConsulting\CKEditorPluginV2\Classes\DomainOBJ;
use EONConsulting\CKEditorPluginV2\Http\Controllers\CKEditorSaveController;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;


class CKEditorPluginV2 extends LTIBaseController {

    public function get_store() {
        return view('ckeditorpluginv2::store');
    }

    public function list_domains() {
        return DomainOBJ::listDomains();
    }

    public function makePDF($data = '') {
        return CKEditorSaveController::htmltoPDF($data);
    }

}