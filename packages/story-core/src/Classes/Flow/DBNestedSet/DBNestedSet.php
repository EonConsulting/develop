<?php

namespace EONConsulting\StoryCore\Classes\Flow\DBNestedSet\DBNestedSet;
use App\Models\Story;
use Dropbox\Exception;

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 4/16/2017
 * Time: 6:27 PM
 */
class DBNestedSet {

    protected $rootnode;

    public function getRootStoryNode() {
        return $this->rootnode;
    }

    public function setRootStoryNode($rootnode) {
        if (!$rootnode) {
            throw new Exception('RootNode has not been defined, exiting with error !!');
        }

        $this->rootnode = $rootnode;
    }

    public function setBuildNestedArray() {

    }

}