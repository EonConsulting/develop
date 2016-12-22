<?php

namespace EONConsulting\PHPSaasWrapper\src\Factories;

use EONConsulting\PHPSaasWrapper\OAuth\OAuthEnum;
use EONConsulting\PHPSaasWrapper\OAuth\Services\Github;

/**
 * Class AdapterFactory
 * @package EONConsulting\PHPSaasWrapper\src\Factories
 */
class AdapterFactory {

    /**
     * Get the adapter needed
     *
     * @param $config
     * @return Github
     */
    public function make($config) {
        switch ($config) {
            case OAuthEnum::GITHUB:
                return new Github;
        }
    }

}