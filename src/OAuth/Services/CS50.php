<?php

namespace EONConsulting\PHPSaasWrapper\OAuth\Services;

use EONConsulting\PHPSaasWrapper\OAuth\ServiceAdapter;

/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:51 PM
 */
class CS50 extends ServiceAdapter {

    public $key = 'cs50';

    /**
     * CS50 constructor.
     */
    public function __construct() {
        parent::set($this->key);
    }


}