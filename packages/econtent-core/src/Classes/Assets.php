<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for assets
 */

namespace EONConsulting\Core\Classes;

use Illuminate\Support\Facades\DB;
use App\Models\AssetRegister;

class Assets {

    public function __construct() {
        
    }
    
    public function getAssetRegisterForCourse($course_id)
    {
        // should return a bunch of rows with different mime-types
        // and counts
        $ar = AssetRegister::where('course_id', $course_id)
                ->get();
        
        return $ar;
    }
}
