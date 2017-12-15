<?php

namespace EONConsulting\TaoClient\Http\Middleware;

use Closure;

class TaoOutcome
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
        $tao_url = str_before(config('tao-client.api_url'), '/tao');

        if( ! str_contains($tao_url, request()->header('host')))
        {
            abort(403);
        }

        return $next($request);
    }
}
