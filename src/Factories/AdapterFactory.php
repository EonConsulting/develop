<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:11 AM
 */

namespace EONConsulting\PHPSaasWrapper\src\Factories;


use EONConsulting\PHPSaasWrapper\OAuth\OAuthEnum;
use EONConsulting\PHPSaasWrapper\OAuth\Services\Github;

class AdapterFactory {

    /**
     * @param $config -> Of type CONFIG
     * @return
     */
    public function make($config) {
        switch ($config) {
            case OAuthEnum::GITHUB:
                return new Github;
        }
    }

}