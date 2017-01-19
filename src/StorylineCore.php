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

    public function getMenu() {
        $taxonomy = new XMLTaxonomy;
        $taxonomy->load_files();
    }

}