<?php
use App\Country;
use App\Market;
// use App\Signup_history;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
///////////////////  global admin  //////////////////////////
Auth::routes();
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/globaladministrate', function () {
	if(Auth::check()){
		if(Auth::user()->user_role=='globaladmin')
			return redirect('global/global_admin');
		elseif (Auth::user()->user_role=='globalteamadmin') {
			return redirect('global/global_team_admin');
		}
	}
    return view('auth.admin_login');
});

Route::group(['middleware' => ['auth','global'], 'prefix' => 'global/global_admin/', 'as' => 'global.', 'namespace' => 'GlobalAdmin'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('country', 'CountryController@index')->name('country');
	Route::post('country_insert', 'CountryController@insert')->name('country_insert');
	Route::get('department', 'DepartmentController@index')->name('department');
	Route::post('department_insert', 'DepartmentController@insert')->name('department_insert');
	Route::get('members', 'MemberController@index')->name('members');
	Route::post('members_insert', 'MemberController@insert')->name('members_insert');
	Route::post('member_del', 'MemberController@delete')->name('member_del');
	Route::post('put_session', 'HomeController@put_session')->name('put_team_id');
});

Route::group(['middleware' => ['auth','team'], 'prefix' => 'global/global_team_admin/', 'as' => 'team.', 'namespace' => 'TeamAdmin'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/country', 'CountryController@index')->name('country');
	Route::get('/inbox', 'InboxController@index')->name('inbox');
	Route::post('ticket_list','InboxController@ticket_list')->name('ticket_list');
	Route::post('get_ticket','InboxController@get_ticket')->name('get_ticket');
	Route::post('send_ticket','InboxController@send_ticket')->name('send_ticket');
	Route::get('getEventStream','InboxController@getEventStream')->name('getEventStream');
});

Route::get('/',function(){
//    return redirect('/gb');
	$client_ip = \Request::getClientIp(true);
    $country_info = ip_info($client_ip, "Country");

    if($country_info == "United States") {
        return redirect('/us');
    } else if($country_info == "United Kingdom") {
        return redirect('/gb');
    } else if($country_info == "Australia") {
        return redirect('/au');
    } else if($country_info == "Canada") {
        return redirect('/ca');
    } else if($country_info == "Ireland") {
        return redirect('/ie');
    } else if($country_info == "France") {
        return redirect('/fr');
    } else if($country_info == "Germany") {
        return redirect('/de');
    } else if($country_info == "Spain") {
        return redirect('/es');
    } else if($country_info == "Russia") {
        return redirect('/us');
    } else if($country_info == "Italy") {
        return redirect('/it');
    } else if($country_info == "Japan") {
        return redirect('/jp');
    } else {
        return redirect('/us');
    }
//	dd($country_info);
	return view('front.index',compact('country'));
});

Route::get('/register', function() {
	if(strlen(\Request::segment(1)) != 2)
	{
		return redirect('/gb/register');
	}
})->name('register');

Route::get('/login', function() {
	if(strlen(\Request::segment(1)) != 2)
	{
		return redirect('/gb/login');
	}
})->name('login');

// callbacks for mangopay
Route::get('callback/success','CallbackController@success');
Route::get('callback/fail','CallbackController@fail');
Route::get('callback/flag','CallbackController@flag');

Route::get('/payment', function () {
  return view('mangopay.mangopay');

});

Route::get('/me', function () {
    return view('front.me');
});

Route::get('/hris', function () {
    return view('front.hris');
});

Route::get('/app-search', function () {
    return view('front.applicantionsearch');
});

Route::get('/employee-engagement', function () {
    return view('front.employeeengagement');
});

Route::get('/record-creator', function () {
    return view('front.employeerecordcreator');
});

Route::get('/reduce-day', function () {
    return view('front.reducesickday');
});

Route::get('/developer', function () {
    return view('front.developer');
});

Route::get('/advisor', function () {
    return view('front.advisor');
});

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
