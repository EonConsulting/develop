<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 12:28 AM
 */

namespace EONConsulting\CKEditorPluginV2;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;




class CKEditorPluginV2 extends LTIBaseController {



    public function get_store() {
        return view('ckeditorpluginv2::store');
    }
    //Connect to a TAO API and get a response (3 Calls to be made with CURL)


}