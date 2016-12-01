<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/30
 * Time: 1:30 PM
 */

namespace EONConsulting\PHPSaasWrapper\OAuth;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class Service {

    protected $client;
    public $client_id;
    protected $secret;
    public $redirect_uri;
    protected $adapter;
    public $return_uri;

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
        $this->client_id = $this->adapter->client_id;
        $this->secret = $this->adapter->secret;
        $this->redirect_uri = $this->adapter->redirect_uri;
        $this->return_uri = $this->adapter->return_uri;

        $this->client = new Client;
    }

    public function authorize() {
        $secret = $this->secret;

        $response = $this->client->request('GET', $this->redirect_uri, [
            'query' => [
                'client_id' => $this->client_id,
                'client_secret' => $secret,
                'redirect_uri' => $this->return_uri,
                'state' => '<changeme>',
            ],
            'headers' => [
                'accept' => 'application/json',
            ]
        ])->getBody();

        return json_decode($response)->access_token;

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