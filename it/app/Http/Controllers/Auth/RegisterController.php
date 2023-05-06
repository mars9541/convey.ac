<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Country_list;
use App\Market;
use App\Signup_history;
use App\User_main;
use App\Country_spec_info;
use App\CBR_table;
use App\CUR_table;
use App\Cohort;
use App\Invite_code;
use App\Guide;
use Auth;
use Mail;
use App\Email;
use App\RDB;
use App\RDB_perm;
use App\RecordHistory;
use App\Signup_rule;
use App\Gallery;
use App\RecordTypeMode;
use App\Request_dep_eva_history;
use App\RecordType;
use App\Branch;
use Illuminate\Support\Str;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $mangopay;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay)
    {
        $this->mangopay = $mangopay;
    }

    public function showRegistrationForm()
    {
        $market = Market::where('short_lang', 'it')->get();
        $country = Country_list::where('short_lang', 'it')->get();
        $freeEmails = Signup_rule::all();
        $freeEmailList = '';
        foreach($freeEmails as $item)
        {
            if($freeEmailList == '') {
                $freeEmailList = $item->email_type;
            } else {
                $freeEmailList .= ',' . $item->email_type;
            }
        }

        return view('auth.register', compact('country', 'market', 'freeEmailList'));
    }


    public function email_verify(Request $request)
    {
        $email_verify = User::where('email', $request->email)->exists();

        if($email_verify == true) {
            return response()->json(['status' => $email_verify]);
        } else {
            if($request->user_type == 'advisors' || $request->user_type == 'hris') {
                $country_list = Country_list::where('short_lang', 'en')
                    ->where('country_code', '!=', app()->getLocale())
                    ->get();

                foreach($country_list as $country_info) {
                    CBR_table::set_database_name($country_info['country_code']);
                    $another_country_same_user = User::where('email', $request->email)
                        ->where('user_type', $request->user_type)
                        ->exists();

                    if($another_country_same_user == true) {
                        return response()->json(['status' => 'another_country']);
                    }
                }

                CBR_table::set_default_database_name();

                return response()->json(['status' => $email_verify]);
            } else {
                return response()->json(['status' => $email_verify]);
            }

        }
    }

    public function code_verify(Request $request)
    {
        $code_verify = Invite_code::where('invite_code', $request->code)->where('expires_on', '>=', date('Y-m-d'))->exists();

        echo json_encode($code_verify);
    }

    public function user_create(Request $request)
    {
        $user = new User;
        $country_name = Country_spec_info::value('country_name');

        if(User::count() == 0) {
            $newId = Country_spec_info::value('country_ID').Country_spec_info::value('CUR_CBR_starting_number');
            $user->id = $newId;
        } else {
            $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id) - 2) AS int)) AS MaxNum FROM users')[0]->MaxNum;
            $newId = Country_spec_info::value('country_ID').strval($maxId + 1);
            $user->id = $newId;
        }

        $user->user_type = $request->user_type;

        if($request->user_type == 'hris'){
            $user->hris_type = $request->hris_type;
        }
        if($request->user_type == 'advisors'){
            $user->advisors_type = $request->advisors_type;
        }

        /*   cohort id and referral code */
        $date = $this->week_start_date();

        if($date) {
            $cohort_id = Cohort::where(['week_start_date' => $date, 'Type_of_cohort' => $user->user_type])->first()->cohort_id;
        }

        /*  Invite code  */
        $refferre_CBR_id = '';
        if($request->referral_code != '')
        {
            $refferre = Invite_code::where('invite_code', $request->referral_code)->where('expires_on', '>', date('Y-m-d'))->first();

            if($refferre != null) {
                $refferre_CBR_id = $refferre->generated_by_CBR_id;
                if($refferre->code_type == '2') {
                    if(is_null($refferre->used_by_CBR_id)) {
                        Invite_code::where('invite_code', $request->referral_code)->update(['used_by_CBR_id' => $user->id]);
                    } else {
                        Invite_code::where('invite_code', $request->referral_code)->update(['used_by_CBR_id' => $refferre->used_by_CBR_id . ',' . $user->id]);
                    }
                } else if($refferre->code_type == '1') {
                    Invite_code::where('invite_code', $request->referral_code)
                        ->update(['used_by_CBR_id' => $user->id, 'expires_on' => date('Y-m-d', strtotime(date('Y-m-d') . "-1 days"))]);
                }
            } else {
                return redirect()->back()->with('referral_code','refferral code error');
            }
        }

        $birthday = $request->year.'-'.$request->month.'-'.$request->day;

        $user->signup_date = date('Y-m-d H:i:s');
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->cohort_id = $cohort_id;
        $user->referrer_CBR_id = $refferre_CBR_id;
        $user->token_key = md5(time().Str::random(6));
        $user->origin_user_flag = '0';

        if($request->user_type != 'citizen') {
            $user->business_type = $request->business_type;
        }

        $user->save();

        if($request->user_type != 'citizen')
        {
            if(CBR_table::find($request->id)) {
                $business = CBR_table::find($user->id);
            } else {
                $business = new CBR_table;
                $business->id = $newId;
                $business->user_type = $user->user_type;
                $business->hris_type = $user->hris_type;
                $business->business_type = $request->business_type;
                $business->market = $request->market;
                $business->employees = $request->employees;
                $business->save();
            }

            switch ($user->business_type) {
                case 'organisation':
                {
                    $cbr_data = CBR_table::Where('id', $newId)->update([
                        'ocb_name' => $request->ocb_name,
                        'VAT_if_registered' => $request->VAT_if_registered,
                        'lrd_firstname' => $request->lrd_firstname,
                        'lrd_lastname' => $request->lrd_lastname,
                        'lrd_DOB' => $birthday,
                        'lrd_country' => $request->lrd_country,
                        'lrd_nationality' => $request->lrd_nationality,
                        'ma_HBN' => $request->ma_HBN,
                        'ma_street' => $request->ma_street,
                        'ma_town_or_city' => $request->ma_town_or_city,
                        'ma_postcode' => $request->ma_postcode,

                        'company_lrd_country' => $request->company_lrd_country,
                        'company_ma_HBN' => $request->company_ma_HBN,
                        'company_ma_street' => $request->company_ma_street,
                        'company_ma_town_or_city' => $request->company_ma_town_or_city,
                        'company_ma_postcode' => $request->company_ma_postcode,
                        'website' => $request->website,

                        'direct_connect_flag' => 1,
                        'hris_connect_flag' => 1,
                        'api_connect_flag' => 1
                    ]);
                    break;
                }

                case 'selfemployed':
                    $cbr_data = CBR_table::Where('id', $newId)->update([
                        'ocb_name' => $request->ocb_name,
                        'VAT_if_registered' => $request->VAT_if_registered,
                        'lrd_firstname' => $request->lrd_firstname,
                        'lrd_lastname' => $request->lrd_lastname,
                        'lrd_DOB' => $birthday,
                        'lrd_country' => $request->lrd_country,
                        'lrd_nationality' => $request->lrd_nationality,
                        'ma_HBN' => $request->ma_HBN,
                        'ma_street' => $request->ma_street,
                        'ma_town_or_city' => $request->ma_town_or_city,
                        'ma_postcode' => $request->ma_postcode,
                        'website' => $request->website,

                        'direct_connect_flag' => 1,
                        'hris_connect_flag' => 1,
                        'api_connect_flag' => 1
                    ]);
                    break;
                case 'company':
                    $cbr_data = CBR_table::Where('id', $newId)->update([
                        'ocb_name' => $request->ocb_name,
                        'company_no' => $request->company_no,
                        'VAT_if_registered' => $request->VAT_if_registered,
                        'lrd_firstname' => $request->lrd_firstname,
                        'lrd_lastname' => $request->lrd_lastname,
                        'lrd_DOB' => $birthday,
                        'lrd_country' => $request->lrd_country,
                        'lrd_nationality' => $request->lrd_nationality,
                        'ma_HBN' => $request->ma_HBN,
                        'ma_street' => $request->ma_street,
                        'ma_town_or_city' => $request->ma_town_or_city,
                        'ma_postcode' => $request->ma_postcode,
                        'company_lrd_country' => $request->company_lrd_country,
                        'company_ma_HBN' => $request->company_ma_HBN,
                        'company_ma_street' => $request->company_ma_street,
                        'company_ma_town_or_city' => $request->company_ma_town_or_city,
                        'company_ma_postcode' => $request->company_ma_postcode,
                        'website' => $request->website,

                        'direct_connect_flag' => 1,
                        'hris_connect_flag' => 1,
                        'api_connect_flag' => 1
                    ]);
                    break;
                default:
                    break;
            }
        } else {
            $cur_data = CUR_table::Insert([
                'id' => $newId,
                'user_type' => $user->user_type,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'DOB' => $birthday,
                'country' => $request->country,
                'nationality' => $request->nationality,
                'ma_HBN' => $request->ma_HBN,
                'ma_street' => $request->ma_street,
                'ma_town_or_city' => $request->ma_town_or_city,
                'ma_postcode' => $request->ma_postcode,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        if($this->send_email($user)) {
            $from_email = Country_spec_info::value('server_email');
            //// user info and mail send ///
            $address = 'notification@convey.ac';
            $first_name = !is_null($request->firstname) ? $request->firstname : $request->lrd_firstname;
            $last_name = !is_null($request->lastname) ? $request->lastname : $request->lrd_lastname;;
            $full_name = $first_name.' '.$last_name;
            $content['content'] = "<span style='font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;'>
                                    A new account was just created.<br>The information is as follows: <br>&emsp;Country name: ".$country_name."<br>&emsp;User Type: ".$request->user_type."<br>&emsp;User Name: ".$full_name.". <br>Thanks.</span><br>";
            $title = 'A new account has been created.';
            $subject = '';

            Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });

            return response()->json(array('link' => url('/').'/login_redirect/'.$newId));
        }

        return response()->json(array('link' => url('/').'/login_redirect/'.$newId));
    }

    public function send_email($user)
    {
        $data = Email::find('1');

        if(!$data) return false;
        $address = $user->email;

        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                       <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                          <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                       </font>
                    </a>';

        $link_url = url('/').'/confirm_email/'.$user->token_key;
        $button = str_replace('{link_url}', $link_url , $button);
        $button = str_replace('{button_name}', 'Confirm Button' , $button);
        $userId = User::where('token_key',$user->token_key)->get()[0]->id;
        $data->content = str_replace("[button]", $button, $data->content);

        if($user->user_type == 'citizen') {
            $user_data = CUR_table::find($userId);
            $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
        } else {
            $cbr_data = CBR_table::find($userId);

            $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
        }

        $data->content = str_replace("[name_here]",$full_name,$data->content);
        $title = $full_name;
        $subject = $data->subject;
        $from_email = $data->from_email_address;
        $content['content'] = $data->content;

        try {
            Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });
        } catch (\Exception $e) {
            return false;
        }

        if($user->referrer_CBR_id != '') {
            $data = Email::find('132');
            $referrer_user = User::find($user->referrer_CBR_id);

            $title = $data->title;
            $from_email = $data->from_email_address;

            $subject = $data->subject;
            $to_email = $referrer_user->email;
            $content['content'] = $data->content;
            Mail::send('mail.email_template', $content, function($message) use ($to_email, $from_email, $title, $subject) {
                $message->to($to_email, $title)->subject($subject);
                $message->from($from_email);
            });
        }

        return true;
    }


    public function week_start_date()
    {
        // dd(ap()->getLocale());
        $last_week = Cohort::latest('week_start_date')->first();
        $dt_min = new \DateTime("last saturday"); // Edit
        $dt_min->modify('+1 day');
        $week_start_date = $dt_min->format('Y-m-d');
        $maxData = \DB::select('SELECT MAX(CAST(SUBSTRING(cohort_id, 3, length(cohort_id)-2) AS INT)) AS MaxNum FROM k_cohort');

        if(count($maxData)>0) {
            $maxId = $maxData[0]->MaxNum;
        } else {
            $maxId = 0;
        }

        $newId1 = Country_spec_info::value('country_ID').strval($maxId+1);
        $newId2 = Country_spec_info::value('country_ID').strval($maxId+2);
        $newId3 = Country_spec_info::value('country_ID').strval($maxId+3);
        $newId4 = Country_spec_info::value('country_ID').strval($maxId+4);

        if($last_week==null || $last_week->week_start_date != $week_start_date) {
            Cohort::Insert(array('cohort_id'=>$newId1,'week_start_date' => $week_start_date,'Type_of_cohort' => 'business'));
            Cohort::Insert(array('cohort_id'=>$newId2,'week_start_date' => $week_start_date,'Type_of_cohort' => 'advisors'));
            Cohort::Insert(array('cohort_id'=>$newId3,'week_start_date' => $week_start_date,'Type_of_cohort' => 'citizen'));
            Cohort::Insert(array('cohort_id'=>$newId4,'week_start_date' => $week_start_date,'Type_of_cohort' => 'hris'));
        }

        return $week_start_date;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'unique:users|required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function get_guide_temp(Request $request)
    {
        $data = Guide::where('flag', $request->item.'_'.$request->user_type)->first()->content;

        return response()->json($data);
    }

    public function departure_form($request_id)
    {
        $qa_record_list = RecordTypeMode::where('record_type_id', '5')
            ->where('status', 1)
            ->get();

        $record_title = RecordType::where('id', '5')->first()->record_type;

        $qa_info = "";
        $i = 0;
        foreach($qa_record_list as $qa_record_info) {
            $i++;
            if(isset($qa_record_info['answer_text'])) {
                $qa_info .= '<p contentEditable="false">Q: '.$qa_record_info['question_name'].'</p>'.$qa_record_info['answer_text'];
            }
            else {
                $qa_info .= '<p contentEditable="false" class="mb-0">Q: '.$qa_record_info['question_name'].'</p><p >A:</p>';
            }
        }

        $request_info = Request_dep_eva_history::findOrFail($request_id);

        if($request_info) {
            $request_status = $request_info->status;
            $business_name = $request_info->business_name;
            $employee_name = $request_info->applicant_name;
        } else {
            $request_status = '1';
            $business_name = '';
            $employee_name = '';
        }

        return view('front.departure_form', compact('qa_info', 'record_title', 'request_id', 'request_status', 'business_name', 'employee_name'));
    }

    public function departure_evaluation_add(Request $request)
    {
        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id) - 2) AS int)) AS MaxNum
                                FROM (  SELECT id FROM l_record_databank_temp
                                        UNION ALL
                                        SELECT id FROM m_record_databank_perm
                                    ) a')[0]->MaxNum;

        if($maxId=='') $maxId = 7145678;

        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);
        $employee_info = Request_dep_eva_history::findOrFail($request->request_id);

        $form_data = array(
            'id' => $newId,
            'CBR_id' => 'IT000000',
            'Branch' => $request->business_name,
            'API_activity_ID' => $request->employee_name,
            'NI_identity_number' => CommonController::EncryptNI($employee_info->gov_number),
            'DOB' => $employee_info->dob,
            'record_type' => 'Departure Evaluation',
            'record_date' => date('Y-m-d H:i:s'),
            'connection_type' =>'guest',
            'RECORD_content'=> $request->RECORD_content,
            'parent_id' => '0',
            'time_stamp' => date('Y-m-d H:i:s'),
            'version' => '1',
            'IP_address' => $_SERVER['REMOTE_ADDR'],
            'status' => null,
        );

        RDB_perm::Insert($form_data);
        // $RDB_id = DB::getPDO()->lastInsertId();
        $record_history_data = array(
            'id' => $newId,
            'NI_identity_number' => CommonController::EncryptNI($employee_info->gov_number),
            'record_date' => date('Y-m-d H:i:s'),
            'record_type_id' => '5',
            'content' => $request->RECORD_content,
            'time_stamp'=>date('Y-m-d H:i:s'),
            'created_at'=>date('Y-m-d H:i:s'),
        );
        RecordHistory::Insert($record_history_data);

        if(!is_null($employee_info->branch_id)) {
            $user = Branch::findOrFail($employee_info->branch_id);
            $to_email = $user->branch_email;
        } else {
            $user = User::findOrFail($employee_info->CBR_id);
            $to_email = $user->email;
        }

        $cbr_info = CBR_table::findOrFail($employee_info->CBR_id);

        $data = Email::find('162');

        $email_address = $employee_info->receiver_email;
        $applicant_name = $employee_info->applicant_name;
        $business_name = $employee_info->business_name;

        if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $employee_info->id)) {
            $data = Email::find('164');
            $to_email = $employee_info->receiver_email;
            $business_name = $cbr_info->ocb_name;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $employee_info->id)) {
                $request_dep = Request_dep_eva_history::find($employee_info->id);
                $request_dep->status = '2';
                $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                $request_dep->update();
            }

        }

        return response()->json(['success' => 'Record Created successfully.']);
    }


    public function request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)
    {
        if(!$data) return false;

        $data->content = str_replace("[applicants_name]", $applicant_name, $data->content);
        $data->content = str_replace("[business_name]", $business_name, $data->content);
        $data->content = str_replace("[email_address]", $email_address, $data->content);

        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                           </font>
                        </a> ';
        $link_url = url('/').'/departure_form/'.$request_id;
        $button = str_replace('{link_url}', $link_url , $button);
        $button = str_replace('{button_name}', 'Form Button' , $button);

        $data->content = str_replace("[form_button]", $button, $data->content);

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

    public function more($id)
    {
        $gallery_info = Gallery::where('id', $id)->first();
        $recommend_info = Gallery::where('is_recommend', 1)->first();

        return view('front.detail_more', compact('gallery_info', 'recommend_info'));
    }

    public function gallery()
    {
        return view('front.more');
    }

    public function send_contact_message(Request $request)
    {
        require_once base_path().'/vendor/securimage/securimage.php';

        $securimage = new \Securimage();

        if ($securimage->check($request->captcha_code) == false) {
            return response()->json(['status' => 'Captcha code incorrect. Please try again!']);
//            return redirect()->back()->withInput()->with('captch_error', 'Captcha code incorrect. Please try again!');
        }

        $from_email = Country_spec_info::value('server_email');
        $address = 'admin@convey.ac';
        $subject = '';
        $from_email = 'noreply@convey.ac';
        $content['content'] = "<span style='font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;'>
                                    Name: ".$request->user_name.".<br>Email: ".$request->user_email.".<br>Phone Number: ".$request->user_number.".<br>Message: ".$request->user_message;
        $title = '';

        try {
            Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });
        } catch (\Exception $e) {
            return response()->json(['status' => 'Sever error']);
        }

        return response()->json(['status' => 'Message Sent']);
    }

    public function frontend_downloadable_file($id)
    {
        $file_name = '';

        switch ($id) {
            case 'convey_colour_logo':
                $file_name = "convey-colour-logo.png";
                break;
            case 'convey_black_logo':
                $file_name = "convey-black-logo.png";
                break;
            case 'convey_white_logo':
                $file_name = "convey-white-logo.png";
                break;
            case 'press_logo':
                $file_name = "logos.zip";
                break;
            case 'press_screen_shot':
                $file_name = "screen_shots.zip";
                break;
            case 'press_header_images':
                $file_name = "article_headers.zip";
                break;

        }

        $file_path = url('public/download/landing_page/'.$file_name);

        $tempImage = tempnam(sys_get_temp_dir(), $file_name);
        copy($file_path, $tempImage);

        return response()->download($tempImage, $file_name);
    }
}
