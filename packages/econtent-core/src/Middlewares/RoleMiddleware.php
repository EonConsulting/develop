<?php

namespace EONConsulting\Core\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest())
        {
            abort(401);
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if ( ! Auth::user()->hasAnyRole($roles))
        {
            abort(401);
        }

        return $next($request);
    }
}