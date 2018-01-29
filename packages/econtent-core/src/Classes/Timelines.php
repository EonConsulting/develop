<?php

/* Author: Michael Hanekom
 * Date: 2018-01-29
 * Class to centralize all processing for timelines
 */

namespace EONConsulting\Core\Classes;

use Illuminate\Support\Facades\DB;
use App\Models\TimelineEvent;

class Timelines {

    public function __construct() {
        
    }

    /**
     * Filter the timeline events
     *
     * @return array of timeline rows
     */
    public function findByFilters($start, $end, $course_id, $user_id, $role)
    {
        // this is a collection of personal and global events
        $events = DB::select('SELECT te.*
                    FROM timeline_events te
                    INNER JOIN courses c ON c.id = te.course_id
                    WHERE c.id = :u_course_id
                    AND te.user_id = :u_user_id
                    AND te.is_global = 0
                    AND te.start between :u_start AND :u_end
                    UNION
                    SELECT te.*
                    FROM timeline_events te
                    INNER JOIN courses c ON c.id = te.course_id
                    WHERE c.id = :g_course_id
                    AND te.is_global = 1
                    AND te.start between :g_start AND :g_end', [
                        "u_course_id" => $course_id, 
                        "u_user_id" => $user_id,
                        "u_start" => $start,
                        "u_end" => $end,
                        "g_course_id" => $course_id, 
                        "g_start" => $start,
                        "g_end" => $end
                ]);
        
        return $events; 
    }

}