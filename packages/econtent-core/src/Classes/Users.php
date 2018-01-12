<?php

/* Author: Michael Hanekom
 * Date: 2017-11-30
 * Class to centralize all processing for users
 */

namespace EONConsulting\Core\Classes;

use Illuminate\Support\Facades\DB;
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
        $user = User::where("email", $email)->first();
        
        return $user;
    }
    
    /**
     * This method gets all the users enrolled for a particular course
     * 
     * @author Michael Hanekom <michael@vertopia.co.za>
     * 
     * @param int $course_id the course_id to find users for
     * @return object
     */
    public function GetUsersForCourse($course_id, $mentor_user_id = null)
    {
        if ($mentor_user_id)
        {
            $users = DB::select('SELECT u.id, u.name
                FROM users u
                INNER JOIN integrate_course_users icu ON icu.user_id = u.id
                INNER JOIN integrate_mentor_users imu ON imu.student_user_id = u.id
                WHERE icu.course_id = :course_id
                AND imu.mentor_user_id = :mentor_user_id', 
                    ["course_id" => $course_id, "mentor_user_id" => $mentor_user_id]);
            
        } else {
            $users = DB::select('SELECT u.id, u.name
                FROM users u
                INNER JOIN integrate_course_users icu ON icu.user_id = u.id
                WHERE icu.course_id = :course_id', 
                    ["course_id" => $course_id]);
        }
     
        return $users;
    }
}
