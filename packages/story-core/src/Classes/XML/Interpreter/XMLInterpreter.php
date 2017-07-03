<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 10:50 AM
 */

namespace EONConsulting\Storyline\Core\XML\Interpreter;


class XMLInterpreter {

    protected $file;

    public function load_file($file) {
        $this->file = $file;
    }

    public function read() {
        $feed = file_get_contents($this->file);
        //?? Simple XML Depth Issues Issues ()
        $xml=simplexml_load_string($feed) or die("Error: Cannot create object");
        return $xml;
    }

}