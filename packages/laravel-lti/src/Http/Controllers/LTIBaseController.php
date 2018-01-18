<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/02/12
 * Time: 1:00 AM
 */

namespace EONConsulting\LaravelLTI\Http\Controllers;

require_once "config.php";

use App\Models\User;
use EONConsulting\LaravelLTI\Models\UserLTILink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tsugi\Config\ConfigInfo;
use Tsugi\Laravel\LTIX;
use Tsugi\Util\LTI;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LTIBaseController extends Controller {

    /**
     * @var bool
     */
    protected $hasLTI = true;

    /**
     * Check to see if the user_id has a lti user
     *
     * @param null $user_id
     * @return bool
     */
    protected function hasLtiUser($user_id = null)
    {
        try {

            $user = UserLTILink::where('lti_user_id', $user_id)->firstOrFail();

        } catch(ModelNotFoundException $e) {
            return false;
        }

        return $user;
    }

    /**
     * Check to see if the user can be found by email
     *
     * @param null $email
     * @return bool
     */
    protected function hasUser($email = null)
    {
        try {

            $user = User::where('email', $email)->firstOrFail();

        } catch(ModelNotFoundException $e) {
            return false;
        }

        return $user;
    }

    /**
     * LTIBaseController constructor.
     */
    public function __construct()
    {
        if($this->hasLTI)
        {
            $this->middleware(function($request, $next)
            {
                $launch = LTIX::laravelSetup($request, LTIX::ALL);

                if( ! array_key_exists('user_id', $request->all()))
                {
                    if($launch->redirect_url)
                    {
                        return redirect($launch->redirect_url);
                    }

                    return $next($request);
                }

                if( ! $user = $this->hasLtiUser($request->get('user_id')))
                {
                    if( ! $user = $this->hasUser($request->get('lis_person_contact_email_primary')))
                    {
                        try {
                            $user = User::create([
                                'email' => $request->get('lis_person_contact_email_primary'),
                                'name' => $request->get('lis_person_name_full'),
                                //Create Default Password
                                'password' => Hash::make('12345'),
                            ]);
                        } catch(QueryException $e)
                        {
                            \Log::error('[LTIBaseController] ' . $e->getMessage());
                            abort(500, $e->getMessage());
                        }
                    }

                    try {

                        UserLTILink::create([
                            'user_id' => $user->id,
                            'lti_user_id' => $request->get('user_id'),
                            'context_id' => $request->get('context_id'),
                            'lis_person_contact_email_primary' => $request->get('lis_person_contact_email_primary'),
                            'lis_person_name_family' => $request->get('lis_person_name_family'),
                            'lis_person_name_full' => $request->get('lis_person_name_full'),
                            'lis_person_name_given' => $request->get('lis_person_name_given'),
                            'lis_person_sourcedid' => $request->get('lis_person_sourcedid'),
                            'lis_result_sourcedid' => $request->get('lis_result_sourcedid'),
                            'roles' => $request->get('roles')
                        ]);
                    } catch(QueryException $e)
                    {
                        \Log::error('[LTIBaseController] ' . $e->getMessage());
                        abort(500, $e->getMessage());
                    }
                }

                Auth::loginUsingId($user->id);

                if($launch->redirect_url)
                {
                    return redirect($launch->redirect_url);
                }

                //if ($launch->send_403) return response($launch->error_message, 403);
                ob_start();
                ob_get_clean();

                return $next($request);
            });
        }
    }
}