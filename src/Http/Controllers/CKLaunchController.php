<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/5/2017
 * Time: 1:59 PM
 */

namespace EONConsulting\CKEditorPlugin\Http\Controllers;

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

    public function setLaunchContent() {return view('ckeditorplugin::ltiCKEditor');}
    public function forms() {return view('ckeditorplugin::iframeview');}

    /**
     * @param string $launch_url
     * @param string $key
     * @param string $secret
     * @return mixed
     */
    public function getLaunchContent($launch_url ='', $key='', $secret='')
    {

//        //Validate to Make Sure the Launch Url is not empty
//        if(! request()->has('launch_url')) {
//            session()->flash('error_message', 'The Launch URL can not be empty');
//            return redirect()->route('ckeditor.launchframe');
//        }

        $launch_url = request()->launch_url;
        $key = request()->key;
        $secret = request()->secret;

        $response = laravel_lti()->launch($launch_url, $key, $secret);

        return ($response);

//        $response = array(
//            'status' => 'success',
//            'msg' => 'Setting created successfully',
//        );
    }


}