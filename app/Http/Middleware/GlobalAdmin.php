<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class GlobalAdmin
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
        if(Auth::user()->user_role=='globaladmin')
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            // Session::flush();
            return redirect('login');
        }
    }
}