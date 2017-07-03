<?php

namespace App\Http\Controllers\LTI\Dashboards;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class DashboardLTIController extends LTIBaseController {

    protected $hasLTI = true;

    public function index() {

        if(laravel_lti()->is_learner(auth()->user())) {
            // run user related queries
            // get latest test scores
            // get upcoming deliverables
            return view('lti.dashboards.student');
        }

        if(laravel_lti()->is_instructor(auth()->user())) {
            // get test progress from student
            // get x
            return view('lti.dashboards.lecturer');
        }

//        $user = auth()->user();
//        if(!$user) {
//            // user not found
//        }
//
//        $lti = $user->lti;
//        if(count($lti) == 0) {
//            // no lti links found
//        }
//
//        $lti = $lti[0];
//        $role = $lti->roles;
//
//        switch($role) {
//            case 'Learner':
//                return view('lti.dashboards.student');
//                break;
//            case 'Instructor':
//                return view('lti.dashboards.lecturer');
//                break;
//        }

    }

}
