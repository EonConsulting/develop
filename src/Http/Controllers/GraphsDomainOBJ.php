<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/6/2017
 * Time: 3:59 PM
 */

namespace EONConsulting\Graphs\Http\Controllers;

use EONConsulting\Graphs\src\Models\GraphModel;

class GraphsDomainOBJ
{
    public function __graphs(GraphModel $graphModel) {
        return $graphModel;
    }

}