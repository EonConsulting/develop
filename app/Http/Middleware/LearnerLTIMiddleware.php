<?php

namespace App\Http\Middleware;

use Closure;

class LearnerLTIMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(!auth()->check())
            return redirect()->to('/');

        $user = $request->user();
        if(!$user) {
            // user not found
            return redirect()->to('/');
        }

        $lti = $user->lti;
        if(count($lti) == 0) {
            // no lti links found
            return redirect()->to('/');
        }

        $lti = $lti[0];
        $role = $lti->roles;

        switch($role) {
            case 'Learner':
                return $next($request);
                break;
        }

        return redirect()->to('/');
    }
}
