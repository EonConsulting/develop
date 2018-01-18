<?php

namespace App\Http\Middleware;

use Closure;

class AdministratorLTIMiddleware
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

        if( ! auth()->user()->hasRole('Administrator')) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
