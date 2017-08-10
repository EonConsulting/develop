<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 2017/07/11
 * Time: 12:55 AM
 */
namespace App\Http\Controllers;
use EONConsulting\LaravelLTI\Http\Controllers\LTIAuthBaseController;
use EONConsulting\LaravelLTI\Models\UserLTILink;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class HomeController extends LTIAuthBaseController
{
    /**
     * @var bool
     */
    protected $hasAuth = true;
    /**
     * @var
     */
    protected $user;
    //Todo:: Update
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        //dd($this->user->id);
        switch ($this->get_user_role($this->user)) {
            case 'Instructor':
                //return view('nonlti.dashboards.lecturer');
                return view('dashboards.lecturer');
            break;
            case 'Learner':
                return view('dashboards.student');
            break;
            default:
                return redirect('/');
        }
//         Might Need Them in Future
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
    /**
     * @param bool $user
     * @return bool
     */
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
    public function current_user() {
        $this->user = auth()->user();
        return $this->user->lti[0];
    }
}