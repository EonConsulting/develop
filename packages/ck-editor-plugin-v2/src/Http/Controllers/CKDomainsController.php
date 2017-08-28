<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/02/14
 * Time: 11:03 PM
 */

namespace EONConsulting\CKEditorPluginV2\Http\Controllers;

use EONConsulting\CKEditorPlugin\Models\LtiCkDomain;
use EONConsulting\CKEditorPlugin\src\Factories\Config;
use EONConsulting\CKEditorPluginV2\CKEditorPluginV2;
use EONConsulting\LaravelLTI\Classes\Readers\ImportConfig;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use EONConsulting\LaravelLTI\Models\LTIContext;
use EONConsulting\LaravelLTI\Models\LTIDomain;
use Illuminate\Http\Request;
use EONConsulting\LaravelLTI\Classes\Domains;
use Illuminate\Support\Facades\DB;
use EONConsulting\CKEditorPluginV2\Http\Controllers\PartialMatch;

class CKDomainsController extends LTIBaseController {
    /**
     * @var bool
     */
    protected $hasLTI = false;
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index() {

        $domainslist   = ckeditorpluginv2()->list_domains();

        return view('ckeditorpluginv2::editorstore', ['tools' => $domainslist]);

    }

    /**
     * @return array
     */
    public function CKAngularRest() {

        $domainslist = ckeditorpluginv2()->list_domains();

        return $domainslist;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function getEditorView() {
        return view('ckeditorpluginv2::editorv2');
    }

    /**
     * @param LTIContext $context
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAJAXresponse(LTIContext $context) {
        //This is an API that can be used to get a response of available domains
        //$.get(domain, data)Send Parameter Response in Real Time

        $key = ($context->key) ? $context->key->key_key : '';
        $secret = ($context->key) ? $context->key->secret : '';
        $launch_url = ($context->domain) ? $context->domain->domain : false;

        return laravel_lti()->launch($launch_url, $key, $secret);


    }

    /**
     * @param LTIContext $context
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function launch(LTIContext $context) {

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