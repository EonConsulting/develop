<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/14
 * Time: 11:03 PM
 */

namespace EONConsulting\AppStore\Http\Controllers;


use EONConsulting\AppStore\AppStore;
use EONConsulting\LaravelLTI\Classes\Readers\ImportConfig;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use EONConsulting\LaravelLTI\Models\LTIContext;
use EONConsulting\LaravelLTI\Models\LTIDomain;

class AppStoreController extends LTIBaseController {

    protected $hasLTI = false;

    function index() {
        $domains = laravel_lti()->get_domains();

        return view('eon.appstore::store', ['tools' => $domains]);
    }

    function launch(LTIContext $context) {


        $key = ($context->key) ? $context->key->key_key : '';
        $secret = ($context->key) ? $context->key->secret : '';
        $launch_url = ($context->domain) ? $context->domain->domain : false;

        if(!$launch_url) {
            session()->flash('error_message', 'Sorry, something wen\'t wrong.');
            return redirect()->back();
        }

        $content = laravel_lti()->launch($launch_url, $key, $secret);

        return view('eon.appstore::launch', ['content' => $content, 'context' => $context]);
    }

}