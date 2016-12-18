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
                        'facts' => [
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
                    'requires' => [
                        'base_url'
                    ],
                    'api_key' => '8e54c2be10e40bb25e3b0f48bd7899e7cf33b450a4dccdcd10a8f73235f5e905',
                    'client_id' => '8e54c2be10e40bb25e3b0f48bd7899e7cf33b450a4dccdcd10a8f73235f5e905',
                    'base_url' => 'https://oc-index.library.ubc.ca',
                    'api_uses' => [
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
                    ],
                    'api_links' => [
//                        'collections' => [
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
                                'total123' => [
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
//                            ]
                        ],
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
            if (is_array($data) && array_key_exists($key, $data)) {
                $data = $data[$key];
                continue;
            }
        }

        return $data;
    }

    public function put($original_keys, $data, $data_to_add) {
        $keys = explode('.', $original_keys);
        $loop_count = 0;

        foreach ($keys as $key) {
            $loop_count++;
            if (is_array($data) && array_key_exists($key, $data)) {
                if((count($data[$key]) == 0 || !is_array($data[$key]))) {
                    $data[$key] = $data_to_add;

                } else {
                    $data[$key] = $this->put($original_keys, $data[$key], $data_to_add);
                }
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

        if(!is_array($data)) {
            $keys = explode('.', $key);
            $temp_key = $keys[0] . '.' . $keys[1] . '.' . $keys[2];
            $temp_keys = $temp_key . '.requires';
            $data = $this->get($temp_keys);
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

    function generate_uri_label($key, $label, $requires = false, $fallback = false) {
        if(gettype($label) == 'array') {
            if(array_key_exists('label', $label)) {
                $label = $label['label'];
            } else {
                return $fallback;
            }
        }

        $key = 'oauth.allows.' . $key;
        $temp_keys = ($requires) ? $requires : $key . '.requires';
        try {
            $data = $this->get($temp_keys);
        } catch (\Exception $exception) {
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
        $uses_keys = 'oauth.allows.' . $key . '.api_uses';
        $link_keys = 'oauth.allows.' . $key . '.api_links';

//        $data = $this->get($link_keys);
//        $data = $this->obj_array_recursive($key, $data, $link_keys, $uses_keys);
        $data = $this->get($link_keys);
        $data = $this->fill_data($link_keys, $data, $key);
        $data = $this->insert_main_labels($uses_keys, $data);

        return $data;
    }

    function fill_data($keys, $data, $original_key) {
        $result = [];

        foreach($data as $k => $v) {

            // check for string
            $uri = '';
            $label = $k;
            if(gettype($v) == 'string') {
                // if string, generate uri
                $uri = $this->generate_uri($original_key, $v);

                $result[$k]['uri'] = $uri;
                $result[$k]['label'] = $label;
            }

            // check for array
            if(is_array($v)) {
                if(array_key_exists('uri', $v) || array_key_exists('label', $v) || array_key_exists('requires', $v)) {
                    // check for uri
                    if(array_key_exists('uri', $v)) {
                        // check for requires
                        // generate uri
                        if(array_key_exists('requires', $v)) {
                            $uri = $this->generate_uri($original_key, $v['uri'], $v['requires']);
                        } else {
                            $uri = $this->generate_uri($original_key, $v['uri']);
                        }
                    }

                    // check for label
                    if(array_key_exists('label', $v)) {
                        // generate label
                        $label = $this->generate_uri_label($original_key, $v['label']);
                    }

                    $result[$k]['uri'] = $uri;
                    $result[$k]['label'] = $label;
                } else {
                    $result[$k] = $this->fill_data($keys, $v, $original_key);
                }
            }
        }

        return $result;
    }

    function insert_main_labels($keys, $data) {
        $result = $data;

        foreach($data as $k => $v) {
            $new_keys = $keys . '.' . $k;
            $obj = $this->get($new_keys);
            if(is_array($obj)) {
                if(array_key_exists('label', $obj)) {
                    $label = $obj['label'];
                    if(!array_key_exists('label', $result[$k]))
                        $result[$k]['label'] = '';

                    $result[$k]['label'] = $label;
                }
            }
        }

        return $result;
    }

    /**
     * @param $key
     * @return array
     */
    public function generate_api_use($key, $use) {

        $data = [];

        for($i = 0; $i < count($use); $i++) {
            $u = $use[$i];

            $temp_data = [];

            $last_key = explode('.', $u);
            $last_key = $last_key[count($last_key) -1];

            $uses = 'oauth.allows.' . $key . '.api_links.' . $u;

            $return_data = $this->get($uses);

            $temp_data['uri'] = (is_array($return_data) && array_key_exists('requires', $return_data)) ? $this->generate_uri($key, $return_data, $return_data['requires']) : $this->generate_uri($key, $return_data);
            $temp_data['label'] = (is_array($return_data)) ? $this->generate_uri_label($key, $return_data, false, $last_key) : $last_key;
            $temp_data['slug'] = $u;

            $data[$u] = $temp_data;
        }

        return $data;
    }

    function list_array_recursive($someArray) {
        $result = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($someArray), \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $k => $v) {
            if (!$iterator->hasChildren()) {
                for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                    $p[] = $iterator->getSubIterator($i)->key();
                }
                $path = implode('/', $p);
                if (preg_match('/\-\-(.*?)\-\-/', $v)) {
                    $result[$path] = $v;
                }
            }
        }
        return $result;
    }

    function build_recursive_tree($someArray) {
        $result = [];

        foreach($someArray as $key => $value) {
            $exploded = explode('.', $key);
            $nested = $this->create_nesting($exploded);
            $nested = $this->put($key, $nested, $value);
            $result[] = $nested;
        }

        return $result;
    }

    function obj_array_recursive($key, $someArray, $link_keys, $uses_keys) {
        $result = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($someArray), \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $k => $v) {
            if (!$iterator->hasChildren()) {
                for ($p = array(), $i = 0, $z = $iterator->getDepth(); $i <= $z; $i++) {
                    $p[] = $iterator->getSubIterator($i)->key();
                }

                if(count($p) > 1)
                    unset($p[count($p) -1]);

                $path_obj = implode('.', $p);

                $obj = $this->get($link_keys . '.' . $path_obj);
                $use_obj = $this->get($uses_keys . '.' . $path_obj);

                if(gettype($obj) == 'string') {
                    $uri = $this->generate_uri($key, $obj);
                    $result[$path_obj]['uri'] = $uri;
                    $label = $k;
                    $result[$path_obj]['label'] = $label;
                } else {
                    if(array_key_exists('uri', $obj)) {
                        $uri = $this->generate_uri($key, $obj['uri']);
                        $result[$path_obj]['uri'] = $uri;
                    }
                    if(array_key_exists('label', $obj)) {
                        $label = $this->generate_uri_label($key, $obj['label']);
                        $result[$path_obj]['label'] = $label;
                    }
                }

                if(is_array($use_obj)) {
                    if(array_key_exists('use', $use_obj)) {
                        $value = $use_obj[$use_obj['use']];
                        $result[$path_obj]['value'] = $value;
                    }
                }
            }
        }
        return $result;
    }

    public function create_nesting($array) {
        $x = count($array) - 1;
        $temp = array();
        for($i = $x; $i >= 0; $i--)  {
            $temp = array($array[$i] => $temp);
        }
        return $temp;
    }

    public function build_tree($keys, $tree, $link_keys = '', $main_key = false) {

        $keys = array_values($keys);
        $temp_keys = $keys;
        $temp_tree = [];
        $previous_key = $keys[0];

        if(count($temp_keys) == 0) {
            if(gettype($tree) == 'string') {
                return [];
            }
        }

        dd($keys);

//        for($i = 0; $i < count($keys); $i++) {
//            $key = $keys[$i];
//            unset($temp_keys[$i]);
//
//            foreach ($tree as $item => $value) {
//                if (is_array($value)) {
//                    // an array
//                    if (in_array($key, $value)) {
//                        $temp_value = $value[array_search($key, $value)];
//                        if(is_array($temp_value)) {
//                            $temp_tree = $this->build_tree($temp_keys, $temp_value, $link_keys . '.' . implode('.', $temp_keys), $main_key);
////                            $temp_tree[$previous_key] = $this->build_tree($temp_keys, $temp_value, $link_keys . '.' . implode('.', $temp_keys), $main_key);
//                        }
//                    } else if(array_key_exists($key, $value)) {
//                        if(array_key_exists('links', $value[$key])) {
//                            $temp_tree = $this->build_tree($temp_keys, $value[$key]['links'], $link_keys . '.' . implode('.', $temp_keys), $main_key);
//                        } else {
//                            $temp_tree = $this->get($link_keys . '.' . implode('.', $temp_keys));
////                            $temp_tree[$key] = $this->get($link_keys . '.' . implode('.', $temp_keys));
//                        }
//                    }
//                } else {
//                    // not an array
//                    if($value == $key) {
//                        $tree_data = $this->get($link_keys);
//                        echo $value . '<br />';
//                        dd($tree_data);
//
//                        if(is_array($tree_data) && array_key_exists('uri', $tree_data)) {
//                            $uri = $tree_data['uri'];
//                        }
//                        if(gettype($tree_data) == 'string') {
//                            $uri = $tree_data;
//                        }
//
//                        $label = '';
//                        if(is_array($tree_data) && array_key_exists('label', $tree_data)) {
//                            $label = $tree_data['label'];
//                        } else if(gettype($tree_data) == 'string') {
//                            $label = $tree_data;
//                        } else {
//                            $label = $key;
//                        }
//
//                        if(is_array($tree_data) && array_key_exists('requires', $tree_data)) {
//                            $requires = $tree_data['requires'];
//                        } else {
//                            $requires = false;
//                        }
//
////                        dd($link_keys . '.' . implode('.', $keys));
//                        $uri = $this->generate_uri($main_key, $uri, $requires);
//                        $label = $this->generate_uri_label($main_key, $label, $requires);
//                        $slug = implode('.', $keys);
//
////                        if(!array_key_exists($key, $temp_tree)) {
////                            $temp_tree[$key] = [];
////                        }
//
//                        $temp_tree['uri'] = $uri;
//                        $temp_tree['label'] = $label;
//                        $temp_tree['slug'] = $slug;
//
////                        $temp_tree[$key]['uri'] = $uri;
////                        $temp_tree[$key]['label'] = $label;
////                        $temp_tree[$key]['slug'] = $slug;
//                    }
//                }
//            }
//            $previous_key = $key;
//        }
        return $temp_tree;
    }

    /**
     * @param $uses
     * @param $data
     * @return array
     */
    private function restrict_uses($uses, $key, $data) {
        $result = [];

        echo $key;
        dd($data);

        return $result;

//        if(!is_array($uses)) {
//            $keys = explode('.', $uses);
//            $last_key = $keys[count($keys) - 1];
//        } else {
//            $last_key = $uses[count($uses) - 1];
//        }
//
//        if(in_array($last_key, $data)) {
//            $result[] = $last_key;
//        }

//        return $result;

//        dd($last_key);

//        $temp_data = [];
//
//        $_uses = implode('.', $uses);
//        $_uses = 'oauth.allows.' . $key . '.api_uses.' . $_uses;
//
//        $_data = $this->get($_uses);
//
//        foreach($data as $k => $v) {
//            for($i = 0; $i < count($uses); $i++) {
//                $use = $uses[$i];
//
//                if(in_array($use, $v)) {
//                    $temp_data[] = $v[array_search($use, $v)];
//                    break;
//                }
//                if(array_key_exists($use, $v)) {
//                    if(is_array($v[$use]) && array_key_exists('links', $v[$use])) {
//                        dd($uses);
//                        dd($v[$use]['links']);
//                        dd($this->restrict_uses($key, $uses, $v[$use]['links']));
//                    }
//                }
//
//            }
//        }
//        return $temp_data;
    }

    public function get_uses($key, $_data, $last_key = '') {
        $result = [];

        dd($key);

        foreach($_data as $k => $v) {
            dd($v);
        }

        return $result;
    }

    /**
     * Walks through array looking for the key returns the path and value when it finds it
     * @param array $array
     * @param string $searchKey
     * @param bool $multiple_results Only return the first result, or return all the results
     * @return bool|array ['path' => 'a.b.c', 'value' => value]
     */
    function recursive_key_search($array, $searchKey = '', $multiple_results = false) {
        if (empty($array)) {
            return false;
        }
        //create a recursive iterator to loop over the array recursively
        $result = [];
        $iter   = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($array),
            \RecursiveIteratorIterator::SELF_FIRST);

        //loop over the iterator
        foreach ($iter as $key => $value) {
            //if the key matches our search
            if ($key === $searchKey) {
                //add the current key
                $keys = array($key);
                //loop up the recursive chain
                for ($i = $iter->getDepth() - 1; $i >= 0; $i--) {
                    //add each parent key
                    array_unshift($keys, $iter->getSubIterator($i)->key());
                }
                //return our output array
                $found_data = array('path' => implode('.', $keys), 'value' => $value);
                if (!$multiple_results) {
                    return $found_data;
                } else {
                    $result[] = $found_data;
                }

            }
        }
        if (empty($result)) {
            //return false if not found
            return false;
        }
        return $result;
    }

    /**
     * Walks through array looking for the key returns the path and value when it finds it
     * @param array $array
     * @param string $searchKey
     * @param bool $multiple_results Only return the first result, or return all the results
     * @return bool|array ['path' => 'a.b.c', 'value' => value]
     */
    function recursive_value_search($array, $searchKey = '', $multiple_results = false) {
        if (empty($array)) {
            return false;
        }
        //create a recursive iterator to loop over the array recursively
        $result = [];
        $iter   = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($array),
            \RecursiveIteratorIterator::SELF_FIRST);

        //loop over the iterator
        foreach ($iter as $key => $value) {
            //if the key matches our search
            if ($key === $searchKey) {
                //add the current key
                $keys = array($key);
                //loop up the recursive chain
                for ($i = $iter->getDepth() - 1; $i >= 0; $i--) {
                    //add each parent key
                    array_unshift($keys, $iter->getSubIterator($i)->key());
                }
                //return our output array
                $found_data = array('path' => implode('.', $keys), 'value' => $value);
                if (!$multiple_results) {
                    return $found_data;
                } else {
                    $result[] = $found_data;
                }

            }
        }
        if (empty($result)) {
            //return false if not found
            return false;
        }
        return $result;
    }

    function get_labels($key, $keys) {
        return $this->get('oauth.allows.' . $key . '.api_uses.' . $keys);
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