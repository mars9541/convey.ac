<?php
namespace App\Http\Controllers\GlobalAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Country;
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
    public function index()
    {
        $countries = Country::all();
        return view('global_admin.country-list', compact('countries'));
    }

    public function insert(Request $request)
    {
        if($request->id == '') {
            $country = new Country;
            $country->country_name = $request->country_name;
            $country->country_code = $request->country_code;
            $country->database_name = $request->database_name;
            $country->database_host = $request->database_host;
            $country->database_username = $request->database_user;
            $country->database_password = $request->database_password;
            $country->save();
        } else {
            $country = Country::find($request->id);
            $country->country_name = $request->country_name;
            $country->country_code = $request->country_code;
            $country->database_name = $request->database_name;
            $country->database_host = $request->database_host;
            $country->database_username = $request->database_user;
            $country->database_password = $request->database_password;
            $country->update();
        }

        return redirect()->back()->with('msg', 'success');
    }

}
