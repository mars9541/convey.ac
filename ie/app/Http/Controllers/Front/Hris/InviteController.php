<?php
namespace App\Http\Controllers\Front\Hris;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Invite_code;
use App\PaymentsReceived;
use App\Withdrawals;
use App\Deposits;
use App\Country_spec_info;
use App\Guide;
use App\CBR_table;
use App\User;

use PDF;
use Mail;
use App\Email;
class InviteController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //////  code tab  ///////
        $universal_code = Invite_code::where('generated_by_CBR_id',Auth::user()->id)
            ->where('code_type','2')
            ->orderByDesc('created_at')
            ->first();
        $today = date_create();

        if($universal_code)
        {
            $diff_date = date_diff($today,date_create($universal_code->expires_on))->format("%R%a");

            if($diff_date>0) {
                $universal_code->message = ' expiry date:'.date_format(date_create($universal_code->expires_on),'m/d/Y').'';
                $universal_code->view_code = 'yes';
            } else if(-20<$diff_date&&$diff_date<0) {
                $universal_code->view_code = 'no';
                $universal_code->message = (20+$diff_date).' days until your new code can be generated';
            } else {
                $universal_code->message = '';
            }
        }
        $paypal_account = Auth::User()->paypal_address;
        return view('front.hris.invite-codes', compact('universal_code',  'paypal_account'));
    }

    function random_strings($length_of_string)
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    public function generate_universal_code(Request $request)
    {
        $today = date_create();
        date_modify($today, "+10 days");
        $expired_date = date_format($today, "Y-m-d");
        $invite_code = new Invite_code;
        $invite_code->invite_code = $this->random_strings(10);
        $invite_code->code_type = '2';
        $invite_code->generated_by_CBR_id = Auth::user()->id;
        $invite_code->expires_on = $expired_date;
        $invite_code->save();

        $this->universal_code_email_send();

        $invite_code->reminder_sent_on = date_create();
        $invite_code->update();

        return redirect()->back();
    }

    public function universal_code_email_send() {
        $data = Email::find('128');

        $title = $data->title;
        $from_email = $data->from_email_address;

        $subject = $data->subject;
        $to_email = Auth::user()->email;

        $img = '<img src="{link_url}" style="width: 312px;"><span style="font-family: Verdana;"><br></span>';
        $link_url = asset('assets/images/email_img/unique_code_email.png');
        $img = str_replace('{link_url}', $link_url, $img);
        $content['content'] = str_replace("[image]", $img, $data->content);

        try {
            Mail::send('mail.email_template', $content, function($message) use ($to_email, $from_email, $title, $subject) {
                $message->to($to_email, $title)->subject($subject);
                $message->from($from_email);
            });
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function get_unique_code(Request $request)
    {
        $data = Invite_code::where('generated_by_CBR_id',Auth::user()->id)
            ->where('code_type','1')
            ->where('expires_on','>',date('Y-m-d'))
            ->where('used_by_CBR_id',null)
            ->get();
        return response()->json(['data' => $data]);
    }

    public function save_unique_code(Request $request)
    {
        $already_sign_user = User::where('email', $request->email)->get();
        $already_sent_invitation = Invite_code::where('generated_by_CBR_id', Auth::user()->id)
            ->where('code_type', '1')
            ->where('expires_on','>', date('Y-m-d'))
            ->where('used_by_CBR_id', null)
            ->where('assigned_to', $request->email)
            ->get();

        if(count($already_sign_user) > 0 || count($already_sent_invitation) > 0) {
            return response()->json(['status' => 'already_exist']);
        }

        $today = date_create();
        date_modify($today,"+10 days");
        $expired_date = date_format($today,"Y-m-d");
        $invite_code = new Invite_code;
        $invite_code->invite_code = $request->unique_code;
        $invite_code->code_type = '1';
        $invite_code->generated_by_CBR_id = Auth::user()->id;
        $invite_code->expires_on = $expired_date;
        $invite_code->assigned_to = $request->email;
        $invite_code->save();

        $business_name = '';
        $cbr_data = CBR_table::find(Auth::user()->id);

        if($cbr_data) {
            $business_name = $cbr_data->ocb_name;
        }

        $this->email_send($invite_code->assigned_to, $business_name, $invite_code->invite_code);

        $invite_code->reminder_sent_on = date_create();
        $invite_code->update();

        return response()->json(['status' => 'success']);
        //// email send part ////

    }

    public function email_send($address, $full_name, $invite_code)
    {
        $now = date('Y-m-d H:i:s');
        $data = Email::find('126');

        $title = $data->title;
        $from_email = $data->from_email_address;

        $subject = $data->subject;
        $content['content'] = $data->content;

        $content['content'] = str_replace("[invite_code]", $invite_code, $content['content']);
        $content['content'] = str_replace("[referrer_name]", $full_name, $content['content']);

        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        $invite_code_info = Invite_code::where('invite_code', '!=', $invite_code)
            ->where('code_type', '1')
            ->where('generated_by_CBR_id', Auth::user()->id)
            ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($now . "-14 days")))
            ->get();

        if(count($invite_code_info) == 0) {
            $data = Email::find('131');

            $title = $data->title;
            $from_email = $data->from_email_address;

            $subject = $data->subject;
            $to_email = Auth::user()->email;

            $img = '<img src="{link_url}" style="width: 312px;"><span style="font-family: Verdana;"><br></span>';
            $link_url = asset('assets/images/email_img/unique_code_email.png');
            $img = str_replace('{link_url}', $link_url, $img);
            $content['content'] = str_replace("[image]", $img, $data->content);

            Mail::send('mail.email_template', $content, function($message) use ($to_email, $from_email, $title, $subject) {
                $message->to($to_email, $title)->subject($subject);
                $message->from($from_email);
            });
        }

        return true;
    }

    public function receive_his(Request $request)
    {
        $country_spec_info = Country_spec_info::first();
        $receive_his = Deposits::where('referrers_CBR_id',Auth::user()->id)
            ->where('status','1')
            ->limit(30)
            ->get();

        foreach ($receive_his as $key => $value) {
            $receive_his[$key]->referrer_email = $value->user->ocb_name;
            $receive_his[$key]->spent_amount = $value->received->payment_amount_excluding_vat;
        }
        return response()->json(['data' => $receive_his]);
    }

    public function get_received_amount()
    {
        $receive_his = Deposits::where('referrers_CBR_id',Auth::user()->id)
            ->where('status','1')
            ->get();
        $total_payment = 0;
        foreach ($receive_his as $key => $value) {
            $total_payment += $value->deposit_amount_including_vat;
        }
        return response()->json(['amount' => $total_payment]);
    }


    public function withdraw_his()
    {
        $data = Withdrawals::where('referrer_CBR_id',Auth::user()->id)
            ->orderByDesc('date_of_withdraw')
            ->get();
        return response()->json(['data' => $data]);
    }

    public function withdraw_request(Request $request)
    {
//        $paypal_address = User::find(Auth::user()->id)->paypal_address;

        $country_spec_info = Country_spec_info::first();
        $payment_advice_note_number = Withdrawals::max('payment_advice_note_number');
        if(!$payment_advice_note_number) {
            $payment_advice_note_number = $country_spec_info->payment_advice_note_starting_number;
        }

        $withdraw = new Withdrawals;
        $withdraw->referrer_CBR_id = Auth::user()->id;
        $withdraw->date_of_withdraw = date('Y-m-d');
        $withdraw->withdraw_amount_including_vat = $request->amount;
        $withdraw->withdraw_amount_excluding_vat = $request->amount/(1+$country_spec_info->VAT_percentage/100);
        $withdraw->vat_amount = $withdraw->withdraw_amount_including_vat - $withdraw->withdraw_amount_excluding_vat;
        $withdraw->payment_advice_note_number = $payment_advice_note_number+1;
        $withdraw->wallet_id = Auth::user()->paypal_address;
        $withdraw->status = 0;
        $withdraw->save();

        $deposits = Deposits::where('referrers_CBR_id',Auth::user()->id)->where('status','1')->get();

        foreach ($deposits as $key => $value) {
            $deposits_update = Deposits::find($value->id);
            $deposits_update->status = '2';
            $deposits_update->withdraw_id = $withdraw->id;
            $deposits_update->save();
        }

        return response()->json(['status' => 'success']);
    }


    public function advice_note_download($id)
    {
        $withdraw = Withdrawals::find($id);
        $country_spec_info = Country_spec_info::first();
        $logo_url = User::where('id', Auth::user()->id)->first()->logo_url;
        $data = [
            'data'=>$withdraw,
            'spec_info'=>$country_spec_info,
            'record_logo' => $logo_url
        ];

        $pdf = PDF::loadView('front.advice_note_pdf', $data)->setPaper('a4');

        return $pdf->download('AdviceNote.pdf');
    }

    public function add_paypal(Request $request){
        User::whereId(Auth::user()->id)->update(["paypal_address" => $request->receiver_account]);
        return response()->json(['status' => 'success']);
    }
}
