<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class Citizen
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
        if(Auth::user()->user_type=='citizen')
        {
            /*$now = date('Y-m-d H:i:s');
            $user = User::where('id', Auth::user()->id)->where('email_verify', '!=', '1')->where('signup_date', '<', date('Y-m-d H:i:s',strtotime($now . "-4 days")))->first();
            $request_url = $request->getRequestUri();
            $url_array = explode('/', $request_url);
            $last_url = $url_array[count($url_array) - 1];

            if($last_url != "settings" && $user) {
                return redirect('citizen/settings');
            }*/

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
