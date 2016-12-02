<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/30
 * Time: 1:30 PM
 */

namespace EONConsulting\PHPSaasWrapper\OAuth;

use EONConsulting\PHPSaasWrapper\Models\ServiceAvailable;
use EONConsulting\PHPSaasWrapper\Models\ServiceLinked;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Http\Request;

class Service {

    public $key;
    protected $client;
    public $client_id;
    protected $secret;
    public $redirect_uri;
    protected $adapter;
    public $return_uri;
    public $access_token_uri;
    public $auth_url;
    protected $auth_response;
    protected $access_token;

    /**
     * Service constructor.
     * @param ServiceAdapter $adapter
     */
    public function __construct(ServiceAdapter $adapter) {
        $this->adapter = $adapter;
        $this->set_data();
    }

    /**
     * Set the data
     */
    public function set_data() {
        $this->key = $this->adapter->key;
        $this->client_id = $this->adapter->client_id;
        $this->secret = $this->adapter->secret;
        $this->redirect_uri = $this->adapter->redirect_uri;
        $this->return_uri = $this->adapter->return_uri;
        $this->access_token_uri = $this->adapter->access_token_uri;
        $this->auth_url = $this->adapter->auth_url;

        $this->client = new Client;
    }

    public function getAuthorizeUrl() {
        return $this->auth_url;
    }

    public function authorize(Request $request) {

        $code = '';

        if($request->has("code")) {
            $code = $request->get('code');
        }

        $secret = $this->secret;

        $response = $this->client->request('GET', $this->access_token_uri, [
            'query' => [
                'client_id' => $this->client_id,
                'client_secret' => $secret,
                'redirect_uri' => $this->return_uri,
                'code' => $code,
                'state' => session('return_url'),
            ],
            'headers' => [
                'accept' => 'application/json',
            ]
        ])->getBody();

        $response = json_decode($response);
        $this->auth_response = $response;

        $service = ServiceAvailable::where('service_key', $this->key)->select('service_id')->first();

        if(key_exists('access_token', $response)) {
            $this->access_token = $response->access_token;

            if($service) {
                ServiceLinked::where('service_id', $service->service_id)->update(['active' => 0]);
                ServiceLinked::create(['service_id' => $service->service_id, 'active' => 1, 'token' => $response->access_token]);
            }

            return true;
        }

        $linked = ServiceLinked::where('service_id', $service->service_id)->where('active', 1)->first();
        if(!$linked) {
            return $this->getAuthorizeUrl();
        }

        return false;

    }

    /**
     * @return mixed
     */
    public function getClientId() {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    private function getSecret() {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret) {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri() {
        return $this->redirect_uri;
    }

    /**
     * @param mixed $redirect_uri
     */
    public function setRedirectUri($redirect_uri) {
        $this->redirect_uri = $redirect_uri;
    }

    /**
     * @return mixed
     */
    public function getReturnUri() {
        return $this->return_uri;
    }

    /**
     * @param mixed $return_uri
     */
    public function setReturnUri($return_uri) {
        $this->return_uri = $return_uri;
    }

    /**
     * @return mixed
     */
    public function getClient() {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client) {
        $this->client = $client;
    }

    /**
     * @return ServiceAdapter
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * @param ServiceAdapter $adapter
     */
    public function setAdapter($adapter) {
        $this->adapter = $adapter;
    }


}