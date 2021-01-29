<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class Developer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check() || Auth::user()->role != 'developer'){
            return Redirect::intended('apps');
        }

        return $next($request);
    }
}
