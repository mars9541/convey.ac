<?php
namespace App\Http\Controllers\Front\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use DateTime;

use App\Credits;
use App\User;
use App\Country_spec_info;
use App\PaymentsReceived;
use App\CBR_table;
use App\ReferrerDeposits;
use PDF;
use Illuminate\Http\Request;
use Mail;
use App\Email;

class Search_creditsController extends Controller
{
    private $mangopay;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(\MangoPay\MangoPayApi $mangopay)
     {
         $this->mangopay = $mangopay;

         // $this->middleware('guest');
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment['payment'] = false;
        $payment['success'] = false;
        $balance = Auth::user()->credits_remaining;
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        $invoices_paymentreceipt = PaymentsReceived::where('payers_CBR_id', Auth::user()->id)
                                                    ->latest()
                                                    ->get();
        return view('front.business.search-credits', compact('invoices_paymentreceipt', 'connect_flag'))->with(['credit'=> $balance, 'payment' => $payment]);
    }

    public function credits_added_email()
    {
        ////// credits added //////
        $data = Email::find('7');

        if(!$data) return false;

        //// user info and mail send ///
        $user = Auth::user();
        $address = $user->email;

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
        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }

    public function payment_received_email_send()
    {
        $data = Email::find('6');

        if(!$data) return false;

        $user = User::find(Auth::user()->id);
        $address = $user->email;
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
        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }

    public function invoice_and_payment_received_downloadable_email_send()
    {
      ///// invoice and payment received ////////
        $data = Email::find('8');

        if(!$data) return false;

        $user = Auth::user();
        $address = $user->email;

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
        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }
    public function refferer_credited_email_send()
    {
        ///// refferer credited ////////
        $data = Email::find('12');

        if(!$data) return false;

        $user = User::find(Auth::user()->referrer_CBR_id);
        $address = $user->email;

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
        Mail::send('mail.email_template', $content, function($message) use ($address,$from_email,$title,$subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }

    public function get_history()
    {
        $data = Credits::Where('CBR_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        foreach ($data as $key => $value) {
            if($value->branch) {
                $data[$key]->branch_name = $value->branch->internal_identifier;
            } else {
                $data[$key]->branch_name = '-';
            }
        }

        return response()->json(['data' => $data]);
    }

    public function invoice_download($id)
    {
        $invoice = PaymentsReceived::find($id);
        $country_spec_info = Country_spec_info::first();
        $logo_url = User::where('id', Auth::user()->id)->first()->logo_url;
        $data = [
            'data' => $invoice,
            'spec_info' => $country_spec_info,
            'record_logo' => $logo_url
        ];
//         $data=$invoice;
//         $spec_info=$country_spec_info;
//         $record_logo = $logo_url;
//         return view('front.invoice_pdf',compact('data','spec_info', 'record_logo'));
        $pdf = PDF::loadView('front.invoice_pdf', $data)->setPaper('a4');

        return $pdf->download('invoice.pdf');
    }

    public function receipt_download($id)
    {
        $invoice = PaymentsReceived::find($id);
        $country_spec_info = Country_spec_info::first();
        $logo_url = User::where('id', Auth::user()->id)->first()->logo_url;
        $data = [
            'data' => $invoice,
            'spec_info' => $country_spec_info,
            'record_logo' => $logo_url
        ];
//         $data=$invoice;
//         $spec_info=$country_spec_info;
//         $record_logo = $logo_url;
//         return view('front.receipt_pdf',compact('data','spec_info', 'record_logo'));

        $pdf = PDF::loadView('front.receipt_pdf', $data)->setPaper('a4');

        return $pdf->download('receipt.pdf');
    }

    public function paypal_buy_credits(Request $request)
    {
        $user = Auth::user();
        $first_payment = false;
        $balance = $user->credits_remaining;
        $create_time = $request->create_time;
        $create_time = str_replace('T', ' ', $create_time);
        $create_time = str_replace('Z', '', $create_time);
        $credit = 4;
        $price = Country_spec_info::value('Cost_4_Credit');

        $invoice_starting_number = Country_spec_info::value('invoice_starting_number');
        Country_spec_info::query()->update(['invoice_starting_number'=>$invoice_starting_number+1]);

        $payment_receipt_starting_number = Country_spec_info::value('payment_receipt_starting_number');
        Country_spec_info::query()->update(['payment_receipt_starting_number'=>$payment_receipt_starting_number+1]);

        if(strlen($user->referrer_CBR_id) > 1 && $user->first_payment == 0) {
            $first_payment = true;
        }

        if($request->package_type == '1') {
            $credit = 4;
            $amount = Country_spec_info::value('Cost_4_Credit') * $credit;
            if($first_payment) {
                $credit += $credit / 2;
            }

            $balance += $credit;
        } else if($request->package_type == '2') {
            $credit = 12;
            $amount = Country_spec_info::value('Cost_12_Credit') * $credit;
            if($first_payment) {
                $credit += $credit / 2;
            }

            $balance += $credit;

        } else if($request->package_type == '3') {
            $credit = 100;
            $amount = Country_spec_info::value('Cost_100_Credit') * $credit;
            if($first_payment) {
                $credit += $credit / 2;
            }

            $balance += $credit;

        }
        else if($request->package_type == '4') {
            $credit = 4;
            $free_credit = 8;
            $amount = Country_spec_info::value('Cost_4_Credit') * $credit;
            $credit = $credit + $free_credit;
            $balance += $credit;
        }
        $vat = $amount *  Country_spec_info::value('VAT_percentage') / 100;

        User::Where('id', $user->id)->update(['credits_remaining' => $balance]);

        if($first_payment) {
            User::Where('id', $user->id)->update(['first_payment' => 1]);
        }

        if($request->package_type == '4') {
            User::Where('id', $user->id)->update(['credit_offer_expire_date' => date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s') . "-1 days"))]);
        }

        Credits::Insert([
            'CBR_id' => $user->id,
            'cohort_id' => $user->cohort_id,
            'adjustment_value' => '1',
            'balance' => $balance,
            'time_stamp' => date('Y-m-d'),
        ]);
        $this->credits_added_email();

        $payment_received = new PaymentsReceived();
        $payment_received->payers_CBR_id = $user->id;
        $payment_received->users_cohort = $user->cohort_id;
        $payment_received->date_of_payment = $create_time;
        $payment_received->payment_reference_from_processor = $request->id;
        $payment_received->payment_amount_excluding_vat = $amount;
        $payment_received->payment_amount_including_vat = $amount + $vat;
        $payment_received->vat_amount = $vat;
        $payment_received->invoice_number = $invoice_starting_number;
        $payment_received->receipt_number = $payment_receipt_starting_number;
        $payment_received->number_of_credits_bought = $credit;
        $payment_received->referrer_CBR_id = $user->referrer_CBR_id;
        $payment_received->save();

        $this->payment_received_email_send();
        $this->invoice_and_payment_received_downloadable_email_send();

        if(strlen(Auth::user()->referrer_CBR_id) > 1) {
            $refferer_deposit_amount_including_vat = $amount * Country_spec_info::value('referral_commission') / 100;
            $refferer_deposit_amount_excluding_vat = $refferer_deposit_amount_including_vat / ( 1 +  Country_spec_info::value('VAT_percentage') / 100);
            $referrer_deposits = new ReferrerDeposits();
            $referrer_deposits->referrers_CBR_id = Auth::user()->referrer_CBR_id;
            $referrer_deposits->wallet_id = Auth::user()->Wallet_id;
            $referrer_deposits->date_of_wallet_deposit = $create_time;
            $referrer_deposits->deposit_reference_from_processor = $request->id;
            $referrer_deposits->deposit_amount_excluding_vat = $refferer_deposit_amount_excluding_vat;
            $referrer_deposits->deposit_amount_including_vat = $refferer_deposit_amount_including_vat;
            $referrer_deposits->CBR_id_of_the_payer_they_referred = Auth::user()->id;
            $referrer_deposits->status = '1';
            $referrer_deposits->received_id = $payment_received->id;
            $referrer_deposits->save();
            $this->refferer_credited_email_send();

        }
        //return response()->json(['redirect'=>$PayIn],200);
        return response()->json(['result' => 'success'], 200);
    }

    public function get_purchase_amount(Request $request)
    {
        $first_amount = 4 * Country_spec_info::value('Cost_4_Credit');
        $second_amount =  12 * Country_spec_info::value('Cost_12_Credit');
        $third_amount =  100 * Country_spec_info::value('Cost_100_Credit');

        $first_vat = $first_amount * Country_spec_info::value('VAT_percentage') / 100;
        $second_vat = $second_amount * Country_spec_info::value('VAT_percentage') / 100;
        $third_vat = $third_amount * Country_spec_info::value('VAT_percentage') / 100;

        $total_amount['first_amount'] = $first_amount + $first_vat;
        $total_amount['second_amount'] = $second_amount + $second_vat;
        $total_amount['third_amount'] = $third_amount + $third_vat;

        return response()->json(['amount' => $total_amount], 200);
    }

    public function credit_offer(Request $request)
    {
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();

        if(Auth::user()->credit_offer_expire_date > date('Y-m-d H:i:s') && Auth::user()->credits_remaining == '0') {
            return view('front.business.credit_offer', compact('connect_flag'));
        } else {
            return redirect('/login');
        }
    }

}
