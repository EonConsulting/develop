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
    function index() {

        $domainslist   = ckeditorpluginv2()->list_domains();
//        dd($domainslist);

        return view('ckeditorpluginv2::editorstore', ['tools' => $domainslist]);

    }

    function selectsearch(Request $request) {

        $term = $request->get('term');

//        $obj = new LTIDomain;
//        $obj->json->bltidescription;
//        dd($obj);

        if (!isset($term)) {

            session()->flash('error_message', 'You Search Criteria Can Not be Empty');
            return redirect()->back();

        }

        if (!empty($term)) {

            //

            //Perfom Query only if request contains a search Query Var
            $searches = DB::table('lti_domain')
                ->join('lti_context', 'lti_domain.context_id', '=', 'lti_context.context_id')
                ->where('title', 'like', $term  . '%')
                //->orWhere('lti_domain.json->bltidescription', 'like', $term .'%')
                ->orderBy('title')
                ->simplePaginate(8);

           // dd($searches);

            return view('ckeditorpluginv2::search', ['searches' => $searches]);

//            $response = ('lti_domain')->where([['json->bltititle', 'like', '%' . $term .'%']])
////                ->orWhere([['json->bltidescription', 'like', $q]])
//                ->get();
//
//            dd($response);


        }


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

        return laravel_lti()->launch($launch_url, $key, $secret);


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