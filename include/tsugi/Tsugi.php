<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2016/12/18
 * Time: 11:08 PM
 */

namespace Tsugi;


use Illuminate\Http\Request;
use Tsugi\Core\LTIX;

class Tsugi extends LTIX {

    public static function laravelSetup(Request $request, $needed=LTIX::ALL) {
        $launch = self::requireDataOverride(LTIX::ALL,
            null, /* pdox - default */
            $request->session(),
            null, /* current_url - default */
            null /* request_data - default */
        );
        return $launch;
    }

}