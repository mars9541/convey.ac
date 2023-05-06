<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Cohort;
use App\Country_list;
use Mail;
use App\Email;
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
        $country = Country_list::where('short_lang', 'jp')->get();
        return view('auth.login',compact('country'));
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function login_redirect($id)
    {
        $user = User::Where('id',$id)->first();

        $this->guard()->login($user);
        // dd(auth()->user()->email);
        return redirect('/home1');
    }

    public function credit_offer_redirect($token)
    {
        $user = User::Where('token_key', $token)
            ->where('credits_remaining', '0')
            ->where('credit_offer_expire_date', '>', date('Y-m-d H:i:s'))
            ->first();

        if($user) {
            $this->guard()->login($user);

            if($user->user_type == 'business') {
                return redirect('business/credit_offer');
            } else {
                return redirect('advisors/credit_offer');
            }
        } else {
            return redirect('/login');
        }
    }

    public function unlock_record_redirect($token)
    {
        $user = User::Where('token_key', $token)->first();

        if($user) {
            $this->guard()->login($user);

            return redirect('citizen/settings?tab=3');
        } else {
            return redirect('/login');
        }
    }

    public function check_replied_ticket_redirect($token)
    {
        $user = User::Where('token_key', $token)->first();

        if($user) {
            $this->guard()->login($user);
            return redirect('business/contact');
        } else {
            return redirect('/login');
        }
    }

    public function authenticated(Request $request, $user)
    {
        if(Auth::user()->user_type)
            // if($this->week_start_date()){

            return redirect('/home1');
        // }

    }

    public function login(Request $request)
    {
        require_once base_path().'/vendor/securimage/securimage.php';

        $securimage = new \Securimage();
//dd($securimage->check($request->captcha_code),$request->captcha_code);
        if ($securimage->check($request->captcha_code) == false) {
            return redirect()->back()->withInput()->with('captch_error', 'キャプチャコードが正しくありません。もう一度お試しください。');
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



}
