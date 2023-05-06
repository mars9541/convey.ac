<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\CBR_table;
use App\CUR_table;
use App\Withdrawals;
use App\Country_spec_info;

use PDF;
use Mail;
use App\Email;
class AuthorizeController extends Controller
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
        return view('admin.authorize_withdraw');
    }

    public function get_withdraw_list(Request $request)
    {
        if($request->filter == 'all') {
            $withdraw_list = Withdrawals::orderBy('created_at', 'desc')->get();
        } else if($request->filter == 'pending') {
            $withdraw_list = Withdrawals::where('status', '0')->orderBy('created_at', 'desc')->get();
        } else {
            $withdraw_list = Withdrawals::where('status', '1')->orderBy('created_at', 'desc')->get();
        }

        return response()->json(['data' => $withdraw_list]);
    }

    public function update_withdraw(Request $request)
    {
        Withdrawals::whereId($request->id)->update(['status' => 1, 'withdraw_reference_from_processor' => $request->transaction_id] );
        $this->payment_made_email($request->id);
        $this->payment_note_downloadable($request->id);

        return response()->json(['data' => 'success']);
    }

    public function payment_made_email($withdraw_id)
    {
        $data = Email::find('9');

        if(!$data) return false;
        //// user info and mail send ///
        $withdraw_info = Withdrawals::find($withdraw_id);
        $user_id = $withdraw_info->referrer_CBR_id;
        $user = DB::table('users')->where('id', $user_id)->get();

        if($user) {
            $address = $user[0]->email;

            if($user[0]->user_type == 'citizen'){
                $user_data = CUR_table::find($user[0]->id);
                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
            } else {
                $cbr_data = CBR_table::find($user[0]->id);
                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
            }

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $content['content'] = $data->content;
            $title = $full_name;
            $subject = $data->subject;
            $from_email = $data->from_email_address;
            Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });
        }

        return true;
    }

    public function payment_note_downloadable($withdraw_id)
    {
        $data = Email::find('10');
        if(!$data) return false;
        //// user info and mail send ///
        $withdraw_info = Withdrawals::find($withdraw_id);
        $user_id = $withdraw_info->referrer_CBR_id;
        $user = DB::table('users')->where('id', $user_id)->get();
        if($user) {
            $address = $user[0]->email;

            if ($user[0]->user_type == 'citizen') {
                $user_data = CUR_table::find($user[0]->id);
                $full_name = ucwords($user_data->firstname).' '. ucwords($user_data->lastname);
            } else {
                $cbr_data = CBR_table::find($user[0]->id);
                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
            }

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $content['content'] = $data->content;
            $title = $full_name;
            $subject = $data->subject;
            $from_email = $data->from_email_address;
            Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });
        }
        return true;
    }

}
