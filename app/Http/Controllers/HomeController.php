<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check if user has any roles, if not
        // If User :: Authenticate()
        $user = auth()->user();
       // dd($user);

        if(!$user) {
            // user not found
            return false;
        }

        if(!(laravel_lti()->is_learner($user) || laravel_lti()->is_instructor($user))) {
            //return view('nonlti.dashboards.student');
            return view('nonlti.dashboards.student');
        }

        if (laravel_lti()->is_learner($user)) {
            return view('lti.dashboards.student');
        }
        if (laravel_lti()->is_instructor($user)) {
            return view('lti.dashboards.lecturer');
        }

        //return view('lti.dashboards.student');
        return view('nonlti.dashboards.student');
    }
}
