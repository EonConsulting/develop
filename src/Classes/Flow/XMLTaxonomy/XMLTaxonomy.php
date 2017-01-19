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

    /**
     * XMLTaxonomy constructor.
     */
    public function __construct() {
        $this->files = [];
    }


    public function load_files() {
        $interperator = new XMLInterpreter;
        foreach(glob(public_path('/vendor/storyline/core/xml').'/*.xml') as $file) {

            $interperator->load_file($file);
            $xml = $interperator->read();

            $xml = json_decode(json_encode($xml), TRUE);

            $this->files[$xml['@attributes']['config']] = $xml;
        }

        dd($this->files);
    }

    public function build_hierarchy() {
        $files = $this->files;

        foreach($files as $config => $file) {
            $tree = false;
            if(array_key_exists('storyline_collection', $file) && array_key_exists('storyline', $file['storyline_collection']))
                $tree = $this->build_tree($file['storyline_collection']['storyline']);

            dd($tree);
        }
    }

    public function build_tree(&$tree = []) {
        $return_data = [];


        return $return_data;
    }

    public function getMenu() {

    }

}