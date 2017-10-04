<?php

namespace App\Http\Controllers\LTI\Dashboards;

use Illuminate\Http\Request;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class DashboardLTIController extends LTIBaseController {

    protected $hasLTI = true;

    public function index() {

        $data = array(
            'page_title' => 'Dashboard', //make this the name if the page
            'parent_title' => 'Instructor', //leave empty if none
        );

        $UserRole = laravel_lti()->get_user_lti_type(auth()->user());

        switch ($UserRole) {
            case "Administrator":
                $breadcrumbs = [
                    'title' => 'Administrator Dashboard'
                ];
                return view('dashboards.admin', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            case "Instructor":
                $breadcrumbs = [
                    'title' => 'Lecturer Dashboard'
                ];

                return view('dashboards.lecturer', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            case "Learner":
                $breadcrumbs = [
                'title' => 'Student Dashboard'
            ];

            return view('dashboards.student', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            
            case "Mentor":
                $breadcrumbs = [
                'title' => 'Mentor Dashboard'
            ];

            return view('dashboards.mentor', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        } 
       
    }

}
