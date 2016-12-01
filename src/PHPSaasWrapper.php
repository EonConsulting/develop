<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:08 AM
 */

namespace EONConsulting\PHPSaasWrapper\src;
//require '../vendor/guzzlehttp/streams/src/functions.php';

use EONConsulting\PHPSaasWrapper\OAuth\OAuthEnum;
use EONConsulting\PHPSaasWrapper\OAuth\OAuthFactory;
use EONConsulting\PHPSaasWrapper\OAuth\Service;
use EONConsulting\PHPSaasWrapper\src\Factories\AdapterFactory;
use Illuminate\Http\Request;

class PHPSaasWrapper {

    public function connect() {
        $factory = new OAuthFactory(new AdapterFactory());
        $github = $factory->make(OAuthEnum::GITHUB);

        return redirect($github->getAuthorizeUrl());
    }

    public function callback(Request $request) {
        $factory = new OAuthFactory(new AdapterFactory());
        $github = $factory->make(OAuthEnum::GITHUB);

        if(!$github->authorize($request)) {

        }
    }

}