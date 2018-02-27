<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for storylines
 */

namespace EONConsulting\Core\Classes;

use EONConsulting\Storyline2\Models as SIM;

class StorylineItems {

    public function __construct() {
        
    }
    
    /* ============================= PUBLIC METHODS ========================= */
    /**
     * This method gets the content for the storyline_item_id
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param string $storyline_item_id storyline_item_id for which you want to get content
     * @return array
     */
    function GetStorylineItemContent($storyline_item_id) {
        $body = '';
        
        $content = SIM\StorylineItem::find($storyline_item_id)
                ->content;
        if (count($content) > 0)
        {
            $body = $content->body;
        }
        
        return $body;
    }
}