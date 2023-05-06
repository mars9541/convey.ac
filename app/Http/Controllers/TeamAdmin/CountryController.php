<?php
namespace App\Http\Controllers\TeamAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\User;
class CountryController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::user()->user_role=='globaladmin'){
            $team_admin = User::Where('id',$request->session()->get('team_id'))->get()[0];
            $assigned_country = explode(',',$team_admin->assigned_countries);
        }else{
            $team_admin = Auth::user();
            $assigned_country = explode(',',Auth::user()->assigned_countries);
        }
        $countries = Country::WhereIn('id',$assigned_country)->get();
        
            return view('team_admin.login-to-country' ,compact('countries','team_admin'));
        }

}
