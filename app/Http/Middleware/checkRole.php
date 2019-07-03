<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class checkRole
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

        if(Auth::user()->role == "staff"){
            return redirect('dashboard')->with('error','You dont have enough privilege to access this module.');
        }

        return $next($request);
    }
}
