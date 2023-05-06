<?php
namespace App\Http\Controllers\Front\Branch;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Branch;
use App\CUR_table;
use App\CBR_table;
use App\RDB_perm;
use App\Credits;
use App\Country_spec_info;
use App\Email;
use App\Request_dep_eva_history;
use App\Rating_history;
use App\RecordTypeMode;
use App\RecordType;
use Auth;
use Mail;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        // $this->middleware('auth');
        // $this->middleware('global');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CBR_info = User:: findOrFail(session('user')->CBR_id);
        $NI_min_number = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;
        return view('front.branch.search',compact('CBR_info','NI_min_number'));
    }

    public function search(Request $request)
    {
        if($request->NI_number != 'ABC123456789') {
            $lock_citizen_info = DB::table('d_cur_table')
                ->whereIn('NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->where('DOB', $request->dob)
                ->where('record_lock', '!=', '0')
                ->get();

            if(count($lock_citizen_info) > 0) {
                return response()->json(['status' => 'record_lock', 'record_lock_status' => $lock_citizen_info[0]->record_lock]);
            }
        }

        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;
        $rules = array(
            'NI_number' =>'required|min:'.$min_num,
        );
        $messages = array(
            'NI_number.min' => 'The Sozialversicherungsnummer for the Germany is set so it must be at least '.$min_num.' characters long.',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $business = User::where('id', session('user')->CBR_id)->first();
        $credits_count = $business->credits_remaining;

        if($request->NI_number != 'ABC123456789') {
            if($credits_count == 0) {
                return response()->json(['status' => 'credits_count_error']);
            }

            $previous_business_list = DB::table('m_record_databank_perm AS a')
                ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->where('a.DOB', $request->dob)
                ->where('a.parent_id', '0')
                ->where('a.version', '>', '0')
                ->groupby('a.CBR_id')
                ->orderBy('a.CBR_id')
                ->select('a.CBR_id')
                ->get();

            if(count($previous_business_list) > 0) {
                $today = strtotime(date('Y-m-d'));
                $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                $match = DB::table('g_credit_usage_history')
                    ->where('CBR_id', session('user')->CBR_id)
                    ->where('branch_id', session('user')->id)
                    ->whereIn('NI_Insurance_Number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                    ->where('time_stamp', '>', $six_month_ago)
                    ->exists();

                if(!$match) {
                    foreach($previous_business_list as $business_info) {
                        Rating_history::where('current_business_id', session('user')->CBR_id)
                            ->where('previous_business_id', $business_info->CBR_id)
                            ->where('NI_number', $request->NI_number)
                            ->where('branch_id', session('user')->id)
                            ->update(['current_rating_flag' => '0']);

                        Rating_history::Insert([
                            'current_business_id' => session('user')->CBR_id,
                            'previous_business_id' => $business_info->CBR_id,
                            'NI_number' => $request->NI_number,
                            'branch_id' => session('user')->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'rated_date' => date('Y-m-d H:i:s'),
                            'current_rating_flag' => '1'
                        ]);
                    }
                }
            } else {
                $citizen_info = CUR_table::where('replacement_search_number', $request->NI_number)->first();

                if($citizen_info) {
                    $NI_number = $citizen_info->NI_identity_number;

                    if(strlen($NI_number) != $min_num) {
                        $NI_number = CommonController::DecryptNI($NI_number);
                    }

                    $previous_business_list = DB::table('m_record_databank_perm AS a')
                        ->whereIn('a.NI_identity_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                        ->where('a.DOB', $request->dob)
                        ->where('a.parent_id', '0')
                        ->where('a.version', '>', '0')
                        ->groupby('a.CBR_id')
                        ->orderby('a.CBR_id')
                        ->select('a.CBR_id')
                        ->get();

                    $today = strtotime(date('Y-m-d'));
                    $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                    $match = DB::table('g_credit_usage_history')
                        ->where('CBR_id', session('user')->CBR_id)
                        ->where('branch_id', session('user')->id)
                        ->whereIn('NI_Insurance_Number', [$NI_number, CommonController::EncryptNI($NI_number)])
                        ->where('time_stamp', '>', $six_month_ago)
                        ->exists();

                    if(!$match) {
                        foreach($previous_business_list as $business_info) {
                            Rating_history::where('current_business_id', session('user')->CBR_id)
                                ->where('previous_business_id', $business_info->CBR_id)
                                ->where('NI_number', $NI_number)
                                ->where('branch_id', session('user')->id)
                                ->update(['current_rating_flag' => '0']);

                            Rating_history::Insert([
                                'current_business_id' => session('user')->CBR_id,
                                'previous_business_id' => $business_info->CBR_id,
                                'NI_number' => $NI_number,
                                'branch_id' => session('user')->id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'rated_date' => date('Y-m-d H:i:s'),
                                'current_rating_flag' => '1'
                            ]);
                        }
                    }
                }
            }
        }

        $search_result = array();
        if($request->NI_number != 'ABC123456789') {
            $parent_data = DB::table('m_record_databank_perm AS a')
                ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                ->leftjoin('rating_history AS r', function($join) {
                    $join->on('a.CBR_id', '=', 'r.previous_business_id')
                        ->where('r.current_business_id', '=', session('user')->CBR_id)
                        ->where('r.branch_id', session('user')->id)
                        ->where('r.current_rating_flag', '=', '1');
                })
                ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->whereIn('r.NI_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->where('a.DOB', $request->dob)
                ->where('a.parent_id', '0')
                ->where('a.version', '>', '0')
                ->orderBy('a.CBR_id')
                ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp', 'r.current_business_id', 'r.previous_business_id', 'r.rating_number', 'r.NI_number')
                ->get();
        } else {
            $parent_data = DB::table('m_record_databank_perm AS a')
                ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                ->leftjoin('rating_history AS r', function($join) {
                    $join->on('a.CBR_id', '=', 'r.previous_business_id')
                        ->where('r.current_business_id', '=', session('user')->CBR_id)
                        ->where('r.branch_id', session('user')->id)
                        ->where('r.current_rating_flag', '=', '1');
                })
                ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->where('a.DOB', $request->dob)
                ->where('a.parent_id', '0')
                ->where('a.version', '>', '0')
                ->orderBy('a.CBR_id')
                ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp', 'r.current_business_id', 'r.previous_business_id', 'r.rating_number', 'r.NI_number')
                ->get();
        }

        if(count($parent_data) > 0) {
            foreach ($parent_data as $item) {
                if($request->NI_number != 'ABC123456789') {
                    $max_version = DB::table('m_record_databank_perm AS a')
                        ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                        ->leftjoin('rating_history AS r', function($join) {
                            $join->on('a.CBR_id', '=', 'r.previous_business_id')
                                ->where('r.current_business_id', '=', session('user')->CBR_id)
                                ->where('r.branch_id', session('user')->id)
                                ->where('r.current_rating_flag', '=', '1');
                        })
                        ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                        ->whereIn('r.NI_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                        ->where('a.DOB', $request->dob)
                        ->where('a.parent_id', $item->id)
                        ->where('a.version', '>', '0')
                        ->orderBy('a.version', 'desc')
                        ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp', 'r.current_business_id', 'r.previous_business_id', 'r.rating_number')
                        ->get();
                } else {
                    $max_version = DB::table('m_record_databank_perm AS a')
                        ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                        ->leftjoin('rating_history AS r', function($join) {
                            $join->on('a.CBR_id', '=', 'r.previous_business_id')
                                ->where('r.current_business_id', '=', session('user')->CBR_id)
                                ->where('r.branch_id', session('user')->id)
                                ->where('r.current_rating_flag', '=', '1');
                        })
                        ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                        ->where('a.DOB', $request->dob)
                        ->where('a.parent_id', $item->id)
                        ->where('a.version', '>', '0')
                        ->orderBy('a.version', 'desc')
                        ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp', 'r.current_business_id', 'r.previous_business_id', 'r.rating_number')
                        ->get();
                }

                if(count($max_version) > 0){
                    $ids = array();

                    for ($i = 1; $i < count($max_version); $i++) {
                        array_push($ids, $max_version[$i]->id);
                    }

                    array_push($ids, $item->id);
                    $max_version[0]->ids = $ids;
                    array_push($search_result, $max_version[0]);
                } else {
                    array_push($search_result, $item);
                }
            }
        } else {

            $citizen_info = CUR_table::where('replacement_search_number', $request->NI_number)->first();

            if($citizen_info) {
                $NI_number = $citizen_info->NI_identity_number;

                if (strlen($NI_number) != $min_num) {
                    $NI_number = CommonController::DecryptNI($NI_number);
                }

                $parent_data = DB::table('m_record_databank_perm AS a')
                    ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                    ->leftjoin('rating_history AS r', function($join) {
                        $join->on('a.CBR_id', '=', 'r.previous_business_id')
                            ->where('r.current_business_id', '=', session('user')->CBR_id)
                            ->where('r.branch_id', null)
                            ->where('r.current_rating_flag', '=', '1');
                    })
                    ->whereIn('a.NI_identity_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                    ->whereIn('r.NI_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                    ->where('a.DOB', $request->dob)
                    ->where('a.parent_id', '0')
                    ->where('a.version', '>', '0')
                    ->orderby('a.CBR_id')
                    ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp')
                    ->get();

                foreach ($parent_data as $item) {
                    $max_version = DB::table('m_record_databank_perm AS a')
                        ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                        ->leftjoin('rating_history AS r', function($join) {
                            $join->on('a.CBR_id', '=', 'r.previous_business_id')
                                ->where('r.current_business_id', '=', session('user')->CBR_id)
                                ->where('r.branch_id', null)
                                ->where('r.current_rating_flag', '=', '1');
                        })
                        ->whereIn('a.NI_identity_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                        ->whereIn('r.NI_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                        ->where('a.DOB', $request->dob)
                        ->where('a.parent_id', $item->id)
                        ->where('a.version', '>', '0')
                        ->orderBy('a.version', 'desc')
                        ->select('a.*', 'b.ocb_name', 'b.website', 'a.time_stamp', 'r.current_business_id', 'r.previous_business_id', 'r.rating_number')
                        ->get();

                    if(count($max_version) > 0){
                        $ids = array();

                        for ($i = 1; $i < count($max_version); $i++) {
                            array_push($ids, $max_version[$i]->id);
                        }

                        array_push($ids, $item->id);
                        $max_version[0]->ids = $ids;
                        array_push($search_result, $max_version[0]);
                    } else {
                        array_push($search_result, $item);
                    }
                }

                $email_sent_status = 'false';
                if($request->NI_number != 'ABC123456789') {
                    if(count($search_result) > 0) {
                        $today = strtotime(date('Y-m-d'));
                        $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                        $match = DB::table('g_credit_usage_history')
                            ->where('CBR_id', $business->id)
                            ->where('branch_id', session('user')->id)
                            ->whereIn('NI_Insurance_Number', [$NI_number, CommonController::EncryptNI($NI_number)])
                            ->where('time_stamp', '>', $six_month_ago)
                            ->exists();

                        if(!$match)
                        {
                            $data = User::find(session('user')->CBR_id);
                            $data->credits_remaining = $credits_count - 1;
                            $data->update();

                            Credits::Insert([
                                'CBR_id' => $business->id,
                                'cohort_id' => $business->cohort_id,
                                'adjustment_value' => '0',
                                'branch_id' => session('user')->id,
                                'balance' => $credits_count - 1,
                                'time_stamp' => date('Y-m-d'),
                                'NI_Insurance_Number' => CommonController::EncryptNI($NI_number),
                            ]);
                        }

                        if($credits_count == 1) {
                            $data = User::find(session('user')->CBR_id);
                            $data->credits_zero_date = date('Y-m-d H:i:s');
                            $data->update();
                        }

                        $data = Email::find('150');

                        $user = User::find(session('user')->CBR_id);
                        $branch = Branch::find(session('user')->id);

                        $today = date_create();
                         date_modify($today, "-4 weeks");
//                        date_modify($today, "-10 minutes");
                        $today = date_format($today, "Y-m-d H:i:s");
                        $today_time = strtotime($today);
                        $refer_sent_on = strtotime($branch->refer_sent_on);

                        if($refer_sent_on < $today_time) {
                            $to_email = $branch->branch_email;

                            $cbr_data = CBR_table::find($user->id);
                            $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

                            if($this->email_send($data, $to_email, $full_name)) {
                                $branch_info = Branch::find($branch->id);
                                $branch_info->refer_sent_on = date('Y-m-d H:i:s');
                                $branch_info->update();

                                $email_sent_status = 'true';
                            }
                        }

                    }
                } else {
                    if(count($search_result) > 0) {
                        $data = Email::find('149');

                        $user = User::find(session('user')->CBR_id);
                        $branch = Branch::find(session('user')->id);

                        $today = date_create();
                         date_modify($today, "-4 weeks");
//                        date_modify($today, "-10 minutes");
                        $today = date_format($today, "Y-m-d H:i:s");
                        $today_time = strtotime($today);
                        $refer_sent_on = strtotime($branch->refer_sent_on);

                        if($refer_sent_on < $today_time) {
                            $to_email = $branch->branch_email;

                            $cbr_data = CBR_table::find($user->id);
                            $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

                            if($this->email_send($data, $to_email, $full_name)) {
                                $branch_info = Branch::find($branch->id);
                                $branch_info->refer_sent_on = date('Y-m-d H:i:s');
                                $branch_info->update();
                            }

                            $email_sent_status = 'true';
                        }
                    }
                }


                return response()->json(['data' => $search_result,'status' => 'success', 'email_sent_flag' => $email_sent_status]);
            }


        }

        //// credits count /////
        $email_sent_status = 'false';
        if($request->NI_number != 'ABC123456789') {
            if(count($search_result) > 0){

                $today = strtotime(date('Y-m-d'));
                $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                $match = DB::table('g_credit_usage_history')
                    ->where('CBR_id', $business->id)
                    ->where('branch_id', session('user')->id)
                    ->whereIn('NI_Insurance_Number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                    ->where('time_stamp', '>', $six_month_ago)
                    ->exists();

                if(!$match)
                {
                    $data = User::find(session('user')->CBR_id);
                    $data->credits_remaining = $credits_count - 1;
                    $data->update();

                    //                User::Where('id',session('user')->CBR_id)->update(['credits_remaining'=>$credits_count-1]);
                    Credits::Insert([
                        'CBR_id' => $business->id,
                        'cohort_id' => $business->cohort_id,
                        'adjustment_value' => '0',
                        'branch_id' => session('user')->id,
                        'balance' => $credits_count - 1,
                        'time_stamp' => date('Y-m-d'),
                        'NI_Insurance_Number' => CommonController::EncryptNI($request->NI_number),
                    ]);
                }

                if($credits_count == 1) {
                    $data = User::find(session('user')->CBR_id);
                    $data->credits_zero_date = date('Y-m-d H:i:s');
                    $data->update();
                    //                User::where('id', session('user')->CBR_id)->update(['credits_zero_date', date('Y-m-d H:i:s')]);
                }

                $data = Email::find('150');

                $user = User::find(session('user')->CBR_id);
                $branch = Branch::find(session('user')->id);

                $today = date_create();
                 date_modify($today, "-4 weeks");
//                date_modify($today, "-10 minutes");
                $today = date_format($today, "Y-m-d H:i:s");
                $today_time = strtotime($today);
                $refer_sent_on = strtotime($branch->refer_sent_on);

                if($refer_sent_on < $today_time) {
                    $to_email = $branch->branch_email;

                    $cbr_data = CBR_table::find($user->id);
                    $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

                    if($this->email_send($data, $to_email, $full_name)) {
                        $branch_info = Branch::find($branch->id);
                        $branch_info->refer_sent_on = date('Y-m-d H:i:s');
                        $branch_info->update();
                    }

                    $email_sent_status = 'true';
                }

            }
        } else {
            if(count($search_result) > 0) {
                $data = Email::find('149');

                $user = User::find(session('user')->CBR_id);
                $branch = Branch::find(session('user')->id);

                $today = date_create();
                 date_modify($today, "-4 weeks");
//                date_modify($today, "-10 minutes");
                $today = date_format($today, "Y-m-d H:i:s");
                $today_time = strtotime($today);
                $refer_sent_on = strtotime($branch->refer_sent_on);

                if($refer_sent_on < $today_time) {
                    $to_email = $branch->branch_email;

                    $cbr_data = CBR_table::find($user->id);
                    $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

                    if($this->email_send($data, $to_email, $full_name)) {
                        $branch_info = Branch::find($branch->id);
                        $branch_info->refer_sent_on = date('Y-m-d H:i:s');
                        $branch_info->update();
                    }

                    $email_sent_status = 'true';
                }

            }
        }

        if(count($search_result) == 0) {
            $data = Email::find('167');

            $branch = Branch::find(session('user')->id);

            $to_email = $branch->branch_email;

            $cbr_data = CBR_table::find(session('user')->CBR_id);
            $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);

            $this->email_send($data, $to_email, $full_name);

        }

        return response()->json(['data' => $search_result,'status' => 'success', 'email_sent_flag' => $email_sent_status]);
    }


    public function get_record_version(Request $request)
    {
        $record = RDB_perm::findOrFail($request->id);
        return response()->json(['data' => $record]);
    }

    public function email_send($data, $to_email, $full_name, $user_token = null)
    {
        if(!$data) return false;

        $data->content = str_replace("[name_here]", $full_name, $data->content);

        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                           </font>
                        </a> ';
        $link_url = url('/').'/unlock_record/'.$user_token;
        $button = str_replace('{link_url}', $link_url , $button);
        $button = str_replace('{button_name}', 'Unlock' , $button);

        $data->content = str_replace("[button]", $button, $data->content);

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

    public function get_sent_request_history_list(Request $request)
    {
        if(request()->ajax())
        {
            $data = Request_dep_eva_history::where('CBR_id', session('user')->CBR_id)
                ->where('branch_id', session('user')->id)
                ->get();
            $tabledata['data'] = $data;
            //dd($tabledata);
            echo json_encode($tabledata);
        }
    }

    public function sent_request_add(Request $request)
    {
        $form_data = array(
            'CBR_id' => session('user')->CBR_id,
            'branch_id' => session('user')->id,
            'applicant_name' =>  $request->applicant_name,
            'business_name' =>  $request->business_name,
            'receiver_email' => $request->receiver_email,
            'gov_number' => $request->gov_number,
            'dob' => $request->dob_input,
            'status' => '0',
            'created_at'=>date('Y-m-d H:i:s'),
        );

        Request_dep_eva_history::Insert($form_data);
        $request_id = DB::getPDO()->lastInsertId();

        $user = User::findOrFail(session('user')->CBR_id);
        $cbr_info = CBR_table::findOrFail(session('user')->CBR_id);

        $data = Email::find('156');

        $to_email = session('user')->branch_email;
        $email_address = $request->receiver_email;
        $applicant_name = $request->applicant_name;
        $business_name = $cbr_info->ocb_name;


        if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)) {
            $data = Email::find('159');
            $to_email = $email_address;

            if($this->request_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)) {
                $request_dep = Request_dep_eva_history::find($request_id);

                $request_dep->created_at = date('Y-m-d H:i:s');
                $request_dep->update();

            }

        }


        return response()->json(['success' => 'Data Added successfully.']);
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

    public function request_record_unlock(Request $request)
    {
        $lock_citizen_info = DB::table('d_cur_table')
            ->whereIn('NI_identity_number', [$request->ni_number, CommonController::DecryptNI($request->ni_number), CommonController::EncryptNI($request->ni_number)])
            ->where('DOB', $request->dob)
            ->first();

        $branch = Branch::find(session('user')->id);

        $cbr_data = CBR_table::find(session('user')->CBR_id);
        $full_name = ucwords($cbr_data->ocb_name);

        $email_sent_status = 'false';
        if(!is_null($lock_citizen_info)) {
            $citizen = CUR_table::find($lock_citizen_info->id);
            $citizen->record_lock = '2';
            $citizen->requested_business_id = $user->id;
            $citizen->update();

            $citizen_user = User::findOrFail($citizen->id);

            $data = Email::find('154');

            $to_email = $citizen_user->email;

            if($this->email_send($data, $to_email, $full_name, $citizen_user->token_key)) {
                $citizen_user->lock_sent_on = date('Y-m-d H:i:s');
                $citizen_user->update();

                $email_sent_status = 'true';
            }

        }

        $data = Email::find('152');
        $citizen = CUR_table::find($lock_citizen_info->id);
        $full_name = ucwords($citizen->firstname).' '.ucwords($citizen->lastname);
        $to_email = $branch->branch_email;

        if($this->email_send($data, $to_email, $full_name)) {
            $email_sent_status = 'true';
        }

        return response()->json(['status' => 'success', 'email_sent_flag' => $email_sent_status]);
    }

    public function get_qa_type_info(Request $request)
    {
        if(request()->ajax()) {
            if($request->parent_id > 0 && $request->parent_id < 6){
                $qa_record_list = RecordTypeMode::where('record_type_id', $request->parent_id)
                    ->where('status', 1)
                    ->get();
            } else {
                $qa_record_list = RecordTypeMode::where('record_type_id', $request->parent_id)
                    ->where('CBR_id', session('user')->CBR_id)
                    ->where('status', 1)
                    ->orderBy('order','ASC')
                    ->get();
            }

            $record_title = RecordType::where('id', $request->parent_id)->first()->record_type;

            $qa_info = "";
            $i = 0;
            foreach($qa_record_list as $qa_record_info) {
                $i++;
                if(isset($qa_record_info['answer_text']))
                    $qa_info .= '<p contentEditable="false">Q: '.$qa_record_info['question_name'].'</p>'.$qa_record_info['answer_text'];
                else
                    $qa_info .= '<p contentEditable="false" class="mb-0">Q: '.$qa_record_info['question_name'].'</p><p >A:</p>';
            }

            return response()->json(['data' => $qa_info, 'record_title' => $record_title]);
        }
    }

    public function save_rate_record(Request $request)
    {
        $rating_history = DB::table('rating_history')
            ->where('current_business_id', session('user')->CBR_id)
            ->where('previous_business_id', $request->cbr_id)
            ->where('NI_number', $request->NI_number)
            ->where('branch_id', session('user')->id)
            ->where('current_rating_flag', '1')
            ->update(['rating_number' => $request->rating_number, 'rated_date' => date('Y-m-d H:i:s')]);

        return response()->json(['status' => 'success']);
    }

}
