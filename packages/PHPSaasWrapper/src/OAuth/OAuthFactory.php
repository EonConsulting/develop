<?php

namespace EONConsulting\PHPSaasWrapper\OAuth;


use EONConsulting\PHPSaasWrapper\src\Factories\AdapterFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\Factory;

/**
 * Class OAuthFactory
 * @package EONConsulting\PHPSaasWrapper\OAuth
 */
class OAuthFactory implements Factory {

    // adapter
    protected $adapter;

    /**
     * OAuthFactory constructor.
     * @param AdapterFactory $adapter
     */
    public function __construct(AdapterFactory $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Get the service
     * @param $config
     * @return Service
     */
    public function make($config) {
        return new Service($this->adapter->make($config));
    }

}