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
    public function handle($request, Closure $next)
    {      
        if ( ! auth()->check()) {
            return redirect()->to('/');
        }

        if( ! auth()->user()->hasRole('Learner')) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
