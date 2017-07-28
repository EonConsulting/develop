<?php

namespace App\Http\Controllers\LTI\Dashboards;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class DashboardLTIController extends LTIBaseController {

    protected $hasLTI = true;

    public function index() {

        $data = array(
            'page_title' => 'Dashboard', //make this the name if the page
            'parent_title' => 'Instructor', //leave empty if none
        );



        if(laravel_lti()->is_learner(auth()->user())) {

            $breadcrumbs = [
                'title' => 'Student Dashboard'
            ];

            return view('dashboards.student', $data, ['breadcrumbs' => $breadcrumbs]);

        } elseif (laravel_lti()->is_instructor(auth()->user())) {

            $breadcrumbs = [
                'title' => 'Lecturer Dashboard'
            ];

            return view('dashboards.lecturer', $data, ['breadcrumbs' => $breadcrumbs]);

        }

    }

}
