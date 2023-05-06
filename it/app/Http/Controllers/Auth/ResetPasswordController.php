<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use Mail;
use App\Email;
use App\Country_spec_info;
use App\CBR_table;
use App\CUR_table;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function retrieval()
    {
        return view('auth.retrieval');
    }

    public function send_password(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            $data = Email::find('3');

            if(!$data) return response()->json(['error'=>'Please check Email Template!']);

            $address = $request->email;
            // password replace ///
            $new_password = Str::random(8);
            $data->content = str_replace("[password_here]", $new_password, $data->content);

            // name replace ////
            if($user->user_type == 'citizen') {
                $user_data = CUR_table::find($user->id);
                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
            } else {
                $cbr_data = CBR_table::find($user->id);
                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
            }

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $content['content'] = $data->content;
            $title = $full_name;
            $subject = $data->subject;
            $from_email = $data->from_email_address;

            if($user) {
                Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                    $message->to($address, $title)->subject($subject);
                    $message->from($from_email);
                });
            }

            $user = User::where('email', $request->email)->update(['password' => Hash::make($new_password)]);

            return response()->json(['success' => 'Email send Successfully!']);
        } else {
            return response()->json(['error' => 'Email send UnSuccessfully!']);
        }
    }
}
