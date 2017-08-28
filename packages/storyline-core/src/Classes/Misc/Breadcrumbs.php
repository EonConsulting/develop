<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/30
 * Time: 9:45 AM
 */

namespace EONConsulting\Storyline\Core\Classes;


class Breadcrumbs {

    public function convertToBreadcrumbs($data) {

        $return_data = [];

        foreach($data as $item) {
            if(is_array($item)) {
                try {
                    $config = (array_key_exists('config', $item)) ? $item['config'] : ((array_key_exists('link', $item)) ? $item['link'] : '');
                    print_r($config);
                    $children = [];

                    if($config != '') {
                        if (array_key_exists('children', $item)) {
                            for ($i = 0; $i < count($item['children']); $i++) {
                                $children[] = $this->convertToBreadcrumbs($item['children'][$i]);
                            }
                        }
                    } else {
                        for($i = 0; $i < count($item); $i++) {
                            $temp_item = $item[$i];
                            $config = (array_key_exists('config', $temp_item)) ? $temp_item['config'] : ((array_key_exists('link', $temp_item)) ? $temp_item['link'] : '');
                            if (array_key_exists('children', $temp_item)) {
                                dd($temp_item['children'][$i]);
                                $children[] = $this->convertToBreadcrumbs($temp_item['children'][$i]);
                            }
                        }
                    }

                    $return_data['config'] = $config;
                    $return_data['title'] = $item['title'];
                    $return_data['link'] = $item['link'];
                    $return_data['children'] = $children;

                } catch (\Exception $e) {
//                    dd($item);
                }
            }
        }

        return $return_data;

    }

}