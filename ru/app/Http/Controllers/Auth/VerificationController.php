<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\User;
use Mail;
use App\Email;
use App\Country_spec_info;
use App\CBR_table;
use App\CUR_table;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        // $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function confirm_email($token)
    {
        $user = User::where('token_key', $token)->first();
        $user->email_verify = '1';
        $user->update();
        $this->send_email($user);

        return redirect('login_redirect/'.$user->id);
    }

    public function send_email($user)
    {
        if($user) {
            $data = Email::find('4');
            if(!$data) return response()->json(['error' => 'Please check Email Template!']);

            $address = $user->email;

            if($user->user_type == 'citizen') {
                $user_data = CUR_table::find($user->id);
                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
            } else {
                $cbr_data = CBR_table::find($user->id);
                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
            }

            $data->content = str_replace("[name_here]", $full_name, $data->content);

            $title = $full_name;
            $subject = $data->subject;
            $from_email = $data->from_email_address;
            $content['content'] = $data->content;
            Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });

            return true;
        }

        return false;
    }
}
