<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
//        return view('landing.todo');

//        dd(laravel_lti()->is_learner(auth()->user()));


        // else
        if (laravel_lti()->is_learner(auth()->user())) {
            return view('lti.dashboards.student');
        }

        if (laravel_lti()->is_instructor(auth()->user())) {
            return view('lti.dashboards.lecturer');
        }

//        return view('admin.dashboards.dashboard'); Todo::replace
        return view('lti.dashboards.student');
        //return view('admin.dashboards.student');
    }
}
