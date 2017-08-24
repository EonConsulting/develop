<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 10:53 AM
 */

namespace EONConsulting\Storyline\Core\Flow;


use EONConsulting\Storyline\Core\XML\Interpreter\XMLInterpreter;

class XMLTaxonomy {

    protected $files;
    protected $trees;

    /**
     * XMLTaxonomy constructor.
     */
    public function __construct() {
        $this->files = [];
        $this->trees = [];

        $this->load_files();
        $this->build_hierarchy();
        $this->filter_tree($this->trees, true);
    }


    public function load_files() {
        //?? Inteprator
        $interperator = new XMLInterpreter;
        foreach(glob(public_path('/vendor/storyline/core/xml').'/*.xml') as $file) {
            $interperator->load_file($file);
            $xml = $interperator->read();

            $xml = json_decode(json_encode($xml), TRUE);

            if(array_key_exists('@attributes', $xml))
                $this->files[$xml['@attributes']['config']] = $xml;
        }
    }

    public function build_hierarchy() {
        $files = $this->files;

        $this->trees = [];
        foreach($files as $config => $file) {
            $tree = false;

            $key = '';
            if(array_key_exists('@attributes', $file)) {
                $temp = [];
                foreach($file['@attributes'] as $attribute_key => $attribute_value) {
                    $temp[$attribute_key] = $attribute_value;
                    if($attribute_key == 'config')
                        $key = $attribute_value;
                }

                $this->trees[$key] = $temp;
            }

            if(array_key_exists('storyline_collection', $file) && array_key_exists('storyline', $file['storyline_collection']))
                $tree = $this->build_tree($file['storyline_collection']['storyline']);

            if($tree) {
                $this->trees[$key]['children'] = $tree;
            }
        }
    }

    public function build_tree(&$tree = []) {
        $return_data = [];

        foreach($tree as $branch => $twig) {
            $temp = [];
            if(array_key_exists('@attributes', $twig)) {
                foreach($twig['@attributes'] as $attribute_key => $attribute_value) {
                    $temp[$attribute_key] = $attribute_value;
                }
            }
            $return_data[$branch] = $temp;
        }

        return $return_data;
    }

    public function get($config) {
        return array_key_exists($config, $this->trees) ? $this->trees[$config] : false;
    }

    public function getStoryline($config, $link) {

        if(array_key_exists($config, $this->trees) && array_key_exists('children', $this->trees[$config])) {
            $stories = $this->trees[$config]['children'];
            for($i = 0; $i < count($stories); $i++) {
                $story = $stories[$i];

                if(array('link', $story) && $story['link'] == $link)
                    return $story;
            }
        }

        return false;
    }

    public function file_count() {
        return count($this->files);
    }

    public function index() {
        return $this->trees;
    }

    public function filter_tree(&$tree = [], $is_root = false) {
        foreach($tree as &$branch) {
            if(is_array($branch)) {
                if (array_key_exists('children', $branch) && count($branch['children']) > 0) {
                    $this->filter_tree($branch);
                }

                if (!$is_root) {
                    for($i = 0 ; $i < count($branch); $i++) {
                        if (array_key_exists('config', $branch[$i]) && array_key_exists($branch[$i]['config'], $this->trees)) {
                            if (array_key_exists('children', $this->trees[$branch[$i]['config']])) {
                                $branch[$i]['children'] = $this->trees[$branch[$i]['config']]['children'];
                            }
                            unset($this->trees[$branch[$i]['config']]);
                        }
                    }
                }
            }
        }
    }

    public function getMenu($config = false, $trees = []) {
        $menu = [];

        if(count($trees) == 0)
            $trees = ($config) ? $this->trees[$config] : $this->trees;

        foreach($trees as $tree) {
            try {
                $link = (array_key_exists('link', $tree)) ? $tree['link'] : $tree['id'];
                $menu[] = [
                    'config' => (array_key_exists('config', $tree)) ? $tree['config'] : $link,
                    'title' => $tree['title'],
                    'children' => (array_key_exists('children', $tree)) ? $this->getMenu(false, $tree['children']) : []
                ];
            } catch (\Exception $e) {
                dd($tree);
            }

        }

        return $menu;
    }

    public function getPreviousPage($config, $page = false) {

        $tree = $this->get_in_previous_array($this->trees[$config], $page, 'link');

        $return_data = [
            'title' => $tree['title'],
            'link' => $tree['link'],
            'parent_config' => $config,
            'current' => $page
        ];

        return $return_data;
    }

    public function getNextPage($config, $page = false) {

        $tree = $this->get_in_next_array($this->trees[$config], $page, 'link');

        $return_data = [
            'title' => $tree['title'],
            'link' => $tree['link'],
            'parent_config' => $config,
            'current' => $page
        ];

        return $return_data;
    }

    private function get_in_previous_array($data, $needle, $key, $previous = false) {
        $d = false;

        if(is_array($data)) {

            $d = (array_key_exists('type', $data) && $data['type'] != 'branch' && array_key_exists($key, $data) && $data[$key] == $needle) ? $data : false;
            if($d)
                return (!$previous) ? $d : $previous;

            if (array_key_exists('children', $data) && count($data['children']) > 0) {
                foreach ($data['children'] as $item) {
                    if (!$previous)
                        $previous = $item;

                    $d = $this->get_in_previous_array($item, $needle, $key, $previous);

                    if ($d) {
                        return $d;
                    }

                    $previous = $item;
                }
            }
        }

        return $d;
    }

    private function get_in_next_array($data, $needle, $key, $found = false) {
        $d = false;

        if(is_array($data)) {
            if($found)
                return $data;

            $d = (array_key_exists('type', $data) && $data['type'] != 'branch' && array_key_exists($key, $data) && $data[$key] == $needle) ? $data : false;
            if($d) {
                return $data;
            }

            if (array_key_exists('children', $data) && count($data['children']) > 0) {
                foreach ($data['children'] as $item) {
                    if($found)
                        return $item;

                    $found = $this->get_in_next_array($item, $needle, $key, $found);
                }
            }
        }

        return $d;
    }

}
