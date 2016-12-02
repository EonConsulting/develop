<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/30
 * Time: 2:08 PM
 */

namespace EONConsulting\PHPSaasWrapper\OAuth;


use EONConsulting\PHPSaasWrapper\src\Factories\AdapterFactory;
use EONConsulting\PHPSaasWrapper\src\Factories\Factory;

class OAuthFactory implements Factory {

    protected $adapter;

    public function __construct(AdapterFactory $adapter) {
        $this->adapter = $adapter;
    }

    public function make($config) {
        return new Service($this->adapter->make($config));
    }

}