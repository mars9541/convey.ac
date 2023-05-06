<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Country;

class DynamicDatabaseConnection
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
	public function handle($request, Closure $next)
	{

	    $database_name = Country::where('country_code',app()->getLocale())->first()->database_name;
		\Config::set('database.connections.mysql2.database', $database_name);
		// dd($database_name);
	    return $next($request);
	}
}