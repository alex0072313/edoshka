<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class RedirectSlash
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


        if (preg_match('/.+\/$/', $request->getRequestUri()) || ( ($request->route()->getName() == 'site.home')) && ($request->getRequestUri() == '/') )
        {
            //dd(rtrim($request->getRequestUri(), '/'));
            //return Redirect::to(rtrim($request->getRequestUri(), '/'), 301);
        }
        return $next($request);
    }
}
