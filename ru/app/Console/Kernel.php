<?php

namespace App\Console;

use App\Replacement_number_table;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Email;
use App\User;
use App\Country_spec_info;
use App\Invite_code;
use App\RDB_perm;
use App\RDB;
use App\RecordHistory;
use App\PaymentsReceived;
use App\CBR_table;
use App\CUR_table;
use App\TestData;
use App\Request_dep_eva_history;
use App\Branch;
use Illuminate\Support\Facades\Log;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function () {
        $this->AutoRemoveTestRecord();
        $this->AutoRemoveReplacementHistory();
        $this->AutoRemoveAPIErrorRecord();
        $this->confirm_email();
        $this->invite_code_email();
        $this->citizen_signup_email();
        $this->business_email();
        $this->hris_email();
        $this->advisor_d_email();
        $this->advisor_a_email();
        $this->advisor_w_email();
        $this->credit_email('business');
        $this->credit_email('advisor');
        $this->invite_sender_email('universal');
        $this->invite_sender_email('unique');
        $this->invite_sender_email('both');
        $this->record_lock();
        $this->request_dep_eva();
//        });
//  Log::info(PaymentsReceived::where('referrer_CBR_id',$user->id)->count());
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    public function email_send($data, $address, $full_name, $from_email)
    {
        $title = $full_name;
        $subject = $data->subject;

        $content['content'] = $data->content;

        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }

    private function getFullName($user)
    {
        $full_name = '';

        if($user->user_type == 'citizen') {
            $user_data = CUR_table::find($user->id);
//            $full_name = $user_data->firstname.' '.$user_data->lastname;
            $full_name = ucwords($user_data->firstname);
        } else {
            $cbr_data = CBR_table::find($user->id);

            if($cbr_data) {
                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
            }
        }

        return $full_name;
    }

    private function getBusinessName($user)
    {
        $business_name = '';
        $cbr_data = CBR_table::find($user->id);

        if($cbr_data) {
            $business_name = $cbr_data->ocb_name;
        }

        return $business_name;
    }

    public function confirm_email()
    {
        $now = date('Y-m-d H:i:s');
        $data = User::where('email_verify',null)->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))->get();

        foreach ($data as $key => $value) {
            $user = User::find($value->id);
            // $user->email_verify = '0';
            // $user->update();

            $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                           </font>
                        </a> ';
            $link_url = url('/').'/confirm_email/'.$user->token_key;
            $button = str_replace('{link_url}', $link_url , $button);
            $button = str_replace('{button_name}', 'Confirm Button' , $button);

            $data = Email::find('2');

            $data->content = str_replace("[button]",$button,$data->content);

            $full_name = $this->getFullName($user);
            $data->content = str_replace("[name_here]",$full_name,$data->content);
            $from_email = $data->from_email_address;
            $content['content'] = $data->content;
            if($this->email_send($data, $user->email, $full_name, $from_email))
            {
                $user->email_verify = '0';
                $user->update();
            }
        }
        return true;
    }

    public function invite_code_email()
    {
        $now = date('Y-m-d H:i:s');
        $invite_day1 = Email::find('13')->rule;

        $data1 = Invite_code::where('code_type', '1')
            ->where('used_by_CBR_id', null)
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day1)." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day1 + 1)." days")))
            ->get();

        foreach ($data1 as $key => $value) {
            $already_sign_user = User::where('email', $value->assigned_to)->get();

            if(is_null($already_sign_user)) {
                continue;
            }

            $user = User::find($value->generated_by_CBR_id);

            $invite_code = Invite_code::find($value->id);
            $invite_code->reminder_sent_on = $now;
            $invite_code->update();

            $full_name = '';
            $referrer_name = $this->getBusinessName($user);
            $data = Email::find('13');
            $data->content = str_replace("[invite_code]", $invite_code->invite_code, $data->content);
            $data->content = str_replace("[referrer_name]", $referrer_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $value->assigned_to, $full_name, $from_email);
        }

        $invite_day2 = Email::find('14')->rule;
        $data2 = Invite_code::where('code_type', '1')
            ->where('used_by_CBR_id', null)
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day2)." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day2 + 1)." days")))
            ->get();

        foreach ($data2 as $key2 => $value2) {
            $already_sign_user = User::where('email', $value2->assigned_to)->get();

            if(is_null($already_sign_user)) {
                continue;
            }

            $user = User::find($value2->generated_by_CBR_id);

            $invite_code = Invite_code::find($value2->id);
            $invite_code->reminder_sent_on = $now;
            $invite_code->update();

            $full_name = '';
            $referrer_name = $this->getBusinessName($user);
            $data = Email::find('14');
            $data->content = str_replace("[invite_code]", $invite_code->invite_code, $data->content);
            $data->content = str_replace("[referrer_name]", $referrer_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $value2->assigned_to, $full_name, $from_email);
        }

        $invite_day3 = Email::find('15')->rule;
        $data3 = Invite_code::where('code_type','1')
            ->where('used_by_CBR_id',null)
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day3)." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day3 + 1)." days")))
            ->get();

        foreach ($data3 as $key3 => $value3) {
            $already_sign_user = User::where('email', $value3->assigned_to)->get();

            if(is_null($already_sign_user)) {
                continue;
            }

            $user = User::find($value3->generated_by_CBR_id);

            $invite_code = Invite_code::find($value3->id);
            $invite_code->reminder_sent_on = $now;
            $invite_code->update();

            $full_name = '';
            $referrer_name = $this->getBusinessName($user);
            $data = Email::find('15');
            $data->content = str_replace("[invite_code]", $invite_code->invite_code, $data->content);
            $data->content = str_replace("[referrer_name]", $referrer_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $value3->assigned_to, $full_name, $from_email);
        }

        return true;
    }

    public function invite_sender_email($flag)
    {
        $now = date('Y-m-d H:i:s');
        if($flag == 'universal') {
            $data2 = Invite_code::where('code_type', '2')
                ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
                ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-11 days")))
                ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
                ->get();

            foreach ($data2 as $key2 => $value2) {
                $user = User::find($value2->generated_by_CBR_id);

                $invite_code = Invite_code::find($value2->id);
                $invite_code->reminder_sent_on = $now;
                $invite_code->update();

                $data = Email::find('129');
                $full_name = $data->title;
                $from_email = $data->from_email_address;

                $this->email_send($data, $user->email, $full_name, $from_email);
            }

            $data3 = Invite_code::where('code_type', '2')
                ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
                ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
                ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
                ->get();

            foreach ($data3 as $key3 => $value3) {
                $user = User::find($value3->generated_by_CBR_id);

                $invite_code = Invite_code::find($value3->id);
                $invite_code->reminder_sent_on = $now;
                $invite_code->update();

                $data = Email::find('130');
                $full_name = $data->title;
                $from_email = $data->from_email_address;

                $this->email_send($data, $user->email, $full_name, $from_email);
            }
        } else if($flag == 'unique') {
            /*$data1 = Invite_code::where('code_type', '1')
                ->Where('reminder_sent_on', null)
                ->where('created_at', '<=', date('Y-m-d H:i:s',strtotime($now . "-1 day")))
                ->get();

            foreach ($data1 as $key => $value) {
                $invite_code = Invite_code::find($value->id);
                $invite_code->reminder_sent_on = $now;
                $invite_code->update();

                $user = User::find($value->generated_by_CBR_id);

                $data = Email::find('131');
                $full_name = $data->title;
                $from_email = $data->from_email_address;

                $img = '<img src="{link_url}" style="width: 312px;"><span style="font-family: Verdana;"><br></span>';
                $link_url = asset('assets/images/email_img/unique_code_email.png');
                $img = str_replace('{link_url}', $link_url, $img);
                $data->content = str_replace("[image]", $img, $data->content);

                $this->email_send($data, $user->email, $full_name, $from_email);
            }*/
        } else {

        }


        return true;
    }

    public function record_lock()
    {
        $now = date('Y-m-d H:i:s');
        $data2 = DB::table('users AS u')
            ->leftjoin('d_cur_table AS d', 'd.id', 'u.id')
            ->where('d.record_lock', '2')
            ->where('u.lock_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-2 days")))
            ->select('u.*', 'd.requested_business_id', 'd.record_lock')
            ->get();

        foreach ($data2 as $key2 => $value2) {
            $citizen_user = User::find($value2->id);
            $citizen_user->lock_sent_on = $now;
            $citizen_user->update();

            $cur_info = CUR_table::find($value2->id);
            $cur_info->record_lock = '3';
            $cur_info->update();

            $data = Email::find('155');

            $cbr_data = CBR_table::find($value2->requested_business_id);
            $full_name = ucwords($cbr_data->ocb_name);


            if(!$data) return false;

            $data->content = str_replace("[name_here]", $full_name, $data->content);

            $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                               <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                  <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                               </font>
                            </a> ';
            $link_url = url('/').'/unlock_record/'.$citizen_user->token_key;
            $button = str_replace('{link_url}', $link_url , $button);
            $button = str_replace('{button_name}', 'Unlock' , $button);

            $data->content = str_replace("[button]", $button, $data->content);

            $content['content'] = $data->content;
            $title = $data->title;
            $subject = $data->subject;
            $to_email = $citizen_user->email;
            $from_email = $data->from_email_address;

            try {
                Mail::send('mail.email_template', $content, function($message) use ($to_email, $from_email, $title, $subject){
                    $message->to($to_email, $title)->subject($subject);
                    $message->from($from_email);
                });
            } catch (\Exception $e) {
                return false;
            }
        }

        return true;
    }

    public function request_dep_eva()
    {

        $now = date('Y-m-d H:i:s');
        $data1 = Request_dep_eva_history::where('status', '0')
            ->where('last_reminder_sent_on', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-2 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->get();

        foreach($data1 as $key => $value) {
            $user = User::findOrFail($value->CBR_id);
            $cbr_info = CBR_table::findOrFail($value->CBR_id);

            $data = Email::find('157');

            $to_email = $user->email;

            if(!is_null($value->branch_id)) {
                $to_email = Branch::findOrFail($value->branch_id)->branch_email;
            }

            $email_address = $value->receiver_email;
            $applicant_name = $value->applicant_name;
            $business_name = $cbr_info->ocb_name;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                $data = Email::find('160');
                $to_email = $email_address;

                if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                    $request_dep = Request_dep_eva_history::find($value->id);
                    $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                    $request_dep->update();
                }
            }
        }

        $data2 = Request_dep_eva_history::where('status', '0')
            ->where('last_reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('last_reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-5 days")))
            ->get();
        $data2 = Request_dep_eva_history::where('status', '0')
            ->where('last_reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('last_reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-5 days")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        foreach($data2 as $key => $value) {
            $user = User::findOrFail($value->CBR_id);
            $cbr_info = CBR_table::findOrFail($value->CBR_id);

            $data = Email::find('158');

            $to_email = $user->email;

            if(!is_null($value->branch_id)) {
                $to_email = Branch::findOrFail($value->branch_id)->branch_email;
            }

            $email_address = $value->receiver_email;
            $applicant_name = $value->applicant_name;
            $business_name = $cbr_info->ocb_name;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                $data = Email::find('161');
                $to_email = $email_address;

                if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                    $request_dep = Request_dep_eva_history::find($value->id);

                    $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                    $request_dep->update();

                }
            }
        }

        $data3 = Request_dep_eva_history::where('status', '0')
            ->where('last_reminder_sent_on', '!=', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-10 days")))
            ->get();

        foreach($data3 as $key => $value) {
            $user = User::findOrFail($value->CBR_id);
            $cbr_info = CBR_table::findOrFail($value->CBR_id);

            $data = Email::find('163');

            $to_email = $user->email;

            if(!is_null($value->branch_id)) {
                $to_email = Branch::findOrFail($value->branch_id)->branch_email;
            }

            $email_address = $value->receiver_email;
            $applicant_name = $value->applicant_name;
            $business_name = $value->business_name;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                $request_dep = Request_dep_eva_history::find($value->id);
                $request_dep->status = '1';
                $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                $request_dep->update();
            }
        }

        $data4 = Request_dep_eva_history::where('status', '>', 0)
            ->where('last_reminder_sent_on', '!=', null)
            ->where('recommend_flag', '0')
            ->where('last_reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('last_reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->get();

        foreach($data4 as $key => $value) {
            $user = User::findOrFail($value->CBR_id);
            $cbr_info = CBR_table::findOrFail($value->CBR_id);

            $data = Email::find('165');

            $to_email = $value->receiver_email;
            $email_address = $value->receiver_email;
            $applicant_name = $value->applicant_name;
            $business_name = $cbr_info->ocb_name;

            $exist_flag = Branch::where('branch_email', $to_email)->exists();

            if($exist_flag == false) {
                $exist_flag = User::where('email', $to_email)->exists();
            }

            if($exist_flag === true) continue;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                $request_dep = Request_dep_eva_history::find($value->id);
                $request_dep->recommend_flag = '1';
                $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                $request_dep->update();
            }
        }

        $data5 = Request_dep_eva_history::where('status', '>', 0)
            ->where('recommend_flag', '1')
            ->where('last_reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-11 days")))
            ->where('last_reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->get();

        foreach($data5 as $key => $value) {
            $user = User::findOrFail($value->CBR_id);
            $cbr_info = CBR_table::findOrFail($value->CBR_id);

            $data = Email::find('166');

            $to_email = $value->receiver_email;
            $email_address = $value->receiver_email;
            $applicant_name = $value->applicant_name;
            $business_name = $cbr_info->ocb_name;

            $exist_flag = Branch::where('branch_email', $to_email)->exists();

            if($exist_flag == false) {
                $exist_flag = User::where('email', $to_email)->exists();
            }

            if($exist_flag === true) continue;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $value->id)) {
                $request_dep = Request_dep_eva_history::find($value->id);
                $request_dep->last_reminder_sent_on = date('Y-m-d H:i:s');
                $request_dep->update();
            }
        }

        $data6 = Request_dep_eva_history::where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-30 days")))
            ->delete();

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

    public function citizen_signup_email()
    {
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'citizen')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->get();

        foreach ($data1 as $key => $value) {
            $user = User::find($value->id);
            $user->reminder_sent_on = $now;
            $user->update();

            $data = Email::find('16');
            $full_name = $this->getFullName($user);

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $user->email, $full_name, $from_email);
        }

        $data2 = User::where('user_type','citizen')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-8 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-9 days")))
            ->get();

        foreach ($data2 as $key2 => $value2) {
            $user = User::find($value2->id);
            $user->reminder_sent_on = $now;
            $user->update();

            $data = Email::find('17');
            $full_name = $this->getFullName($user);

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $user->email, $full_name, $from_email);
        }

        $data3 = User::where('user_type', 'citizen')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-60 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-61 days")));

        $data4 = User::where('user_type', 'citizen')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-60 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-61 days")))
            ->union($data3)
            ->get();

        foreach ($data4 as $key3 => $value3) {
            $user = User::find($value3->id);
            $user->reminder_sent_on = $now;
            $user->update();

            $data = Email::find('18');
            $full_name = $this->getFullName($user);

            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $from_email = $data->from_email_address;

            $this->email_send($data, $user->email, $full_name, $from_email);
        }

        return true;
    }

    public function business_email()
    {
        $now = date('Y-m-d H:i:s');

        $data6 = User::where('user_type','business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));

        $data7 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->union($data6)
            ->get();

        if(count($data7)>0) {
            $this->business_email_send($data7, '39');
        }

        $data52 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-38 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-39 days")))
            ->get();

        if(count($data52)>0) {
            $this->business_email_send($data52, '145');
        }

        $data5 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5)>0) {
            $this->business_email_send($data5, '35');
        }

        $data4 = User::where('user_type','business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4)>0) {
            $this->business_email_send($data4, '31');
        }

        $data32 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-18 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-19 days")))
            ->get();

        if(count($data32) > 0) {
            $this->business_email_send($data32, '141');
        }

        $data3 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0) {
            $this->business_email_send($data3, '27');
        }

        $data22 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-9 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-10 days")))
            ->get();

        if(count($data22) > 0) {
            $this->business_email_send($data22, '137');
        }


        $data2 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->business_email_send($data2, '23');
        }

        $data12 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->get();

        if(count($data12) > 0) {
            $this->business_email_send($data12, '133');
        }

        $data1 = User::where('user_type','business')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '>',date('Y-m-d H:i:s', strtotime($now . "-2 days")))
            ->get();

        if(count($data1) > 0) {
            $this->business_email_send($data1, '19');
        }

        return true;
    }

    private function business_email_send($user_data, $email_id)
    {
        $now = date('Y-m-d H:i:s');
        $dat = Email::find($email_id);
        $from_email = $dat->from_email_address;

        foreach ($user_data as $key => $value) {
            $user = User::find($value->id);
            $user->reminder_sent_on = $now;
            $user->update();

            $full_name = $this->getFullName($user);

            if(RDB_perm::where('CBR_id',$user->id)->count() < 1) {
                $data = Email::find($email_id + 1);
                $data->content = str_replace("[name_here]", $full_name, $data->content);

                $this->email_send($data, $user->email, $full_name, $from_email);
            } else {
                if($user->credits_remaining == 0) {
                    $data = Email::find($email_id + 2);
                    $data->content = str_replace("[name_here]", $full_name, $data->content);

                    $this->email_send($data, $user->email, $full_name, $from_email);
                } else {
                    $data = Email::find($email_id + 3);
                    $data->content = str_replace("[name_here]", $full_name, $data->content);

                    $this->email_send($data, $user->email, $full_name, $from_email);
                }
            }
        }
    }

    public function hris_email()
    {
        $now = date('Y-m-d H:i:s');
        $data6 = User::where('user_type','hris')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('origin_user_flag', '!=', '1')
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        // ->get();
        $data7 = User::where('user_type', 'hris')
            ->where('reminder_sent_on','>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->where('origin_user_flag', '!=', '1')
            ->union($data6)
            ->get();

        if(count($data7) > 0) {
            $this->hris_email_send($data7,'63');
        }

        $data5 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data5) > 0) {
            $this->hris_email_send($data5,'59');
        }

        $data4 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data4) > 0) {
            $this->hris_email_send($data4,'55');
        }

        $data3 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data3) > 0) {
            $this->hris_email_send($data3,'51');
        }

        $data2 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data2) > 0) {
            $this->hris_email_send($data2,'47');
        }

        $data1 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data1) > 0) {
            $this->hris_email_send($data1,'43');
        }

        return true;
    }

    private function hris_email_send($user_data, $email_id)
    {
        $now = date('Y-m-d H:i:s');
        $dat = Email::find($email_id);
        $from_email = $dat->from_email_address;

        foreach ($user_data as $value) {
            $user = User::find($value->id);
            $user->reminder_sent_on = $now;
            $user->update();

            $full_name = $this->getFullName($user);

            if(User::where('referrer_CBR_id', $user->id)->count()<1){
                $data = Email::find($email_id + 1);
                $data->content = str_replace("[name_here]", $full_name, $data->content);

                $this->email_send($data, $user->email, $full_name, $from_email);
            } else {
                if(PaymentsReceived::where('referrer_CBR_id', $user->id)->count() < 1){
                    $data = Email::find($email_id + 2);
                    $data->content = str_replace("[name_here]", $full_name, $data->content);

                    $this->email_send($data, $user->email, $full_name, $from_email);
                } else {
                    $data = Email::find($email_id + 3);
                    $data->content = str_replace("[name_here]", $full_name, $data->content);

                    $this->email_send($data, $user->email, $full_name, $from_email);
                }
            }
        }
        return true;
    }

    public function advisor_d_email()
    {
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', null)
            ->where('created_at','<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '67');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at','<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '70');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data3) > 0){
            $this->advisor_email_send($data3, '73');
        }

        $data4 = User::where('user_type','advisors')
            ->where('advisors_type','developer')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '76');
        }

        $data5 = User::where('user_type','advisors')
            ->where('advisors_type','developer')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '79');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('origin_user_flag', '!=', '1')
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->where('origin_user_flag', '!=', '1')
            ->union($data6)
            ->get();

        if(count($data7) > 0) {
            $this->advisor_email_send($data7, '82');
        }

        return true;
    }
    public function advisor_a_email()
    {
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '85');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '88');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data3) > 0) {
            $this->advisor_email_send($data3, '91');
        }

        $data4 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '94');
        }

        $data5 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '97');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('origin_user_flag', '!=', '1')
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type','advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->where('origin_user_flag', '!=', '1')
            ->union($data6)
            ->get();

        if(count($data7) > 0) {
            $this->advisor_email_send($data7, '100');
        }

        return true;
    }
    public function advisor_w_email()
    {
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '103');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<=',date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '106');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data3) > 0){
            $this->advisor_email_send($data3, '109');
        }

        $data4 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '112');
        }

        $data5 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->where('origin_user_flag', '!=', '1')
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '115');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('origin_user_flag', '!=', '1')
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->where('origin_user_flag', '!=', '1')
            ->union($data6)
            ->get();

        if(count($data7) > 0) {
            $this->advisor_email_send($data7, '118');
        }

        return true;
    }

    private function advisor_email_send($user_data, $email_id)
    {
        $now = date('Y-m-d H:i:s');
        $dat = Email::find($email_id);
        $from_email = $dat->from_email_address;
        foreach ($user_data as $key => $value) {
            $user = User::find($value->id);
            $user->reminder_sent_on = $now;
            $user->update();
            $full_name = $this->getFullName($user);
            if(PaymentsReceived::where('referrer_CBR_id', $user->id)->count() < 1) {
                $data = Email::find($email_id + 1);
                $data->content = str_replace("[name_here]", $full_name, $data->content);

                $this->email_send($data, $user->email, $full_name, $from_email);
            } else {
                $data = Email::find($email_id + 2);
                $data->content = str_replace("[name_here]", $full_name, $data->content);

                $this->email_send($data, $user->email, $full_name, $from_email);
            }
        }
        return true;
    }

    public function credit_email($user_type){
        if($user_type == 'business') {
            $user_field = 'user_type';
            $sql_str = 'user_type = "business"';
        } else {
            $user_field = 'advisors_type';
            $sql_str = 'advisors_type = "advisor"';
        }

        $now = date('Y-m-d H:i:s');
        $data1 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-14 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-15 days")));
        $data11 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-14 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-15 days")));
        $data12 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-64 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-65 days")));
        $data13 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-64 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-65 days")));
        $data14 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-120 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-121 days")));
        $data15 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-120 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-121 days")));
        $data16 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-240 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-241 days")));
        $data17 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-240 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-241 days")));
        $data18 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-360 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-361 days")));
        $data19 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-360 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-361 days")));
        $data110 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-480 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-481 days")));
        $data111 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-480 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-481 days")))
            ->union($data1)
            ->union($data11)
            ->union($data12)
            ->union($data13)
            ->union($data14)
            ->union($data15)
            ->union($data16)
            ->union($data17)
            ->union($data18)
            ->union($data19)
            ->union($data110)
            ->get();

        if(count($data111) > 0) {
            $this->credit_email_send($data111, '121');
        }

        /*$data120 = DB::select('SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) % 120 = 0 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) / 120 >= 2 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND credits_remaining = 0 AND '.$sql_str.'
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) % 120 = 0 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) / 120 >= 2 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL AND '.$sql_str);
        $data120 = DB::select('SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) % 120 = 0 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND credits_remaining = 0
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, created_at) % 120 = 0 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, created_at) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL');

        if(count($data120) > 0) {
            $this->credit_email_send($data120, '121');
        }
*/

        $data2 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at','<=', date('Y-m-d H:i:s', strtotime($now . "-17 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-18 days")));
        $data21 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-17 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-18 days")));
        $data22 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-67 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-68 days")));
        $data23 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-67 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-68 days")));
        $data24 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-123 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-124 days")));
        $data25 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-123 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-124 days")));
        $data26 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-243 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-244 days")));
        $data27 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-243 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-244 days")));
        $data28 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-363 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-364 days")));
        $data29 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-363 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-364 days")));
        $data210 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-483 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-484 days")));
        $data211 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-483 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-484 days")))
            ->union($data2)
            ->union($data21)
            ->union($data22)
            ->union($data23)
            ->union($data24)
            ->union($data25)
            ->union($data26)
            ->union($data27)
            ->union($data28)
            ->union($data29)
            ->union($data210)
            ->get();

        if(count($data211) > 0) {
            $this->credit_email_send($data211, '122');
        }

        /*$data123 = DB::select('SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) % 120 = 3 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) / 120 >= 2 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND credits_remaining = 0 AND '.$sql_str.'
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) % 120 = 3 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) / 120 >= 2 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL AND '.$sql_str);
        $data123 = DB::select('SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) % 120 = 3 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND credits_remaining = 0
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, created_at) % 120 = 3 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, created_at) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL');

        if(count($data123) > 0) {
            $this->credit_email_send($data123, '122');
        }
*/
        $data3 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-18 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-19 days")));
        $data31 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-18 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-19 days")));
        $data32 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-68 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-69 days")));
        $data33 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-68 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-69 days")));
        $data34 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-124 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-125 days")));
        $data35 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-124 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-125 days")));
        $data36 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-244 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-245 days")));
        $data37 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-244 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-245 days")));
        $data38 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-364 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-365 days")));
        $data39 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-364 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-365 days")));
        $data310 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($now . "-484 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-485 days")));
        $data311 = User::where($user_field, $user_type)
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<=', date('Y-m-d H:i:s', strtotime($now . "-1 day")))
            ->where('credits_zero_date', '<=', date('Y-m-d H:i:s', strtotime($now . "-484 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-485 days")))
            ->union($data3)
            ->union($data31)
            ->union($data32)
            ->union($data33)
            ->union($data34)
            ->union($data35)
            ->union($data36)
            ->union($data37)
            ->union($data38)
            ->union($data39)
            ->union($data310)
            ->get();

        if(count($data311) > 0) {
            $this->credit_email_send($data311, '123');
        }

        /*$data124 = DB::select('SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) % 120 = 4 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credits_zero_date)) / 120 >= 2 AND
                                minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND credits_remaining = 0 AND '.$sql_str.'
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) % 120 = 4 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) / 120 >= 2 AND
                                    minute(TIMEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on)) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL AND '.$sql_str);
        $data124 = DB::select('SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) % 120 = 4 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credits_zero_date) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND credits_remaining = 0
                            UNION ALL
                            SELECT *
                            FROM users
                            WHERE DATEDIFF(CURRENT_TIMESTAMP, created_at) % 120 = 4 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, created_at) / 120 >= 2 AND
                                    DATEDIFF(CURRENT_TIMESTAMP, credit_email_sent_on) > 1 AND
                                    credits_remaining = 0 AND credits_zero_date IS NULL');

        if(count($data124) > 0) {
            $this->credit_email_send($data124, '123');
        }
*/
    }

    private function credit_email_send($user_data, $email_id)
    {
        $now = date('Y-m-d H:i:s');
        $data = Email::find($email_id);

        foreach ($user_data as $key => $value) {
            $user = User::find($value->id);
            $user->credit_email_sent_on = $now;

            if($email_id == '121') {
                $user->credit_offer_expire_date = date('Y-m-d H:i:s', strtotime($now . "+4 days"));
            }

            if($email_id == '122') {
                $user->credit_offer_expire_date = date('Y-m-d H:i:s', strtotime($now . "+2 days"));
            }

            if($email_id == '123') {
                $user->credit_offer_expire_date = date('Y-m-d H:i:s', strtotime($now . "+1 day"));
            }

            $user->update();

            $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                           </font>
                        </a> ';
            $link_url = url('/').'/credit_offer/'.$user->token_key;
            $button = str_replace('{link_url}', $link_url , $button);
            $button = str_replace('{button_name}', 'Credit Offer', $button);

            $data->content = str_replace("[button]", $button, $data->content);

            $full_name = $this->getFullName($user);
            $data->content = str_replace("[name_here]", $full_name, $data->content);
            $from_email = $data->from_email_address;
            $content['content'] = $data->content;

            if($this->email_send($data, $user->email, $full_name, $from_email))
            {
                return true;
            }
        }

        return true;
    }

    public function AutoRemoveTestRecord()
    {
        $now = date('Y-m-d H:i:s');
        $TestData = TestData::all();
        foreach ($TestData as $key => $value)
        {
            RDB_perm::where('NI_identity_number', $value->NI_number)->where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 day")))->delete();
            RecordHistory::where('NI_identity_number', $value->NI_number)->where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 day")))->delete();
        }

        return true;
    }

    public function AutoRemoveReplacementHistory()
    {
        $now = date('Y-m-d H:i:s');
        $condition_date = date('Y-m-d H:i:s', strtotime($now . "-3 days"));
        $match = DB::select("SELECT m.*, if(c.id is null, 0, count(*)) count_old
			FROM `d_replacement_search_number_history` m
			LEFT JOIN `d_replacement_search_number_history` c ON (c.cur_id = m.cur_id and c.created_at > m.created_at)
			GROUP BY m.id
			HAVING count_old > 0 and created_at < '".$condition_date."'");

        foreach ($match as $key => $value)
        {
            Replacement_number_table::where('id', $value->id)->delete();
        }

        return true;
    }

    public function AutoRemoveAPIErrorRecord()
    {
        $now = date('Y-m-d H:i:s');
        RDB::where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 day")))->delete();

        return true;
    }


}
