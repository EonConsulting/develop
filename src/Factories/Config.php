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
                'facebook' => [
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
                        'courses' => 'http://api.cs50.net/courses/3/courses?key=--user_key--&output=--output--',
                        'faculty' => 'http://api.cs50.net/courses/3/faculty?key=--user_key--&output=--output--',
                        'field' => 'http://api.cs50.net/courses/3/field?key=--user_key--&output=--output--',
                        'recipes' => 'http://api.cs50.net/food/3/recipes?key=--user_key--&output=--output--',
                        'menus' => 'http://api.cs50.net/food/3/menus?key=--user_key--&output=--output--',
                        'facts' => [
                            'uri' => 'http://api.cs50.net/food/3/facts?key=--user_key--&recipe=--recipe--&output=--output--',
                            'requires' => [
                                'user_key',
                                'recipe',
                                'output'
                            ]
                        ],
                        'buildings' => 'http://api.cs50.net/maps/2/buildings?key=--user_key--&output=--output--',
                    ],
                    'templates' => [
                        'courses' => '_courses',
                        'faculty' => '_faculties'
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
     * @param $uri
     * @param bool $requires
     * @return mixed
     */
    function generate_uri($key, $uri, $requires = false) {

        if(gettype($uri) == 'array' && array_key_exists('uri', $uri))
            $uri = $uri['uri'];


        $key = 'oauth.allows.' . $key;
        $temp_keys = ($requires) ? $requires : $key . '.requires';
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
                    $uri = str_replace('--' . $v . '--', $temp, $uri);
                }
            }
        }

        return $uri;
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
     * @return array
     */
    public function generate_api_uses($key) {
        $data = [];
        $uses_keys = 'oauth.allows.' . $key . '.api_uses';
        $uses_data = $this->get($uses_keys);
        $uses_keys = 'oauth.allows.' . $key . '.api_links';
        $orig_data = $this->data;

        $data = $this->get_uses($key, $uses_data);
        $data = $this->fill_out_data($key, $data);

        return $data;
    }

    /**
     * @param $key
     * @return array
     */
    public function generate_api_use($key, $use) {
        $data = [];
        $uses_keys = 'oauth.allows.' . $key . '.api_uses';
        $uses_data = $this->get($uses_keys);

        $uses = (gettype($use) != 'array') ? [$use] : $use;

        $data = $this->get_uses($key, $uses_data);
        $data = $this->restrict_uses($uses, $data);
        $data = $this->fill_out_data($key, $data);

        return $data;
    }

    private function restrict_uses($uses, $data) {

        $temp_data = [];
        for($i = 0; $i < count($uses); $i++) {
            $use = $uses[$i];
            if(in_array($use, $data)) {
                $temp_data[] = $use;
            }
        }

        return $temp_data;
    }

    /**
     * @param $key
     * @param $_data
     * @return array
     */
    private function get_uses($key, $_data) {
        $temp_data = [];

        foreach($_data as $k => $v) {
            if(gettype($v) == 'array') {
                $temp_data = array_merge($temp_data, $this->get_uses($k, $v));
            } else {
                $temp_data[] = $v;
            }
        }

        return $temp_data;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function fill_out_data($key, $data) {
        $base_key = 'oauth.allows.' . $key . '.api_links.';
        $for_return = [];
        for($i = 0; $i < count($data); $i++) {
            $k = $data[$i];

            $return_data = $this->get($base_key . $k);
            if(gettype($return_data) == 'string') {
                if(gettype($data[$i]) != 'array') {
                    $data[$i] = [];
                }
                if(!array_key_exists($k, $data[$i])) {
                    $data[$i][$k] = '';
                }

                if(!array_key_exists($k, $for_return)) {
                    $for_return[$k] = '';
                }
                $for_return[$k] = $this->generate_uri($key, $return_data);
            } else {
                $for_return[$k] = $this->generate_uri($key, $return_data, $base_key . $k . '.requires');
            }
        }

        return $for_return;
    }

    /**
     * @param $key
     * @return array|mixed
     */
    public function needs_auth($key) {
        $keys = 'oauth.allows.' . $key . '.requires_auth';
        return $this->get($keys);
    }

    /**
     * @param $key
     * @param $use
     * @return string
     */
    public function parse_template($key, $use) {
        $html = '';



        return $html;
    }

}