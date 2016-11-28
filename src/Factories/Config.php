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
            'allows' => [
                ''
            ]
        ],
        'oauth2' => [
            'allows' => [

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