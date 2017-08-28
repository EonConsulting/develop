<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 4/20/2017
 * Time: 2:14 AM
 */

namespace EONConsulting\Storyline\Breadcrumbs\Classes;

class ParentKeysIterator extends \RecursiveIteratorIterator {

    public function __construct(array $array)
    {
        parent::__construct(new \RecursiveArrayIterator($array));
    }

    public function current() {
        return parent::key();
    }

    public function key() {
        return $this->getParentKeys();
    }

    public function getParentKeys() {
        $keys = [];
        for($depth = $this->getDepth() - 1; $depth; $depth--) {
            array_unshift($keys, $this->getSubIterator($depth)->key());
        }
        return $keys;

    }

}