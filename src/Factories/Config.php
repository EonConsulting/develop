<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 11:11 AM
 */

namespace EONConsulting\PHPSaasWrapper\src\Factories;


class Config {

    /**
     * The DEFAULT config.
     * @var array
     */
    protected $data = [
        'oauth' => [
            'return_uri' => 'http://eon.dev/_eon_phpsaaswrapper/auth/callback',
            'allows' => [
                'github' => [
                    'client_id' => '634727d7b2b5c8016791',
                    'secret' => '19070a7bbbbb63d56ee4986028081b740df34d99',
                    'redirect_uri' => 'https://github.com/login/oauth/authorize'
                ]
            ]
        ]
    ];

    /**
     * Get the config value for a specific value given.
     * @param $keys
     * @return array|mixed
     */
    public function get($keys) {
        $data = $this->data;
        $keys = explode('.', $keys);

        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                $data = $data[$key];
                continue;
            }
        }

        return $data;
    }

}