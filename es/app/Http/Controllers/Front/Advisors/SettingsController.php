<?php
namespace App\Http\Controllers\Front\Advisors;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\CBR_table;
use App\User;
use App\Signup_rule;
use App\Market;
use App\Global_link;
use App\Country_list;
class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('global');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d H:i:s');
        $user_info = CBR_table::where('id',Auth::user()->id)->first();
        $user_info->advisors_type = User::where('id',Auth::user()->id)->first()->advisors_type;
        $user = User::where('id', Auth::user()->id)->where('email_verify', '!=', '1')->where('signup_date', '<', date('Y-m-d H:i:s',strtotime($now . "-4 days")))->first();
        $email_verify = 1;

        if($user) {
            $email_verify = 0;
        }

        $market = Market::where('short_lang', 'en')->get();
        $countries = CommonController::countriesArray();
        $freeEmails = Signup_rule::all();
        $freeEmailList = '';
        foreach ($freeEmails as $item)
        {
            if($freeEmailList == '')
                $freeEmailList = $item->email_type;
            else
                $freeEmailList .= ','.$item->email_type;
        }
        return view('front.advisors.settings', compact('user_info', 'market', 'countries', 'freeEmailList', 'email_verify'));
    }

    public function country_access()
    {
        $active_info = Global_link::where('user_id', Auth::user()->id)
            ->where('country_code', app()->getLocale())
            ->first();

        if($active_info) {
            $active_flag = true;
            $global_id = $active_info->global_id;
        } else {
            $active_flag = false;
            $global_id = 0;
        }

        $country_list = DB::connection('mysql2')->select('SELECT c.*, g.user_id
                        FROM `country_list` c
                        LEFT JOIN global_link g
                        ON (c.country_code = g.country_code AND g.global_id = "'.$global_id.'")
                        WHERE c.short_lang = "en" AND c.country_code != "'.app()->getLocale().'"');
        $country_info = Country_list::where('country_code', app()->getLocale())
            ->where('short_lang', 'en')
            ->first();

        return view('front.advisors.country-access', compact('country_list', 'country_info', 'active_flag'));
    }

}
