<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/07/11
 * Time: 12:55 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    protected $user;
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        // check if user has any roles, if not
        // Give him the Dashboard
        $this->user = auth()->user();
        switch ($this->get_user_role($this->user)) {
            case 'Instructor':
                return view('nonlti.dashboards.lecturer');
            break;
            case 'Learner':
                return view('nonlti.dashboards.student');
            default:
                return redirect('/');
        }
        // Might Need Them in Future
//        if (laravel_lti()->is_learner($user)) {
//            return view('lti.dashboards.student');
//        }
//        if (laravel_lti()->is_instructor($user)) {
//            return view('lti.dashboards.lecturer');
//        }
//
//        //return view('lti.dashboards.student');
//        return view('nonlti.dashboards.student');

    }

    protected function get_user_role($user = false) {
        if(!$user) {
            return false;
        }

        if(!$this->user->hasLtiLinks($this->user->id)) {
            return false;
        }

        $lti = $this->user->lti;
        $role = $lti[0]->roles;
        if(count($role) == 0) {
            return false;
        }

        return $role;
    }
}
