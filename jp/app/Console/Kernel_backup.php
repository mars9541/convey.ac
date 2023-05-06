<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
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
        $this->AutoRemoveAPIErrorRecord();
        $this->confirm_email();
        $this->invite_code_email();
        $this->citizen_signup_email();
        $this->business_email();
        $this->hris_email();
        $this->advisor_d_email();
        $this->advisor_a_email();
        $this->advisor_w_email();
        $this->credit_email();
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

    public function email_send($data,$address, $full_name, $from_email)
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
            $full_name = $user_data->firstname.' '.$user_data->lastname;
        } else {
            $cbr_data = CBR_table::find($user->id);

            if($cbr_data) {
                $full_name = $cbr_data->lrd_firstname.' '.$cbr_data->lrd_lastname;
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
        $data = User::where('email_verify',null)->where('created_at', '<', date('Y-m-d H:i:s',strtotime($now . "-1 days")))->get();

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
            if($this->email_send($data,$user->email, $full_name,$from_email))
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
            ->Where('reminder_sent_on', null)
            ->where('created_at', '<', date('Y-m-d H:i:s',strtotime($now . "-".$invite_day1." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s',strtotime($now . "-".($invite_day1 + 1)." days")))
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

            $this->email_send($data,$value->assigned_to, $full_name, $from_email);
        }

        $invite_day2 = Email::find('14')->rule;
        $data2 = Invite_code::where('code_type', '1')
            ->where('used_by_CBR_id', null)
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-".$invite_day2." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day2+1)." days")))
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
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-".$invite_day3." days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-".($invite_day3+1)." days")))
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

    public function citizen_signup_email()
    {
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'citizen')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
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
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-8 days")))
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

            $this->email_send($data,$user->email, $full_name, $from_email);
        }

        $data3 = User::where('user_type', 'citizen')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-60 days")))
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

            $this->email_send($data,$user->email, $full_name, $from_email);
        }

        return true;
    }

    public function business_email()
    {
        $now = date('Y-m-d H:i:s');

        $data6 = User::where('user_type','business')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));

        $data7 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s',strtotime($now . "-45 days")))
             ->where('reminder_sent_on', '>', date('Y-m-d H:i:s',strtotime($now . "-46 days")))
            ->union($data6)
            ->get();

        if(count($data7)>0) {
            $this->business_email_send($data7, '39');
        }

        $data5 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5)>0) {
            $this->business_email_send($data5, '35');
        }

        $data4 = User::where('user_type','business')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4)>0) {
            $this->business_email_send($data4, '31');
        }

        $data3 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0) {
            $this->business_email_send($data3, '27');
        }


        $data2 = User::where('user_type', 'business')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->business_email_send($data2, '23');
        }

        $data1 = User::where('user_type','business')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
             ->where('created_at', '>',date('Y-m-d H:i:s', strtotime($now . "-4 days")))
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
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        // ->get();
        $data7 = User::where('user_type', 'hris')
            ->where('reminder_sent_on','>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
            ->union($data6)
            ->get();

        if(count($data7) > 0) {
            $this->hris_email_send($data7,'63');
        }

        $data5 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5) > 0) {
            $this->hris_email_send($data5,'59');
        }

        $data4 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4) > 0) {
            $this->hris_email_send($data4,'55');
        }

        $data3 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0) {
            $this->hris_email_send($data3,'51');
        }

        $data2 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->hris_email_send($data2,'47');
        }

        $data1 = User::where('user_type', 'hris')
            ->where('reminder_sent_on', null)
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
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
                //  Log::info();
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
            ->where('created_at','<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
             ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '67');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at','<', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '70');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0){
            $this->advisor_email_send($data3, '73');
        }

        $data4 = User::where('user_type','advisors')
            ->where('advisors_type','developer')
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '76');
        }

        $data5 = User::where('user_type','advisors')
            ->where('advisors_type','developer')
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '79');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'developer')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
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
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '85');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '88');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0) {
            $this->advisor_email_send($data3, '91');
        }

        $data4 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '94');
        }

        $data5 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '97');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type','advisors')
            ->where('advisors_type', 'advisor')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
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
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-3 days")))
             ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-4 days")))
            ->get();

        if(count($data1) > 0) {
            $this->advisor_email_send($data1, '103');
        }

        $data2 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<',date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-6 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-7 days")))
            ->get();

        if(count($data2) > 0) {
            $this->advisor_email_send($data2, '106');
        }

        $data3 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-12 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-13 days")))
            ->get();

        if(count($data3) > 0){
            $this->advisor_email_send($data3, '109');
        }

        $data4 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-28 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-29 days")))
            ->get();

        if(count($data4) > 0) {
            $this->advisor_email_send($data4, '112');
        }

        $data5 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-31 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-32 days")))
            ->get();

        if(count($data5) > 0) {
            $this->advisor_email_send($data5, '115');
        }

        $data6 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")));
        $data7 = User::where('user_type', 'advisors')
            ->where('advisors_type', 'writer')
            ->where('reminder_sent_on', '>', 'created_at')
            ->where('reminder_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-45 days")))
            ->where('reminder_sent_on', '>', date('Y-m-d H:i:s', strtotime($now . "-46 days")))
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

    public function credit_email(){
        $now = date('Y-m-d H:i:s');
        $data1 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-14 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-15 days")));
        $data11 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s',strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s',strtotime($now . "-14 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s',strtotime($now . "-15 days")));
        $data12 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-64 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-65 days")));
        $data13 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-64 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-65 days")));
        $data14 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-120 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-121 days")));
        $data15 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-120 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-121 days")))
            ->union($data1)
            ->union($data11)
            ->union($data12)
            ->union($data13)
            ->union($data14)
            ->get();

        if(count($data15) > 0) {
            $this->credit_email_send($data15, '121');
        }

        $data2 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at','<', date('Y-m-d H:i:s', strtotime($now . "-17 days")))
            ->where('created_at','>', date('Y-m-d H:i:s', strtotime($now . "-18 days")));
        $data21 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-17 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-18 days")));
        $data22 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-67 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-68 days")));
        $data23 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-67 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-68 days")));
        $data24 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-123 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-124 days")));
        $data25 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-123 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-124 days")))
            ->union($data2)
            ->union($data21)
            ->union($data22)
            ->union($data23)
            ->union($data24)
            ->get();

        if(count($data25) > 0) {
            $this->credit_email_send($data25, '122');
        }

        $data3 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-18 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-19 days")));
        $data31 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-18 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-19 days")));
        $data32 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-68 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-69 days")));
        $data33 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-68 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-69 days")));
        $data34 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credits_zero_date', null)
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('created_at', '<', date('Y-m-d H:i:s', strtotime($now . "-124 days")))
            ->where('created_at', '>', date('Y-m-d H:i:s', strtotime($now . "-125 days")));
        $data35 = User::where('user_type', 'business')
            ->where('credits_remaining', '0')
            ->where('credit_email_sent_on', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))
            ->where('credits_zero_date', '<', date('Y-m-d H:i:s', strtotime($now . "-124 days")))
            ->where('credits_zero_date', '>', date('Y-m-d H:i:s', strtotime($now . "-125 days")))
            ->union($data3)
            ->union($data31)
            ->union($data32)
            ->union($data33)
            ->union($data34)
            ->get();

        if(count($data35) > 0) {
            $this->credit_email_send($data35, '123');
        }

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
                $user->credit_offer_expire_date = date('Y-m-d H:i:s', strtotime($now . "+1 days"));
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
            RDB_perm::where('NI_identity_number', $value->NI_number)->where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))->delete();
            RecordHistory::where('NI_identity_number', $value->NI_number)->where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))->delete();
        }

        return true;
    }

    public function AutoRemoveAPIErrorRecord()
    {
        $now = date('Y-m-d H:i:s');
        RDB::where('time_stamp', '<', date('Y-m-d H:i:s', strtotime($now . "-1 days")))->delete();

        return true;
    }


}
