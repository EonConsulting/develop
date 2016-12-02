<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:54 PM
 */

namespace EONConsulting\PHPSaasWrapper\src\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestAPIController extends Controller {

    private function needs_auth($key) {
        $needs_auth = (phpsaaswrapper()->needs_auth($key) == 'true') ? true : false;
        if($needs_auth) {
            return true;
        }
        return false;
    }

    function cs50(Request $request) {
        $key = 'github';
        if($this->needs_auth($key)) {
            echo 'needs auth';
            session(['return_url' => $request->fullUrl()]);
            session()->save();

            if(phpsaaswrapper()->authorize($key) !== true) {
                $cookie = cookie('eon_referrer', $request->fullUrl(), 45000);
                return redirect(phpsaaswrapper()->authorize($key))->withCookie($cookie);
            }

            dd(phpsaaswrapper()->authorize($key));
        } else {
            echo 'does not need auth';
        }

    }

}