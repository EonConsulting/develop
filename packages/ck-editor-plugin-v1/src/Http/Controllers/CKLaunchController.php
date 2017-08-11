<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/5/2017
 * Time: 1:59 PM
 */

namespace EONConsulting\CKEditorPlugin\Http\Controllers;

use EONConsulting\CKEditorPlugin\Models\LtiCkDomain;
use App\Http\Controllers\Controller;
use EONConsulting\LaravelLTI\Classes\Readers\ImportConfig;
use EONConsulting\LaravelLTI\Http\Requests\StoreLTIToolRequest;
use EONConsulting\LaravelLTI\Models\LTIContext;
use EONConsulting\LaravelLTI\Models\LTIDomain;
use EONConsulting\LaravelLTI\Models\LTIKey;
use Illuminate\Http\Request;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Tsugi\Util\LTI;
use Tsugi\Config\ConfigInfo;

class CKLaunchController extends LTIBaseController
{

    /**
     * @var $launch_url, $launch_key, $launch_secret
     */

    protected   $hasLTI = true;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    protected $passed = [
        'status'  => 'success',
    ];

    protected $failed = [
        'status' => 'error',
    ];

    protected $failedDomainExists = [
        'status' => 'domainerror',
    ];

    public function setLaunchContent() {return view('ckeditorplugin::ltiCKEditor');}
    public function forms() {return view('ckeditorplugin::iframeview');}

    /**
     * @param Request $request
     * @return mixed
     */
    public function newLaunch(Request $request) {

        $launch_url = $request->get('launch_url', '');
        $key = $request->get('key', '');
        $secret = $request->get('secret', '');

        //Returning an Object from LTiCkDomain
        $obj = LtiCkDomain::where('launch_url', $launch_url)->first();
        if (!$obj) {
            return false;
        }
        $key = $obj->key;
        $secret = $obj->secret;

        return laravel_lti()->launch($launch_url, $key, $secret);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     */

    public function getLaunchParams() {

        //Get a Response Array Object

        $user = laravel_lti()->get_user_lti_details(request()->user());
        return response()->json($user);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function launchtransport(Request $request) {


        if ($request->has('launch_url')) {

            $launch_url = $request->all()['launch_url'];

        }

        if (LtiCkDomain::where('launch_url', $launch_url)->first()) {

                if ($request->has('key')) {

                }

            return response()->json(['launch_url' => $launch_url, $this->failedDomainExists]);


        }

        $key = '';
        $secret = '';

        if ($request->has('key')) {

            $key = $request->all()['key'];
        }

        if ($request->has('secret')) {

            $secret = $request->all()['secret'];

        }

        $launchdomain = new LtiCkDomain;
        $launchdomain->launch_url = $launch_url;
        $launchdomain->key = $key;
        $launchdomain->secret = $secret;
        $launchdomain->save();

        return response()->json($this->passed);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function xmltransport(Request $request) {

        //Request XML File (Use Import Config and Read From File Method)
        $xml = ImportConfig::read_from_url($request->all()['launch_url']);

        if (!$xml) {

            return response()->json($this->failed);
        }

        $arr = (array) $xml;

        if ($arr && array_key_exists('bltilaunch_url', $arr)) {

            $launch_url = $arr['bltilaunch_url'];

        }else {

            return response()->json($this->failed);
        }


        $key = '';
        $secret ='';


        if ($request->has('key')) {
            $key = $request->all()['key'];
        }

        if ($request->has('secret')) {

            $secret = $request->all()['secret'];
        }


        if (LtiCkDomain::where('launch_url', $launch_url)->first()) {

            LtiCkDomain::where('launch_url', $launch_url)->first()
                ->update(['key' => $key, 'secret' => $secret]);

            return response()->json(['launch_url' => $launch_url, $this->failedDomainExists]);


        }

        $domain = new LtiCkDomain;
        $domain->launch_url = $launch_url;
        $domain->key = $key;
        $domain->secret = $secret;
        $domain->save();

//      $response = LtiCkDomain::where('launch_url', $launch_url)->first(); // Avoid Repeating Queries
        $response = $domain->toArray();
        unset($response['key']);
        unset($response['secret']);
        return response()->json($response);

    }


}