<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:08 AM
 */

namespace EONConsulting\PHPSaasWrapper\src;

use EONConsulting\PHPSaasWrapper\Models\ServiceLinked;
use EONConsulting\PHPSaasWrapper\OAuth\OAuthEnum;
use EONConsulting\PHPSaasWrapper\OAuth\OAuthFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\AdapterFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\Config;
use Illuminate\Http\Request;

class PHPSaasWrapper {

    public function authorize($key) {
        $factory = new OAuthFactory(new AdapterFactory);
        $service = $factory->make($key);

        $record = ServiceLinked::select(['psw_services_available.service_id', 'psw_services_linked.*'])->join('psw_services_available', 'psw_services_available.service_id', '=', 'psw_services_linked.service_id')->where('psw_services_available.service_key', $key)->first();
        if(!$record || $record->active == 0) {
            $auth_url = $service->getAuthorizeUrl();
            return $auth_url;
        }

        return true;
    }

    public function callback(Request $request) {
        $factory = new OAuthFactory(new AdapterFactory());
        $github = $factory->make(OAuthEnum::GITHUB);

        if(session()->has('return_url')) {
            $return_url = session()->get('return_url');
            session()->forget('return_url');
            session()->flush();

            if(!$github->authorize($request)) {
                // not authorized
                return false;
            }

            return $return_url;
        } else {
            if(!$github->authorize($request)) {
                // not authorized
                return 'not authorized';
            }

            return 'authorized';
        }

        // consume service
    }

    public function needs_auth($key) {
        $config = new Config;
        return $config->needs_auth($key);
    }

    public function get_api_uses($key) {
        $config = new Config;
        return $config->get_api_uses($key);
    }

    public function generate_api_uses($key) {
        $config = new Config;
        return $config->generate_api_uses($key);
    }

    public function generate_api_use($key, $use) {
        $config = new Config;

        if(gettype($use) == 'string') {
            $use = explode('+', $use);
        }

        return $config->generate_api_use($key, $use);
    }

    public function display_api_uses($key) {
        $config = new Config;
        $uses = $config->generate_api_uses($key);

        $links = '<ul>';

        foreach($uses as $use => $link) {
            $links .= '<li><a href="' . url($key . '/consume/' . $use) . '">' . $use . '</a></li>';
        }

        $links .= '</ul>';

        return $links;
    }

}