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
            toast('You dont have enough privilege to access this module.','error');
            return redirect('dashboard');
        }

        return $next($request);
    }
}
