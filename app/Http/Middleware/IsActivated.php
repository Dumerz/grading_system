<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsActivated
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
        if (Auth::user()->status == 'USRSTAT002') {
            return $next($request);
        }
            auth()->logout();
            return redirect('/login')->with('warning', 'Your account is not active. Please contact system adminstrator.');
    }
}
