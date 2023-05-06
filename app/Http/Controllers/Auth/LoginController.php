<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User_main;
use App\User;
use App\Cohort;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function week_start_date()
    {
        // dd(app()->getLocale());
        $last_week = Cohort::latest('week_start_date')->first();
        $dt_min = new \DateTime("last saturday"); // Edit
        $dt_min->modify('+1 day');
        $week_start_date = $dt_min->format('Y-m-d');
        if($last_week==null||$last_week->week_start_date!=$week_start_date)
        {
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'business'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'advisors'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'citizen'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'hris'));
        }
        return true;
    }
    public function login(Request $request)
    {
        require_once base_path().'/vendor/securimage/securimage.php';
        
        $securimage = new \Securimage();
        if ($securimage->check($request->captcha_code) == false) {
            return redirect()->back()->withInput()->with('captch_error', 'Captcha code incorrect. Please try again!');
        }
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function login_redirect($locale, $email)
    {
        $user = User::Where('email',$email)->first();

        $this->guard()->login($user);
        // dd(auth()->user()->email);
        return redirect(app()->getLocale().'/home1');
    }

    public function authenticated(Request $request, $user)
    {
        // dd('');
        if(Auth::user()->user_role=='globaladmin')
            return redirect('global/global_admin');
        if(Auth::user()->user_role=='globalteamadmin')
            return redirect('global/global_team_admin');
        if(Auth::user()->user_type)
            if($this->week_start_date()){

                return redirect(app()->getLocale().'/home1');
            }
        
    }

}
