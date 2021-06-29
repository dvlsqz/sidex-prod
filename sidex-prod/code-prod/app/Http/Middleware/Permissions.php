<?php

namespace App\Http\Middleware;

use Closure, Route, Auth;

class Permissions
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
        if(Auth::user()->role == "0" && kvfj(Auth::user()->permissions, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->role == "1" && kvfj(Auth::user()->permissions, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->role == "2" && kvfj(Auth::user()->permissions, Route::currentRouteName()) == true):
            return $next($request);
        else:
            return redirect('/inicio/todas');
        endif;

    }
}
