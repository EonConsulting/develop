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
        $xml=simplexml_load_file($this->file) or die("Error: Cannot create object");
        return $xml;
    }

}