<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Auth;
use Mail;
use App\CBR_table;
use App\CUR_table;
use App\MangopayKyc;
use App\User;
use App\Email;
use App\Country_spec_info;

use App\Global_link;
use App\Country_list;
use App\Cohort;
use App\Branch;
use App\Rating_history;
class SettingsController extends Controller
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
        $user_info = CBR_table::where('id',Auth::user()->id)->first();

        return view('front.advisors.settings', compact('user_info'));
    }

    public function view_example_site()
    {
        return view('front.view_example_site');
    }

    public function auto_save_email(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->email = $request->email;
        $user->save();

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function validation_email_duplication(Request $request)
    {
        $email_verify = Branch::where('branch_id', '!=', $request->branch_id)->where('branch_email', $request->email)->exists();

        if($email_verify == false) {
            $email_verify = User::where('email', $request->email)->exists();

        }

        return response()->json(['status' => $email_verify]);
    }

    public function save_rate_record(Request $request)
    {
        $rating_history = DB::table('rating_history')
                                ->where('current_business_id', Auth::user()->id)
                                ->where('previous_business_id', $request->cbr_id)
                                ->where('NI_number', $request->NI_number)
                                ->where('current_rating_flag', '1')
                                ->update(['rating_number' => $request->rating_number, 'rated_date' => date('Y-m-d H:i:s')]);

        return response()->json(['status' => 'success']);
    }

    public function account_details_update(Request $request)
    {
        $lrd_DOB = date('Y-m-d', strtotime($request->lrd_DOB));
        $CBR_table = CBR_table::whereId(Auth::user()->id)->first();

        if(Auth::user()->business_type == 'organisation')
        {
            $rules = array(
                'ocb_name'     =>  'required',
                'lrd_firstname'     =>  'required',
                'lrd_lastname'     =>  'required',
                'lrd_DOB' => 'required',
                'lrd_country' => 'required',
                'lrd_nationality' => 'required',
                'ma_HBN' => 'required',
                'ma_street' => 'required',
                'ma_town_or_city' => 'required',
                'ma_postcode' => 'required',
            );

            $form_data = array(
                'id' => Auth::user()->id,
                'ocb_name'     => $request->ocb_name,
                'company_ma_HBN' => $request->company_ma_HBN,
                'company_ma_street' => $request->company_ma_street,
                'company_ma_town_or_city' => $request->company_ma_town_or_city,
                'company_ma_postcode' => $request->company_ma_postcode,
                'VAT_if_registered'     => $request->VAT_if_registered,
                'lrd_firstname'     =>  $request->lrd_firstname,
                'lrd_lastname'     =>  $request->lrd_lastname,
                'lrd_DOB' => $lrd_DOB,
                'lrd_country' => $request->lrd_country,
                'lrd_nationality' => $request->lrd_nationality,
                'ma_HBN' => $request->ma_HBN,
                'ma_street' => $request->ma_street,
                'ma_town_or_city' => $request->ma_town_or_city,
                'ma_postcode' => $request->ma_postcode,
            );

        }

        if(Auth::user()->business_type == 'company')
        {
            $rules = array(
                'ocb_name'     =>  'required',
                'company_no' => 'required',
                'company_ma_HBN' => 'required',
                'company_ma_street' => 'required',
                'company_ma_town_or_city' => 'required',
                'lrd_firstname'     =>  'required',
                'lrd_lastname'     =>  'required',
                'lrd_DOB' => 'required',
                // 'lrd_birth_city' => 'required',
                // 'lrd_birth_country' => 'required',
                'lrd_country' => 'required',
                'lrd_nationality' => 'required',
                'ma_HBN' => 'required',
                'ma_street' => 'required',
                'ma_town_or_city' => 'required',
                'ma_postcode' => 'required',
            );

            $form_data = array(
                'id' => Auth::user()->id,
                'ocb_name'     => $request->ocb_name,
                'company_no' => $request->company_no,
                'company_ma_HBN' => $request->company_ma_HBN,
                'company_ma_street' => $request->company_ma_street,
                'company_ma_town_or_city' => $request->company_ma_town_or_city,
                'company_ma_postcode' => $request->company_ma_postcode,
                'VAT_if_registered'     => $request->VAT_if_registered,
                'lrd_firstname'     =>  $request->lrd_firstname,
                'lrd_lastname'     =>  $request->lrd_lastname,
                'lrd_DOB' => $lrd_DOB,
                // 'lrd_birth_city' => $request->lrd_birth_city,
                // 'lrd_birth_country' => $request->lrd_birth_country,
                'lrd_country' => $request->lrd_country,
                'lrd_nationality' => $request->lrd_nationality,
                'ma_HBN' => $request->ma_HBN,
                'ma_street' => $request->ma_street,
                'ma_town_or_city' => $request->ma_town_or_city,
                'ma_postcode' => $request->ma_postcode,
            );

        }

        if(Auth::user()->business_type == 'selfemployed')
        {
            $rules = array(
                'lrd_firstname'     =>  'required',
                'lrd_lastname'     =>  'required',
                'lrd_DOB' => 'required',
                'lrd_country' => 'required',
                'lrd_nationality' => 'required',
                'ma_HBN' => 'required',
                'ma_street' => 'required',
                'ma_town_or_city' => 'required',
                'ma_postcode' => 'required',
            );

            $form_data = array(
                'id' => Auth::user()->id,
                'VAT_if_registered'     => $request->VAT_if_registered,
                'ocb_name'     => $request->ocb_name,
                'lrd_firstname'     =>  $request->lrd_firstname,
                'lrd_lastname'     =>  $request->lrd_lastname,
                'lrd_DOB' => $lrd_DOB,
                'lrd_country' => $request->lrd_country,
                'lrd_nationality' => $request->lrd_nationality,
                'ma_HBN' => $request->ma_HBN,
                'ma_street' => $request->ma_street,
                'ma_town_or_city' => $request->ma_town_or_city,
                'ma_postcode' => $request->ma_postcode,
            );
        }

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        CBR_table::whereId(Auth::user()->id)->update($form_data);
        $response_array['success'] = 'Data is successfully updated';

        return response()->json($response_array);
    }

    public function account_settings_update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if(strpos($request->password, '********') === false){
            $user->password = Hash::make($request->password);
            $this->send_email($user);
        }

        $user->email = $request->email;
        $user->hris_type = $request->hris_type;
        $user->save();

        $business = CBR_table::find(Auth::user()->id);

        $business->market = $request->market;
        $business->employees = $request->employees;
        $business->hris_type = $request->hris_type;

        if($user->user_type == 'business' || $user->advisors_type == 'writer') {
            $business->website = $request->website;
        }

        if(isset($request->direct_connect)) {
            $business->direct_connect_flag = 1;
        } else {
            $business->direct_connect_flag = 0;
        }

        if(isset($request->hris_connect)) {
            $business->hris_connect_flag = 1;
        } else {
            $business->hris_connect_flag = 0;
        }

        if(isset($request->api_connect)) {
            $business->api_connect_flag = 1;
        } else {
            $business->api_connect_flag = 0;
        }

        $business->save();

        return response()->json(['success' => 'Data is successfully updated', 'approve_status' => $business->Approved_to_list]);
    }

    public function update_hris_list_service(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $business = CBR_table::find(Auth::user()->id);

        $change_status = true;

        if($request->update_flag) {
            if($business->website == $request->website
                && $business->pre_email == $request->pre_email
                && $business->tech_email == $request->tech_email) {

                if(!$request->file('hris_guide')
                    && !is_null($business->hris_guide)
                    && !$request->file('logo')
                    && !is_null($business->Logo)) {

                    $change_status = false;
                }

            }
        }

        $business->website = $request->website;
        $business->pr_email = $request->pr_email;
        $business->tech_email = $request->tech_email;

        if($request->file('hris_guide'))
        {
            if(!is_null($business->hris_guide))
            {
                Storage::disk('file_upload')->delete($business->hris_guide);
            }

            $fileName = Storage::disk('file_upload')->put('hris_guide', $request->file('hris_guide'));
            $business->hris_guide = $fileName;
        }

        if($request->file('logo'))
        {
            if(!is_null($business->Logo))
            {
                Storage::disk('file_upload')->delete($business->logo);
            }

            $fileName = Storage::disk('file_upload')->put('hris_logo', $request->file('logo'));
            $business->Logo = $fileName;
        }

        if($request->update_flag) {
            if($request->update_flag == 'hris_list_service') {
                if(!is_null($business->website) &&
                    !is_null($business->hris_guide) &&
                    !is_null($business->pr_email) &&
                    !is_null($business->tech_email) &&
                    !is_null($business->Logo) &&
                    ($business->Approved_to_list != 'Listed'))
                {
                    $business->Approved_to_list = 'Ready';
                }
            }
        }

        if($change_status == true) {
            $business->Approved_to_list = null;
        }

        $business->save();

        if($request->update_flag) {
            if($request->update_flag == 'hris_list_service') {
                if (!is_null($business->website) &&
                    !is_null($business->hris_guide) &&
                    !is_null($business->pr_email) &&
                    !is_null($business->tech_email) &&
                    !is_null($business->Logo) && ($business->Approved_to_list == 'Ready')) {

                    $from_email = Country_spec_info::value('server_email');
                    $country_name = Country_spec_info::value('country_name');
                    //// user info and mail send ///
                    $address = 'platforms@convey.ac';
                    $content['content'] = "<span style='font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;'>
                                    A new HRIS account is ready to approve in " . $country_name . ".<br>Thanks.</span><br>";
                    $title = 'A new account needs approving.';
                    $subject = 'A new account needs approving.';

                    try {
                        Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                            $message->to($address, $title)->subject($subject);
                            $message->from($from_email);
                        });
                    } catch (\Exception $e) {
                        return response()->json(['errors' => 'Not send an email']);
                    }

                }

            }
        }

        return response()->json(['success' => 'Data is successfully updated', 'approve_status' => $business->Approved_to_list]);
    }

    public function update_advisor_list_service(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $business = CBR_table::find(Auth::user()->id);

        $change_status = true;

        if($request->update_flag) {
            if($business->website == $request->website) {
                $change_status = false;
            }
        }

        $business->website = $request->website;

        if($request->update_flag) {
            if($request->update_flag == 'advisor_list_service') {
                if(!is_null($business->website) && ($business->Approved_to_list != 'Listed')) {
                    $business->Approved_to_list = 'Ready';
                }
            }
        }

        if($change_status == true) {
            $business->Approved_to_list = null;
        }

        $business->save();

        if($request->update_flag) {
            if($request->update_flag == 'advisor_list_service') {
                if(!is_null($business->website) && !is_null(Auth::user()->advisors_type) && ($business->Approved_to_list == 'Ready'))
                {
                    $from_email = Country_spec_info::value('server_email');
                    $country_name = Country_spec_info::value('country_name');
                    //// user info and mail send ///
                    $address = 'professionals@convey.ac';
                    $content['content'] = "<span style='font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;'>
                                    A new Advisor account is ready to approve in ".$country_name.".<br>Thanks.</span><br>";
                    $title = 'A new account needs approving.';
                    $subject = 'A new account needs approving.';

                    try {
                        Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                            $message->to($address, $title)->subject($subject);
                            $message->from($from_email);
                        });
                    } catch (\Exception $e) {
                        return response()->json(['errors' => 'Not send an email']);
                    }
                }
            }

        }

        return response()->json(['success' => 'Data is successfully updated', 'approve_status' => $business->Approved_to_list]);
    }

    public function resend_email(Request $request)
    {
        $user = Auth::user();
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
        $button = str_replace('{button_name}', 'Confirm Button', $button);
        $userId = User::where('token_key', $user->token_key)->get()[0]->id;
        $data->content = str_replace("[button]", $button, $data->content);

        if($user->user_type == 'citizen') {
            $user_data = CUR_table::find($userId);
            $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
        } else {
            $cbr_data = CBR_table::find($userId);
            $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
        }

        $data->content = str_replace("[name_here]", $full_name, $data->content);
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

            return response()->json(['errors' => 'Not send an email']);
        }

        return response()->json(['status' => 'Signup Email send Successfully!']);
    }

    public function send_email($user)
    {
        $data = Email::find('5');

        if(!$data) return false;

        $address = $user->email;

        if($user->user_type == 'citizen') {
            $user_data = CUR_table::find($user->id);
            $full_name = $user_data->firstname.' '.$user_data->lastname;
        } else {
            $cbr_data = CBR_table::find($user->id);
            $full_name = $cbr_data->lrd_firstname.' '.$cbr_data->lrd_lastname;
        }

        $data->content = str_replace("[name_here]", $full_name, $data->content);
        $title = $full_name;
        $subject = $data->subject;
        $content['content'] = $data->content;
        $from_email = $data->from_email_address;

        try {
            Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                $message->to($address, $title)->subject($subject);
                $message->from($from_email);
            });
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function getting_started_download($id)
    {
        $file_name = '';

        switch ($id) {
            case 'convey_for_employee':
                $file_name = "introduction_convey_for_employee.pdf";
                break;
            case 'faq_for_employee':
                $file_name = "introduction_faq_for_employee.pdf";
                break;
            case 'direct_connect_example':
                $file_name = "direct_connect_example.pdf";
                break;
            case 'hris_connect_example':
                $file_name = "hris_connect_example.pdf";
                break;
            case 'api_connect_example':
                $file_name = "api_connect_example.pdf";
                break;
            case 'convey_for_manager':
                $file_name = "introduction_convey_for_manager.pdf";
                break;
            case 'branches_for_manager':
                $file_name = "introduction_branches_for_manager.pdf";
                break;
            case 'faq_for_manager':
                $file_name = "introduction_faq_for_manager.pdf";
                break;
            case 'convey_image':
                $file_name = "convey_image.png";
                break;
            case 'convey_banner':
                $file_name = "convey_banner.png";
                break;
            case 'guide_a1':
                $file_name = "guide_a1.pdf";
                break;
            case 'guide_a2':
                $file_name = "guide_a2.pdf";
                break;
            case 'guide_b1':
                $file_name = "guide_b1.pdf";
                break;
            case 'guide_b2':
                $file_name = "guide_b2.pdf";
                break;
            case 'guide_c1':
                $file_name = "guide_c1.pdf";
                break;
            case 'guide_c2':
                $file_name = "guide_c2.pdf";
                break;
            case 'guide_d1':
                $file_name = "guide_d1.pdf";
                break;
            case 'guide_d2':
                $file_name = "guide_d2.pdf";
                break;
            case 'guide_e1':
                $file_name = "guide_e1.pdf";
                break;
            case 'guide_e2':
                $file_name = "guide_e2.pdf";
                break;
            case 'guide_f1':
                $file_name = "guide_f1.pdf";
                break;
            case 'guide_f2':
                $file_name = "guide_f2.pdf";
                break;
            case 'decision_tree_diagram':
                $file_name = "decision_tree_diagram.pdf";
                break;

        }

        $file_path = url('public/download/get_start/'.$file_name);

        $tempImage = tempnam(sys_get_temp_dir(), $file_name);
        copy($file_path, $tempImage);

        return response()->download($tempImage, $file_name);
    }

    public function active_country()
    {
        if(Global_link::max('global_id')) {
            $global_id = Global_link::max('global_id') + 1;
        } else {
            $global_id = 1;
        }

        $user_id = Auth::user()->id;
        $global_link = new Global_link();
        $global_link->country_code = app()->getLocale();
        $global_link->user_id = $user_id;
        $global_link->global_id = $global_id;
        $global_link->save();

        CBR_table::where('id', $user_id)->update(['global_link_id' => $global_id]);

        return response()->json(['status' => 'success']);

    }

    public function send_country_email($user, $short_country_name)
    {
        $data = Email::find('1');

        if(!$data) return false;
        $address = $user->email;

        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                       <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                          <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                       </font>
                    </a>';

        $base_url = substr(url('/'), 0, strlen(url('/')) - 2).$short_country_name;
        $link_url = $base_url.'/confirm_email/'.$user->token_key;
        $button = str_replace('{link_url}', $link_url , $button);
        $button = str_replace('{button_name}', 'Confirm Button' , $button);
        $userId = User::where('token_key', $user->token_key)->get()[0]->id;
        $data->content = str_replace("[button]", $button, $data->content);

        $cbr_data = CBR_table::find($userId);

        $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

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

    public function active_other_country(Request $request)
    {
        $global_id = Global_link::where('country_code', app()->getLocale())
            ->where('user_id', Auth::user()->id)
            ->first()->global_id;
        $current_user = Auth::user();
        $current_cbr = CBR_table::where('id', $current_user->id)->first();

        CBR_table::set_database_name($request->country_code);

        $user = new User;
        $country_name = Country_spec_info::value('country_name');
        $short_country_name = strtolower(Country_spec_info::value('country_ID'));

        if(User::count() == 0) {
            $newId = Country_spec_info::value('country_ID').Country_spec_info::value('CUR_CBR_starting_number');
            $user->id = $newId;
        } else {
            $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id) - 2) AS int)) AS MaxNum FROM users')[0]->MaxNum;
            $newId = Country_spec_info::value('country_ID').strval($maxId + 1);
            $user->id = $newId;
        }

        $user->user_type = $current_user->user_type;

        if($current_user->user_type == 'hris'){
            $user->hris_type = $current_user->hris_type;
        }
        if($current_user->user_type == 'advisors'){
            $user->advisors_type = $current_user->advisors_type;
        }

        /*   cohort id and referral code */
        $date = $this->week_start_date();

        if($date) {
            $cohort_id = Cohort::where(['week_start_date' => $date, 'Type_of_cohort' => $user->user_type])->first()->cohort_id;
        }

        /*  Invite code  */
        $refferre_CBR_id = '';

        $user->signup_date = date('Y-m-d H:i:s');
        $user->email = $current_user->email;
        $user->password = $current_user->password;
        $user->cohort_id = $cohort_id;
        $user->referrer_CBR_id = $refferre_CBR_id;
        $user->token_key = md5(time().Str::random(6));
        $user->business_type = $current_user->business_type;
        $user->origin_user_flag = 1;

        $user->save();

        $business = new CBR_table;
        $business->id = $newId;
        $business->user_type = $user->user_type;
        $business->hris_type = $user->hris_type;
        $business->business_type = $current_cbr->business_type;
        $business->market = $current_cbr->market;
        $business->employees = $current_cbr->employees;
        $business->save();

        switch ($current_cbr->business_type) {
            case 'organisation':
            {
                $cbr_data = CBR_table::Where('id', $newId)->update([
                    'ocb_name' => $current_cbr->ocb_name,
                    'VAT_if_registered' => $current_cbr->VAT_if_registered,
                    'lrd_firstname' => $current_cbr->lrd_firstname,
                    'lrd_lastname' => $current_cbr->lrd_lastname,
                    'lrd_DOB' => $current_cbr->lrd_DOB,
                    'lrd_country' => $current_cbr->lrd_country,
                    'lrd_nationality' => $current_cbr->lrd_nationality,
                    'ma_HBN' => $current_cbr->ma_HBN,
                    'ma_street' => $current_cbr->ma_street,
                    'ma_town_or_city' => $current_cbr->ma_town_or_city,
                    'ma_postcode' => $current_cbr->ma_postcode,

                    'company_lrd_country' => $current_cbr->company_lrd_country,
                    'company_ma_HBN' => $current_cbr->company_ma_HBN,
                    'company_ma_street' => $current_cbr->company_ma_street,
                    'company_ma_town_or_city' => $current_cbr->company_ma_town_or_city,
                    'company_ma_postcode' => $current_cbr->company_ma_postcode,
                    'website' => $current_cbr->website,

                    'direct_connect_flag' => $current_cbr->direct_connect_flag,
                    'hris_connect_flag' => $current_cbr->hris_connect_flag,
                    'api_connect_flag' => $current_cbr->api_connect_flag
                ]);
                break;
            }

            case 'selfemployed':
                $cbr_data = CBR_table::Where('id', $newId)->update([
                    'ocb_name' => $current_cbr->ocb_name,
                    'VAT_if_registered' => $current_cbr->VAT_if_registered,
                    'lrd_firstname' => $current_cbr->lrd_firstname,
                    'lrd_lastname' => $current_cbr->lrd_lastname,
                    'lrd_DOB' => $current_cbr->lrd_DOB,
                    'lrd_country' => $current_cbr->lrd_country,
                    'lrd_nationality' => $current_cbr->lrd_nationality,
                    'ma_HBN' => $current_cbr->ma_HBN,
                    'ma_street' => $current_cbr->ma_street,
                    'ma_town_or_city' => $current_cbr->ma_town_or_city,
                    'ma_postcode' => $current_cbr->ma_postcode,
                    'website' => $current_cbr->website,

                    'direct_connect_flag' => $current_cbr->direct_connect_flag,
                    'hris_connect_flag' => $current_cbr->hris_connect_flag,
                    'api_connect_flag' => $current_cbr->api_connect_flag
                ]);
                break;
            case 'company':
                $cbr_data = CBR_table::Where('id', $newId)->update([
                    'ocb_name' => $current_cbr->ocb_name,
                    'company_no' => $current_cbr->company_no,
                    'VAT_if_registered' => $current_cbr->VAT_if_registered,
                    'lrd_firstname' => $current_cbr->lrd_firstname,
                    'lrd_lastname' => $current_cbr->lrd_lastname,
                    'lrd_DOB' => $current_cbr->lrd_DOB,
                    'lrd_country' => $current_cbr->lrd_country,
                    'lrd_nationality' => $current_cbr->lrd_nationality,
                    'ma_HBN' => $current_cbr->ma_HBN,
                    'ma_street' => $current_cbr->ma_street,
                    'ma_town_or_city' => $current_cbr->ma_town_or_city,
                    'ma_postcode' => $current_cbr->ma_postcode,
                    'company_lrd_country' => $current_cbr->company_lrd_country,
                    'company_ma_HBN' => $current_cbr->company_ma_HBN,
                    'company_ma_street' => $current_cbr->company_ma_street,
                    'company_ma_town_or_city' => $current_cbr->company_ma_town_or_city,
                    'company_ma_postcode' => $current_cbr->company_ma_postcode,
                    'website' => $current_cbr->website,

                    'direct_connect_flag' => $current_cbr->direct_connect_flag,
                    'hris_connect_flag' => $current_cbr->hris_connect_flag,
                    'api_connect_flag' => $current_cbr->api_connect_flag
                ]);
                break;
            default:
                break;
        }

        CBR_table::set_default_database_name();

        $global_link = new Global_link();
        $global_link->country_code = $request->country_code;
        $global_link->user_id = $newId;
        $global_link->global_id = $global_id;
        $global_link->save();

        CBR_table::set_database_name($request->country_code);

        CBR_table::where('id', $newId)->update(['global_link_id' => $global_id]);

        if($this->send_country_email($user, $short_country_name)) {
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

            try {
                Mail::send('mail.email_template', $content, function ($message) use ($address, $from_email, $title, $subject) {
                    $message->to($address, $title)->subject($subject);
                    $message->from($from_email);
                });
            } catch (\Exception $e) {
                return response()->json(['errors' => 'Not send an email']);
            }

        }

        CBR_table::set_default_database_name();

        return response()->json(['status' => 'success', 'user_id' => $newId]);

    }
}
