<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 8:50 AM
 */

namespace EONConsulting\MindMap;
use EONConsulting\MindMap\Http\Controllers\TestStencilController;


/**
 * Class MindMap
 * @package EONConsulting\MindMap
 */
class MindMap {

    /**
     * @return mixed
     */
  
    public function getNowMindMap() {
        return MindLogic::init_view();
    }

}
