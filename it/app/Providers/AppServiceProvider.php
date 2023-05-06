<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Openticket;
use App\Country_spec_info;
use App\Country;
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
        view()->composer('*', function ($view) {
            if(Auth::check()){
                $country = Country::where('country_name', Country_spec_info::value('country_name'))->first();
                $new_ticket_count = Openticket::where('country_id', $country->id)
                    ->where('id_opened_by', Auth::user()->id)
                    ->where('status', '3')
                    ->where('closed_at', NULL)
                    ->get()
                    ->count();
                View::share('new_ticket_count', $new_ticket_count);
            }
        });

    }
}
