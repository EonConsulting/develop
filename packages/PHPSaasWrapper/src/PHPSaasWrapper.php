<?php

namespace EONConsulting\PHPSaasWrapper\src;

use EONConsulting\PHPSaasWrapper\Models\ServiceLinked;
use EONConsulting\PHPSaasWrapper\OAuth\OAuthEnum;
use EONConsulting\PHPSaasWrapper\OAuth\OAuthFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\AdapterFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\Config;
use Illuminate\Http\Request;
use Tsugi\Core\LTIX;

/**
 * Class PHPSaasWrapper
 * @package EONConsulting\PHPSaasWrapper\src
 */
class PHPSaasWrapper {

    /**
     * Authorize the API
     * @param $key
     * @return bool|mixed
     */
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

    /**
     * Get all the API's
     * @return string
     */
    public function index() {

        $config = new Config;

        $apis = array_keys($config->get('oauth.allows'));

        $html = '<ul>';

        for($i = 0; $i < count($apis); $i++) {
            $api = $apis[$i];

            $html .= '<li><a href="' . route('phpsaaswrapper.base_request', $api) . '">' . $api . '</a></li>';
        }

        $html .= '</ul>';
        return $html;

    }

    /**
     * Callback after authorization
     * @param Request $request
     * @return bool|string
     */
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

    /**
     * Check if the API needs Authentication
     * @param $key
     * @return array|mixed
     */
    public function needs_auth($key) {
        $config = new Config;
        return $config->needs_auth($key);
    }

    /**
     * Get the API Uses
     * @param $key
     * @return array|mixed
     */
    public function get_api_uses($key) {
        $config = new Config;
        return $config->get_api_uses($key);
    }

    /**
     * Generate the API Uses with Lavels, URI's and Slugs
     * @param $key
     * @return array
     */
    public function generate_api_uses($key) {
        $config = new Config;
        return $config->generate_api_uses($key);
    }

    /**
     * Generate the API Uses with Lavels, URI's and Slugs
     * @param $key
     * @param $use
     * @return array
     */
    public function generate_api_use($key, $use) {
        $config = new Config;

        if(gettype($use) == 'string') {
            $use = explode('+', $use);
        }

        return $config->generate_api_use($key, $use);
    }

    /**
     * Build the HTML tree
     * @param $key
     * @param $tree
     * @param string $pre_branch
     * @return string
     */
    public function build_html_tree($key, $tree, $pre_branch = '') {
        $config = new Config;
        $html = '';

        foreach ($tree as $branch => $twig) {
            $temp_twig = $twig;
            $label = '';

            $twig_html = '';

            if(is_array($temp_twig)) {
                if(array_key_exists('label', $temp_twig)) {
                    $label = $temp_twig['label'];
                }

                unset($temp_twig['uri']);
                unset($temp_twig['label']);

                $twig_html = $this->build_html_tree($key, $temp_twig, $branch . '.');
            } else {
                $label = $branch;
            }

            $label_obj = $config->get_labels($key, $branch);
            if(is_array($label_obj) && array_key_exists('label', $label_obj)) {
                $label = $label_obj['label'];
            }

            if($twig_html != '') {
                $html .= '<li>' . $label . ' ' . $twig_html . '</li>';
            } else {
                $html .= '<li><a href="' . url($key . '/consume/' . $pre_branch . $branch) . '">' . $label . '</a> ' . $twig_html . '</li>';
            }

        }

        if($html == '')
            return $html;

        return '<ul>' . $html . '</ul>';
    }

    /**
     * Display the API Uses
     * @param $key
     * @return string
     */
    public function display_api_uses($key) {

        $config = new Config;
        $uses = $config->generate_api_uses($key);

        $html = $this->build_html_tree($key, $uses);

        return '<a href="' . url('/') . '">Home</a><br /><br />' . $html;
    }

}