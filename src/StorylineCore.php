<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline\Core;

use EONConsulting\Storyline\Core\Flow\XMLTaxonomy;

class StorylineCore {

    public function getIndex() {
        $taxonomy = new XMLTaxonomy;
        return $taxonomy->index();
    }

    public function getMenu($config = false) {
        $taxonomy = new XMLTaxonomy;
        return $taxonomy->getMenu($config);
    }

    public function getPrevious($config = false, $page = false) {
        $taxonomy = new XMLTaxonomy;

        if($config || $config && $page) {
            return $taxonomy->getPreviousPage($config, $page);
        }
    }

    public function getNext($config = false, $page = false) {
        $taxonomy = new XMLTaxonomy;

        if($config || $config && $page) {
            return $taxonomy->getNextPage($config, $page);
        }
    }

}