<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:06 AM
 */

namespace EONConsulting\PHPStencil\src\Factories;

/**
 * Class Config
 * @package EONConsulting\PHPStencil\src\Factories
 */
class Config {

    /**
     * The DEFAULT config.
     * @var array
     */
    protected $data = [
        'text' => [
            'default' => 'csv'
        ],
        'gui' => [
            'default' => 'list'
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