<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/30
 * Time: 2:00 PM
 */

namespace EONConsulting\PHPSaasWrapper\OAuth\Services;


use EONConsulting\PHPSaasWrapper\OAuth\ServiceAdapter;
use Guzzle\Http\Client;

class Github extends ServiceAdapter {

    protected $key = 'github';

    public function __construct() {
        parent::set($this->key);
    }


}