<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:54 PM
 */

namespace EONConsulting\PHPSaasWrapper\src\Controllers;


use App\Http\Controllers\Controller;
use EONConsulting\PHPSaasWrapper\src\Factories\Config;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestAPIController extends Controller {

    protected $client;

    /**
     * TestAPIController constructor.
     */
    public function __construct() {
        $this->client = new Client;
    }


    private function needs_auth($key) {
        $needs_auth = (phpsaaswrapper()->needs_auth($key) == 'true') ? true : false;
        if($needs_auth) {
            return true;
        }
        return false;
    }

    function base_request(Request $request, $key) {
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
            // consume service

            return phpsaaswrapper()->display_api_uses($key);
        }
    }

    function consume(Request $request, $key, $use) {

        $api_links = phpsaaswrapper()->generate_api_use($key, $use);

        $responses = [];

        $this->client = new Client;

        $config = new Config;
        $templates = [];

        foreach($api_links as $k => $v) {

            if(!array_key_exists($k, $templates)) {
                $res = $config->get('oauth.allows.' . $key . '.templates.' . $k);
                if(gettype($res) == 'string') {
                    $templates[$k] = $res;
                } else {
                    $templates[$k] = null;
                }
            }

            $response = $this->client->request('GET', $v, [
                'headers' => [
                    'accept' => '*/*',
                ]
            ])->getBody();

            if(!array_key_exists($k, $responses)) {
                $responses[$k] = [];
            }

            if(!array_key_exists('template', $responses)) {
                $responses[$k]['template'] = '';
            }

            if(!array_key_exists('response', $responses)) {
                $responses[$k]['response'] = '';
            }

            if(empty($templates[$k]) || is_null($templates[$k]) || view()->exists($templates[$k])) {
                $templates[$k] = null;
            }

            $responses[$k]['key'] = $key;
            $responses[$k]['template'] = $templates[$k];
            $responses[$k]['response'] = json_decode($response);
        }

        return view('consume', ['responses' => $responses, 'key' => $key, 'use' => $use]);

    }

    function consume_with_options(Request $request, $key, $use, $options) {
        $api_links = phpsaaswrapper()->generate_api_use($key, $use);

        $responses = [];

        $this->client = new Client;

        $config = new Config;
        $templates = [];

        $options = explode('+', $options);
        $sorted_options = [];
        for($i = 0; $i < count($options); $i++) {
            $option = $options[$i];

            $obj = explode('-', $option);

            $sorted_options[$obj[0]] = $obj[1];
        }

        foreach($api_links as $k => $v) {

            if(!array_key_exists($k, $templates)) {
                $res = $config->get('oauth.allows.' . $key . '.templates.' . $k);
                if(gettype($res) == 'string') {
                    $templates[$k] = $res;
                } else {
                    $templates[$k] = null;
                }
            }

            $queries = explode('?', $v);
            if(count($queries) >= 1) {
                $ops = explode('&', $queries[1]);
                for($i = 0; $i < count($ops); $i++) {
                    $o = $ops[$i];

                    $obj = explode('=', $o);

                    $sorted_options[$obj[0]] = $obj[1];
                }
            }

            $response = $this->client->request('GET', $v, [
                'query' => $sorted_options,
                'headers' => [
                    'accept' => '*/*',
                ]
            ])->getBody();

            if(!array_key_exists($k, $responses)) {
                $responses[$k] = [];
            }

            if(!array_key_exists('template', $responses)) {
                $responses[$k]['template'] = '';
            }

            if(!array_key_exists('response', $responses)) {
                $responses[$k]['response'] = '';
            }

            if(empty($templates[$k]) || is_null($templates[$k]) || view()->exists($templates[$k])) {
                $templates[$k] = null;
            }

            $responses[$k]['key'] = $key;
            $responses[$k]['template'] = $templates[$k];
            $responses[$k]['response'] = json_decode($response);
        }

        return view('consume', ['responses' => $responses, 'key' => $key, 'use' => $use]);
    }

}