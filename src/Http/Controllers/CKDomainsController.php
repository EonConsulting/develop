<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/14
 * Time: 11:03 PM
 */

namespace EONConsulting\CKEditorPluginV2\Http\Controllers;


use EONConsulting\CKEditorPluginV2\CKEditorPluginV2;
use EONConsulting\LaravelLTI\Classes\Readers\ImportConfig;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use EONConsulting\LaravelLTI\Models\LTIContext;
use EONConsulting\LaravelLTI\Models\LTIDomain;

class CKDomainsController extends LTIBaseController {

    protected $hasLTI = false;

    function index() {
        $domains = laravel_lti()->get_domains();

        return view('ckeditorpluginv2::editorv2', ['tools' => $domains]);
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