<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Country;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    public function showLoginForm()
    {
        return view('auth.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function login(Request $request)
    {
        require_once base_path().'/vendor/securimage/securimage.php';

        $securimage = new \Securimage();
//        dd(session('captch_error'));
        if ($securimage->check($request->captcha_code) == false) {
            return redirect()->back()->withInput()->with('captch_error', 'Captcha code incorrect. Please try again!');
        }
        $this->validateLogin($request);
        $user = User::where('name',$request->name)->first();
        if(isset($user))
        {
            $country = Country::whereIn('id',explode(',',$user->assigned_countries))->get();
            if(count($country)>0){
                foreach ($country as $key => $item) {
                    if($item->country_code==app()->getLocale()){
                        if ($this->attemptLogin($request)) {
                            return $this->sendLoginResponse($request);
                        }
                    }
                }
            }
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function login_redirect($email)
    {
        $user = User::Where('name',$email)->first();

        $this->guard()->login($user);
        return redirect('/home');
    }

    public function authenticated(Request $request, $user)
    {
        return redirect('/home');

    }

}
