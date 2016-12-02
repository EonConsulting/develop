<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/30
 * Time: 2:14 PM
 */

namespace EONConsulting\PHPSaasWrapper\OAuth;


use EONConsulting\PHPSaasWrapper\src\Factories\Config;

class ServiceAdapter {

    public $key = '';
    public $client_id;
    public $secret;
    public $redirect_uri;
    public $return_uri;
    public $auth_url;
    public $access_token_uri;

    public function __construct() {
//        $this->set();
    }

    public function set($key) {
        $config = new Config();

        $this->key = $key;

        $this->client_id = $config->get('oauth.allows.' . $key . '.client_id');
        $this->secret = $config->get('oauth.allows.' . $key . '.secret');
        $this->redirect_uri = $config->generate_redirect_uri($key);
        $this->access_token_uri = $config->get('oauth.allows.' . $key . '.access_token_uri');
        $this->return_uri = $config->get('oauth.return_uri');

        $this->auth_url = $config->generate_redirect_uri($key);
    }

}