<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Openticket;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            if(Auth::check()){
                $assigned_country = explode(',',Auth::user()->assigned_countries);
                $assigned_departments = explode(',',Auth::user()->assigned_departments);
                $new_ticket = Openticket::WhereIn('country_id',$assigned_country)->WhereIn('department_id',$assigned_departments)->where('status','1')->count();
                View::share('new_message', $new_ticket);
            }
            
        });
        
    }
}
