<?php

namespace App\Http\Controllers\LTI\Dashboards;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

class DashboardLTIController extends LTIBaseController
{
    protected $hasLTI = true;

    public function index()
    {
        $data = array(
            'page_title' => 'Dashboard', //make this the name if the page
            'parent_title' => 'Instructor', //leave empty if none
        );

        //$UserRole = "Instructor, Administrator,urn:lti:instrole:ims/lis/Administrator,urn:lti:sysrole:ims/lis/Administrator";
        //$UserRole = "Learner";
        $UserRole = laravel_lti()->get_user_lti_type(auth()->user());

        Log::debug("Attempting an LTI Login....");
        Log::debug($UserRole);
        
        // we want a more vanilla flavoured role, especially when dealing
        // which the MyUNISA roles
        $parsedRole = $this->interpretRole($UserRole);
        
        switch ($parsedRole) {
            case "Administrator":
                $breadcrumbs = [
                    'title' => 'Administrator Dashboard'
                ];
                return view('dashboards.admin', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            case "Instructor":
                $breadcrumbs = [
                    'title' => 'Lecturer - Student Analysis Dashboard'
                ];

                return view('dashboards.lecturer-stud-analysis', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            case "Learner":
                $breadcrumbs = [
                    'title' => 'Student Dashboard'
                ];

                return view('dashboards.student', $data, ['breadcrumbs' => $breadcrumbs]);
                break;

            case "Mentor":
                $breadcrumbs = [
                    'title' => 'Mentor - Student Analysis Dashboard'
                ];

                return view('dashboards.mentor-stud-analysis', $data, ['breadcrumbs' => $breadcrumbs]);
                break;
            default:
                echo "Your user roles are not recognized by eContent LTI";
        }
    }

    public function interpretRole($UserRole)
    {
        // example of what we get from MyUNISA
        // "Instructor, Administrator,urn:lti:instrole:ims/lis/Administrator,urn:lti:sysrole:ims/lis/Administrator"
        // if (str_contains($UserRole, "urn:lti:instrole:") || str_contains($UserRole, "urn:lti:sysrole:"))
        if (str_contains($UserRole, ","))
        {
            // this is probably a SAKAI LTI Token
            // lets see if we can get an instrole, if not a sysrole
            // preg_match("/urn:lti:instrole:ims\/lis\/(\w+)/", $UserRole, $matches);
            // return $matches[1];
            $fields = explode(",", $UserRole);
            return ($fields[0] ?? "");
        } else {
            // this is another LTI Token, possibly TSUGI
            return $UserRole;
        }
    }
    
    public function lecturer_stud_analysis()
    {
        $breadcrumbs = [
            'title' => 'Lecturer - Student Analysis Dashboard'
        ];

        return view('dashboards.lecturer-stud-analysis', array(), ['breadcrumbs' => $breadcrumbs]);
    }

    public function lecturer_course_analysis()
    {
        $breadcrumbs = [
            'title' => 'Lecturer - Course Analysis Dashboard'
        ];

        return view('dashboards.lecturer-course-analysis', array(), ['breadcrumbs' => $breadcrumbs]);
    }

    public function lecturer_assess_analysis()
    {
        $breadcrumbs = [
            'title' => 'Lecturer - Assessment Analysis Dashboard'
        ];

        return view('dashboards.lecturer-assess-analysis', array(), ['breadcrumbs' => $breadcrumbs]);
    }
    
    public function mentor_stud_analysis()
    {
        $breadcrumbs = [
            'title' => 'Mentor - Student Analysis Dashboard'
        ];

        return view('dashboards.mentor-stud-analysis', array(), ['breadcrumbs' => $breadcrumbs]);
    }
    
    public function mentor_assess_analysis()
    {
        $breadcrumbs = [
            'title' => 'Mentor - Assessment Analysis Dashboard'
        ];

        return view('dashboards.mentor-assess-analysis', array(), ['breadcrumbs' => $breadcrumbs]);
    }
}
