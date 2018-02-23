<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for storylines
 */

namespace EONConsulting\Core\Classes;

use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;

class Storylines {

    public function __construct() {
        
    }
    
    /* ============================= PUBLIC METHODS ========================= */
    /**
     * This method gets a baum storyline from the DB
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param string $storyline_id storyline_id for which you want to get items
     * @return array
     */
    function GetStorylineItems($storyline_id) {
        $storyline = Storyline::find($storyline_id);
        $items = $storyline['items'];
        
        return $items;
        //$result = $this->createTree($result);
        //$result = $result[0]['children'];
    }
    
    /**
     * This method takes storyline items in a baum array and creates a custom tree
     * 
     * @author  Michael Hanekom <michael@vertopia.co.za>
     * 
     * @param $items storyline items from a baum array
     * @return array
     */
    function TransformStorylineItemsToFlatArray($items, $sort = true) {

        $map = [];

        foreach ($items as $k => $node) {

            $map[] = [
                'id' => (string) $node['id'],
                'text' => $node['name'],
                'parent_id' => ($node['parent_id'] === null) ? "#" : $node['parent_id'],
                'rgt' => $node['_rgt'],
                'lft' => $node['_lft'],
                'content_id' => $node['content_id']
            ];
        }

        return ($sort) ? $this->SortTransformedTree($map) : $map;
    }
    
    /**
     * This method strips only the storyline_item_id's out of the sorted arra as an array
     * 
     * @author  Michael Hanekom <michael@vertopia.co.za>
     * 
     * @param $items storyline items from a baum array
     * @return array
     */
    function GetStorylineItemIdsFromFlatArray($items)
    {
        $map = [];

        foreach ($items as $k => $node) {

            $map[] = [
                'id' => (string) $node['id']
            ];
        }

        return $map;
    }
    
    /* ===================== PROTECTED FUNCTIONS ============================= */
    /**
     * This method wraps the sorting of storyline items by their lft and rgt
     * 
     * @author Michael Hanekom <michael@vertopia.co.za>
     * 
     * @param $tree tree items created by using TransformStorylineItemsToTree
     * @return array
     */
    protected function SortTransformedTree($tree)
    {
        usort($tree, [$this, "self::compare"]);
        return $tree;
    }
    
    /**
     * This method sorts the output of TransformStorylineItemsToTree
     * 
     * @param $a
     * @param $b
     * @return int
     */
    protected function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

}
