<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 1:24 PM
 */

namespace EONConsulting\PHPSaasWrapper\src\OAuth;


use Guzzle\Http\Client;

abstract class Service {

    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    abstract public function getAuthorizeUrl();
    abstract public function getUserByCode($code);

    public function authorizeUrl() {
        return $this->getAuthorizeUrl();
    }

    public function getUser($code) {
        return $this->getUserByCode($code);
    }

}