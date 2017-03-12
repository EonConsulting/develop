<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
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
    /**
     * @var bool
     */
    protected $hasLTI = true;
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     */
    function index() {
        //This is the Store Iframe that will be requested by CKEditor Iframe in Pluigin.js of ckeditorv2 plugin
        $domainslist   = laravel_lti()->get_domains();
        return view('ckeditorpluginv2::editorstore', ['tools' => $domainslist]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    function getEditorView() {
        //Here we Just Simply Creating an instance of the Editor
        return view('ckeditorpluginv2::editorv2');
    }

    /**
     * @param LTIContext $context
     * @return \Illuminate\Http\JsonResponse
     */
    function getAJAXresponse(LTIContext $context) {
        //This is an API that can be used to get a response of available domains
        //$.get(domain, data)Send Parameter Response in Real Time

        $key = ($context->key) ? $context->key->key_key : '';
        $secret = ($context->key) ? $context->key->secret : '';
        $launch_url = ($context->domain) ? $context->domain->domain : false;
        //Array with Response Keys and Values
        $launch_params = [
            'key'         => $key,
            'secret'      => $secret,
            'launch_url'  => $launch_url

        ];
        return response()->json($launch_params);

    }

    /**
     * @param LTIContext $context
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    function launch(LTIContext $context) {


        $key = ($context->key) ? $context->key->key_key : '';
        $secret = ($context->key) ? $context->key->secret : '';
        $launch_url = ($context->domain) ? $context->domain->domain : false;

        if(!$launch_url) {
            session()->flash('error_message', 'Sorry, something wen\'t wrong.');
            return redirect()->back();
        }

        $content = laravel_lti()->launch($launch_url, $key, $secret);

        return view('ckeditorpluginv2::launch', ['content' => $content, 'context' => $context]);
    }

}