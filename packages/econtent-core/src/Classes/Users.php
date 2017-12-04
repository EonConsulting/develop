<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for users
 */

namespace EONConsulting\Core\Classes;

use App\Models\User;

class Users {

    public function __construct() {
        
    }
    
    /* ============================= PUBLIC METHODS ========================= */
    /**
     * This method gets the user from their email address
     *
     * @author  Michael Hanekom <michael@vertopia.co.za>
     *
     * @param string $email the email address of the user to find
     * @return object
     */
    public function GetUserFromEmailAddy($email) {
        $user = Storyline::where("email", $email)->first();
        
        return $user;
    }
}
