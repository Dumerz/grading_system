<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CanCreateCourse
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
        if (Auth::user()->usertype == 'USRTYPE003') {
            return $next($request);
        }

        elseif (Auth::user()->usertype == 'USRTYPE002') {
            return $next($request);
        }

        return redirect('home')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
    }
}
