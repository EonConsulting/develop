<?php

namespace EONConsulting\Storyline2\Middleware;

use Closure;

class ContentLocked
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
        $parameters = $request->route()->parameters;

        $model = array_first($parameters);

        if( ! is_object($model))
        {
            return $next($request);
        }

        if( ! optional($model)->isEditable())
        {
            session()->flash('flash.error', 'You may not edit this course because it has been locked.');
            return redirect()->back();
        }

        return $next($request);
    }
}
