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
                        'faculty' => '_faculties',
                        'buildings' => '_building'
                    ]
                ],
                'open_collections' => [
                    'requires' => [],
                    'api_key' => '8e54c2be10e40bb25e3b0f48bd7899e7cf33b450a4dccdcd10a8f73235f5e905',
                    'client_id' => '8e54c2be10e40bb25e3b0f48bd7899e7cf33b450a4dccdcd10a8f73235f5e905',
                    'base_url' => 'https://oc-index.library.ubc.ca',
                    'api_uses' => [
                        'collections' => [
                            '46343' => ['id' => '46343', 'label' => 'Adam Jones Global Photo Archive', 'use' => 'id'],
                            'artefacts' => ['id' => 'artefacts', 'label' => 'Ancient Artefacts', 'use' => 'id'],
                            'bcbooks' => ['id' => 'bcbooks', 'label' => 'BC Historical Books', 'use' => 'id'],
                            'berkpost' => ['id' => 'berkpost', 'label' => 'Berkeley 1968-1973 Poster Collection', 'use' => 'id'],
                            '26856' => ['id' => '26856', 'label' => 'CWGS Lecture Series: Podcasts and Notes', 'use' => 'id'],
                            '23514' => ['id' => '23514', 'label' => 'CWGS Students', 'use' => 'id'],
                            'darwin' => ['id' => 'darwin', 'label' => 'Charles Darwin Letters', 'use' => 'id'],
                            '59404' => ['id' => '59404', 'label' => 'Congress of the Humanities and Social Sciences (77th : 2008)', 'use' => 'id'],
                            '46624' => ['id' => '46624', 'label' => 'Consortium for Nursing History Inquiry', 'use' => 'id'],
                            'cg' => ['id' => 'cg', 'label' => 'Creative Giving', 'use' => 'id'],
                            '52383' => ['id' => '52383', 'label' => 'Faculty Research and Publications', 'use' => 'id'],
                            'florence' => ['id' => 'florence', 'label' => 'Florence Nightingale Letters', 'use' => 'id'],
                        ]
                    ],
                    'api_links' => [
                        '46343' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/46343',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/46343/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/46343/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/46343/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'artefacts' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/artefacts',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/artefacts/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/artefacts/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/artefacts/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'bcbooks' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/bcbooks',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/bcbooks/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/bcbooks/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/bcbooks/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'berkpost' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/berkpost',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/berkpost/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/berkpost/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/berkpost/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        '26856' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/26856',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/26856/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/26856/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/26856/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        '23514' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/23514',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/23514/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/23514/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/23514/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'darwin' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/darwin',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/darwin/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/darwin/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/darwin/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        '59404' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/59404',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/59404/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/59404/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/59404/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        '46624' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/46624',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/46624/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/46624/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/46624/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'cg' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/cg',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/cg/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/cg/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/cg/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        '52383' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/52383',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/52383/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/52383/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/52383/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ],
                        'florence' => [
                            'collection_metadata' => [
                                'uri' => '--base_url--/collections/florence',
                                'label' => 'Collection Metadata',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items' => [
                                'uri' => '--base_url--/collections/florence/items',
                                'label' => 'Items',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                            'items_metadata' => [
                                'uri' => '--base_url--/collections/florence/items/--item_id--',
                                'label' => 'Item Metadata',
                                'requires' => [
                                    'base_url',
                                    'item_id'
                                ]
                            ],
                            'total' => [
                                'uri' => '--base_url--/collections/florence/_total',
                                'label' => 'Total Results Count',
                                'requires' => [
                                    'base_url'
                                ]
                            ],
                        ]
                    ],
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
            if (is_array($data) && array_key_exists($key, $data)) {
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
        try {
            $data = $this->get($temp_keys);
        } catch(\Exception $exception) {
            $data = $requires;
        }

        if(gettype($data) == 'array') {
            foreach($data as $k => $v) {

                if(gettype($v) == 'string' && gettype($this->get($key . '.' . $v)) == 'string') {
                    $temp = '';
                    if($v == 'redirect_uri') {
                        $temp = $this->get('oauth.return_uri');
                    } else {
                        $temp = $this->get($key . '.' . $v);
                    }

                    $uri = str_replace('--' . $v . '--', $temp, $uri);
                } else {

                    if(is_array($v)) {
//                        $uri = $this->generate_uri($key, $v['uri'], $v['requires']);
                    } else {

                        $temp = '';
                        if ($v == 'redirect_uri') {
                            $temp = $this->get('oauth.return_uri');
                        } else {
                            $keys = explode('.', $key);
                            $my_key = $keys[0] . '.' . $keys[1] . '.' . $keys[2];
                            $temp = $this->get($my_key);
                            $temp = $this->multi_in_array($v, $temp);
                        }

                        $uri = str_replace('--' . $v . '--', $temp, $uri);
                    }
                }
            }
        }

        return $uri;
    }

    function generate_uri_label($key, $label, $requires = false) {
        if(gettype($label) == 'array' && array_key_exists('label', $label))
            $label = $label['label'];

        $key = 'oauth.allows.' . $key;
        $temp_keys = ($requires) ? $requires : $key . '.requires';
        try {
            $data = $this->get($temp_keys);
        } catch(\Exception $exception) {
            $data = $requires;
        }

        if(gettype($data) == 'array') {
            foreach($data as $k => $v) {

                if(gettype($v) == 'string' && gettype($this->get($key . '.' . $v)) == 'string') {
                    $temp = '';

                    $temp = $this->get($key . '.' . $v);

                    $label = str_replace('--' . $v . '--', $temp, $label);
                } else {
                    $temp = '';
                    if($v == 'redirect_uri') {
                        $temp = $this->get('oauth.return_uri');
                    } else {
                        $keys = explode('.', $key);
                        $my_key = $keys[0] . '.' . $keys[1] . '.' . $keys[2];
                        $temp = $this->get($my_key);
                        $temp = $this->multi_in_array($v, $temp);
                    }

                    $label = str_replace('--' . $v . '--', $temp, $label);
                }
            }
        }

        return $label;
    }

    function multi_in_array($needle, $haystack) {
        $return = '';
        foreach($haystack as $k => $v) {
            if($needle == $k) {
                $return = $v;
                break;
            }
        }
        return $return;
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
//        dd($data);
        $data = $this->fill_out_data($key, $data);
        echo 'generate_api_uses';
        dd($data);

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

    /**
     * @param $uses
     * @param $data
     * @return array
     */
    private function restrict_uses($uses, $data) {
        $temp_data = [];
        for($i = 0; $i < count($uses); $i++) {
            $use = $uses[$i];

            if(in_array($use, $data)) {
                $temp_data[] = $use;
            } else {
                for($j = 0; $j < count($data); $j++) {
                    if(array_key_exists('value', $data[$j]) && $data[$j]['value'] == $use) {
                        $temp_data[] = $use;
                        break;
                    }
                }
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
                $label = false;
                if(array_key_exists('label', $v) && array_key_exists('use', $v)) {
                    $label = $v['label'];
                    $use = $v['use'];
                    $value = $v[$use];

                    $temp_data[] = $value;
                } else {
                    $temp_data = array_merge($temp_data, $this->get_uses($k, $v));
                }
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
        $base_key_uses = 'oauth.allows.' . $key . '.api_uses.';
        $for_return = [];
        $labels = [];
        $temp_key = '';
        if(array_key_exists(0, $data)) {
            for ($i = 0; $i < count($data); $i++) {
                $k = $data[$i];

                $return_data = $this->get($base_key . $k);
                $temp_key = $k;
                $label = '';

                if (is_array($return_data)) {

                    if (!array_key_exists((string)$temp_key, $for_return)) {
                        $for_return[(string)$temp_key] = '';
                    }

                    $keys = $this->get($base_key_uses . $k);

                    if($keys) {
                        foreach($keys as $t_k => $t_v) {
                            foreach($t_v as $endpoint => $endpoint_data) {
                                if (is_array($endpoint_data) && array_key_exists('label', $endpoint_data)) {
                                    $label = $endpoint_data['label'];

                                    if (!array_key_exists((string)$endpoint, $labels))
                                        $labels[(string)$endpoint] = '';

                                    $labels[(string)$endpoint] = $label;
                                    $for_return[(string)$endpoint]['label'] = $label;
                                } else if(is_array($endpoint_data)) {
                                    $label = $endpoint;

                                    if (!array_key_exists((string)$endpoint, $labels))
                                        $labels[(string)$endpoint] = '';

                                    $labels[(string)$endpoint] = $label;
                                    $for_return[(string)$endpoint]['label'] = $label;
                                } else if(gettype($endpoint_data) == 'string') {
                                    $label = $endpoint_data;

                                    if (!array_key_exists((string)$label, $labels))
                                        $labels[(string)$label] = '';

                                    $labels[(string)$label] = $label;
                                    $for_return[(string)$label]['label'] = $label;
                                } else if(gettype($label) == 'string') {
                                    $label = $endpoint_data;

                                    $labels[(string)$endpoint_data] = $label;
                                    $for_return[(string)$endpoint_data]['label'] = $label;
                                }
                            }
                        }
                    }

                    if(is_array($return_data)) {
                        foreach($return_data as $rdk => $rdv) {

                            if(!array_key_exists('links', $for_return[(string)$k])) {
                                $for_return[(string)$k]['links'] = [];
                            }

                            if(!array_key_exists($rdk, $for_return[(string)$k]['links'])) {
                                $for_return[(string)$k]['links'][$rdk] = [];
                            }

                            $for_return[(string)$k]['links'][$rdk]['label'] = $labels[$k];

                            $gen_uri = false;
                            $gen_uri_label = false;
                            if(gettype($rdv) == 'string') {
                                $gen_uri = $this->generate_uri($key . '.api_links.' . $k , $rdv);
                                $gen_uri_label = $this->generate_uri_label($key . '.api_links.' . $k, $rdv);
                            } else if(array_key_exists('requires', $rdv)) {
                                $gen_uri = $this->generate_uri($key . '.api_links.' . $k . '.' . $rdk, $rdv, $rdv['requires']);;
                                $gen_uri_label = $this->generate_uri_label($key . '.api_links.' . $k . '.' . $rdk, $rdv, $rdv['requires']);
                            }

                            $for_return[(string)$k]['links'][$rdk]['uri'] = $gen_uri;
                            $for_return[(string)$k]['links'][$rdk]['label'] = $gen_uri_label;
                        }
                    }

                } else if (gettype($return_data) == 'string') {

                    $temp = $this->get($base_key);
                    $gen_uri = $this->generate_uri($key . '.api_links.' . $k, $return_data, $temp);
                    $gen_uri_label = $this->generate_uri_label($key . '.api_links.' . $k, $return_data);

                    $for_return[(string)$k]['label'] = $k;
                    $for_return[(string)$k]['links'][$k]['uri'] = $gen_uri;
                    $for_return[(string)$k]['links'][$k]['label'] = $gen_uri_label;
                }
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

}