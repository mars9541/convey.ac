<?php
namespace App\Http\Controllers\Front\Citizen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Email;
use App\CUR_table;
use App\CBR_table;
use App\User;
use App\RDB_perm;
use App\Country_spec_info;
use App\Replacement_number_table;
class SettingsController extends Controller
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
    public function index(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $countries = CommonController::countriesArray();
        $user_info = CUR_table::where('id', Auth::user()->id)->first();
        $NI_min_number = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;


        if(strlen($user_info->NI_identity_number) != $NI_min_number) {
            $user_info->NI_identity_number = CommonController::DecryptNI($user_info->NI_identity_number);
        }

        /*$user = User::where('id', Auth::user()->id)->where('email_verify', '!=', '1')->where('signup_date', '<', date('Y-m-d H:i:s',strtotime($now . "-4 days")))->first();
        $email_verify = 1;

        if($user) {
            $email_verify = 0;
        }*/

        return view('front.citizen.settings', compact('user_info','countries', 'NI_min_number'));
    }

    public function account_details_update(Request $request)
    {
        $DOB = date('Y-m-d', strtotime($request->DOB));
        $user_info = CUR_table::where('id', Auth::user()->id)->first();
        $dob_flag = $user_info->dob_flag;

        $rules = array(
            'firstname' =>  'required',
            'lastname' =>  'required',
            'nationality' => 'required',
            'ma_HBN' => 'required',
            'ma_street' => 'required',
            'ma_town_or_city' => 'required',
            'ma_postcode' => 'required',
        );

        if($DOB != $user_info->DOB && $dob_flag < 1) {
            $dob_flag = $dob_flag + 1;
        }

        $form_data = array(
            'id' => Auth::user()->id,
            'firstname' =>  $request->firstname,
            'lastname' =>  $request->lastname,
            'DOB' => $DOB,
            'country' => $request->country,
            'nationality' => $request->nationality,
            'ma_HBN' => $request->ma_HBN,
            'ma_street' => $request->ma_street,
            'ma_town_or_city' => $request->ma_town_or_city,
            'ma_postcode' => $request->ma_postcode,
            'dob_flag' => $dob_flag
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        CUR_table::whereId(Auth::user()->id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated', 'dob_flag' => $dob_flag]);
    }

    function random_strings()
    {
        $str_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str_numbers = '1234567890';
        $return_strings = substr(str_shuffle($str_letters), 0, 5).substr(str_shuffle($str_numbers), 0, 4);

        return $return_strings;
    }

    public function generate_replacement_number(Request $request)
    {
        $duplication_flag = false;
        $replacement_number = '';

        while($duplication_flag === false) {
            $replacement_number = $this->random_strings();
            $user_info = Replacement_number_table::where('replacement_search_number', $replacement_number)->first();

            if($user_info) {
                $duplication_flag = false;
            } else {
                $duplication_flag = true;
            }
        }

        $citizen = CUR_table::find(Auth::user()->id);
        $citizen->replacement_search_number = $replacement_number;

        $replacement_number_info = new Replacement_number_table;
        $replacement_number_info->cur_id = Auth::user()->id;
        $replacement_number_info->replacement_search_number = $replacement_number;
        $replacement_number_info->created_at = date('Y-m-d H:i:s');
        $replacement_number_info->save();

        $citizen->save();

        return response()->json(['replacement_search_number' => $replacement_number]);
    }

    public function record_lock(Request $request)
    {
        if($request->lock_flag == 'lock') {
            $lock_flag = 1;
        } else {
            $lock_flag = 0;
        }

        $citizen = CUR_table::find(Auth::user()->id);
        $citizen->record_lock = $lock_flag;

        $citizen->save();

        $email_sent_status = 'false';
        if($request->email_flag != 'false') {
            $user = User::find($citizen->requested_business_id);
            $cbr_data = CBR_table::find($user->id);
            $full_name = ucwords($citizen->firstname).' '.ucwords($citizen->lastname);
            $data = Email::find('153');
            $to_email = $user->email;

            if($this->email_send($data, $to_email, $full_name)) {
                $email_sent_status = 'true';
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function auto_save_ni_number(Request $request)
    {
        $citizen = CUR_table::find(Auth::user()->id);
        $DOB = date('Y-m-d', strtotime($request->DOB));

        $original_ni_number = $citizen->NI_identity_number;
        $ni_flag = $citizen->ni_flag;
        $citizen->NI_identity_number = CommonController::EncryptNI($request->NI_identity_number);

        if($citizen->NI_identity_number != $original_ni_number && $ni_flag < 1) {
            $ni_flag = $ni_flag + 1;
        }

        $citizen->ni_flag = $ni_flag;

        if($request->NI_identity_number != null && $request->NI_identity_number != '') {
            if($citizen->current_past_employers == null) {
                $RDB_perm_list = RDB_perm::whereIn('NI_identity_number', [$request->NI_identity_number, CommonController::EncryptNI($request->NI_identity_number), CommonController::DecryptNI($request->NI_identity_number)])
                    ->where('DOB', $DOB)
                    ->groupBy('CBR_id', 'Branch')
                    ->orderBy('time_stamp')
                    ->get();

                $current_past_employers = "";
                $last_record_created_by = "";
                $i = 0;
                foreach($RDB_perm_list as $RDB_perm_info) {
                    $i++;
                    $current_past_employers .= $RDB_perm_info->id;
                    if(count($RDB_perm_list) > $i) {
                        $current_past_employers .= ',';
                        $last_record_created_by = $RDB_perm_info->id;
                    }
                }

                $citizen->current_past_employers = $current_past_employers;
                $citizen->last_record_created_by = $last_record_created_by;
            }
        }

        $citizen->save();

        return response()->json(['success' => 'PPS number is successfully saved', 'ni_flag' => $ni_flag]);
    }

    public function account_settings_update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if(strpos($request->password, '********') === false){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function record_settings_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $DOB = date('Y-m-d', strtotime($request->DOB));

        $user->save();

        $citizen = CUR_table::find(Auth::user()->id);
        $original_ni_number = $citizen->NI_identity_number;
        $original_replacement_number = $citizen->replacement_search_number;

        if($request->NI_identity_number) {
            $citizen->NI_identity_number = CommonController::EncryptNI($request->NI_identity_number);
        }

        $dob_flag = $citizen->dob_flag;
        $ni_flag = $citizen->ni_flag;

        if($citizen->DOB != $DOB && $dob_flag < 1) {
            $dob_flag = $dob_flag + 1;
        }

        if($citizen->NI_identity_number != $original_ni_number && $ni_flag < 1) {
            $ni_flag = $ni_flag + 1;
        }

        $citizen->DOB = $DOB;
        $citizen->dob_flag = $dob_flag;
        $citizen->ni_flag = $ni_flag;

        if($request->replacement_search_number != '' && $request->replacement_search_number) {
            $citizen->replacement_search_number = $request->replacement_search_number;

            if($original_replacement_number != $request->replacement_search_number) {
                $replacement_number = new Replacement_number_table;
                $replacement_number->cur_id = Auth::user()->id;
                $replacement_number->replacement_search_number = $request->replacement_search_number;
                $replacement_number->created_at = date('Y-m-d H:i:s');
                $replacement_number->save();
            }
        }

        if($request->NI_identity_number != null && $request->NI_identity_number != '') {
            if($citizen->current_past_employers == null) {
                $RDB_perm_list = RDB_perm::whereIn('NI_identity_number', [$request->NI_identity_number, CommonController::EncryptNI($request->NI_identity_number), CommonController::DecryptNI($request->NI_identity_number)])
                    ->where('DOB', $DOB)
                    ->groupBy('CBR_id', 'Branch')
                    ->orderBy('time_stamp')
                    ->get();

                $current_past_employers = "";
                $last_record_created_by = "";
                $i = 0;
                foreach($RDB_perm_list as $RDB_perm_info) {
                    $i++;
                    $current_past_employers .= $RDB_perm_info->id;
                    if(count($RDB_perm_list) > $i) {
                        $current_past_employers .= ',';
                        $last_record_created_by = $RDB_perm_info->id;
                    }
                }

                $citizen->current_past_employers = $current_past_employers;
                $citizen->last_record_created_by = $last_record_created_by;
            }
        }

        $citizen->save();

        return response()->json(['success' => 'Data is successfully updated', 'dob_flag' => $dob_flag, 'ni_flag' => $ni_flag]);
    }

    public function email_send($data, $to_email, $full_name)
    {
        if(!$data) return false;

        $data->content = str_replace("[name_here]", $full_name, $data->content);

        $content['content'] = $data->content;
        $title = $data->title;
        $subject = $data->subject;
        $from_email = $data->from_email_address;

        try {
            Mail::send('mail.email_template', $content, function($message) use ($to_email, $from_email, $title, $subject){
                $message->to($to_email, $title)->subject($subject);
                $message->from($from_email);
            });
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

}
