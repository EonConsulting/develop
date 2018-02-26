<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for assets
 */

namespace EONConsulting\Core\Classes;

use EONConsulting\ContentBuilder\Models as CB;

class Content {

    public function __construct() {
        
    }
    
    public function GetContentBody($content_id){
        $content = CB\Content::find($content_id);
        
        return (count($content) > 0) ? $content['body'] : [];
    }
}
