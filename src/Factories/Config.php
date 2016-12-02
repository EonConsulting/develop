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
                    'requires' => [
                        'client_id',
                        'redirect_uri'
                    ],
                    'client_id' => '634727d7b2b5c8016791',
                    'secret' => '19070a7bbbbb63d56ee4986028081b740df34d99',
                    'requires_auth' => 'true',
                    'redirect_uri' => 'https://github.com/login/oauth/authorize',
                    'redirect_uri_skeleton' => 'https://github.com/login/oauth/authorize?client_id=--client_id--&redirect_uri=--redirect_uri--',
                    'access_token_uri' => 'https://github.com/login/oauth/access_token',
                ],
                'cs50' => [
                    'requires' => [
                        'user_key',
                        'output'
                    ],
                    'user_key' => '1f97bb666fcc136196d1dc406679ee0f',
                    'client_id' => '1f97bb666fcc136196d1dc406679ee0f',
                    'secret' => '',
                    'requires_auth' => 'false',
                    'redirect_uri' => '',
                    'redirect_uri_skeleton' => '',
                    'access_token_uri' => '',
                    'output' => 'json',
                    'api_uses' => [
                        'courses' => [
                            'courses',
                            'faculty',
                            'field',
                        ],
                        'food' => [
                            'recipes',
                            'menus',
                            'facts'
                        ],
                        'maps' => [
                            'buildings'
                        ]
                    ],
                    'api_links' => [
                        'courses' => 'https://api.cs50.net/courses/3/courses?key=--user_key--&cat_num=4949&output=--output--',
                        'faculty' => 'https://api.cs50.net/courses/3/faculty?key=--user_key--&output=--output--',
                        'field' => 'https://api.cs50.net/courses/3/field?key=--user_key--&output=--output--',
                        'recipes' => 'https://api.cs50.net/food/3/recipes?key=--user_key--&output=--output--',
                        'menus' => 'https://api.cs50.net/food/3/menus?key=--user_key--&output=--output--',
                        'facts' => [
                            'uri' => 'https://api.cs50.net/food/3/facts?key=--user_key--&recipe=--recipe--&output=--output--',
                            'required' => [
                                'user_key',
                                'recipe',
                                'output'
                            ]
                        ],
                        'buildings' => 'https://api.cs50.net/maps/2/buildings?key=--user_key--&output=--output--',
                    ]
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

    /**
     * @param $key
     * @return array|mixed
     */
    public function generate_redirect_uri($key) {
        $key = 'oauth.allows.' . $key;
        $redirect_uri = $this->get($key . '.redirect_uri_skeleton');

        $temp_keys = $key . '.requires';

        $data = $this->get($temp_keys);

        if(gettype($data) == 'array') {
            foreach($data as $k => $v) {
                if(gettype($this->get($key . '.' . $v)) == 'string') {
                    $temp = '';
                    if($v == 'redirect_uri') {
                        $temp = $this->get('oauth.return_uri');
                    } else {
                        $temp = $this->get($key . '.' . $v);
                    }
                    $redirect_uri = str_replace('--' . $v . '--', $temp, $redirect_uri);
                }
            }
        }

        return $redirect_uri;
    }

    /**
     * @param $key
     * @return array|mixed
     */
    public function get_api_uses($key) {
        $uses_keys = 'oauth.allows.' . $key . '.api_uses';
        return $this->get($uses_keys);
    }

    /**
     * @param $key
     * @return array|mixed
     */
    public function needs_auth($key) {
        $keys = 'oauth.allows.' . $key . '.requires_auth';
        return $this->get($keys);
    }

}