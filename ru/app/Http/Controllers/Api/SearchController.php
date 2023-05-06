<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\RDB_perm;
use App\CUR_table;
use App\CBR_table;
use App\Credits;
use App\Api_Session;
use App\User;
use App\Email;
use App\Country_spec_info;
use App\Rating_history;
use App\Request_dep_eva_history;
use Mail;


class SearchController extends Controller
{

    public function search(Request $request)
    {
        if($request->National_Number != 'ABC123456789') {
            $lock_citizen_info = DB::table('d_cur_table')
                ->whereIn('NI_identity_number', [$request->National_Number, CommonController::DecryptNI($request->National_Number), CommonController::EncryptNI($request->National_Number)])
                ->where('DOB', $request->dob)
                ->where('record_lock', '!=', '0')
                ->get();

            if(count($lock_citizen_info) > 0) {
                return response()->json(['status' => 'record locked']);
            }
        }

        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;

        $rules = array(
            'National_Number' => 'required|min:'.$min_num,
            'dob' => 'required',
        );

        $messages = array(
            'National_Number.min' => 'The Personal Identification Number for the Russia is set so it must be at least '.$min_num.' characters long.',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $credits_count = $request->user()->credits_remaining;

        if($request->National_Number != 'ABC123456789') {
            if($credits_count == 0){
                return response()->json(['status' => 'Your account dosn\'t have any credits']);
            }
        }

        $search_result = array();
        $parent_data = DB::table('m_record_databank_perm AS a')
            ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
            ->leftjoin('f_branch_table AS c', 'a.Branch', 'c.id')
            ->where('a.DOB', $request->dob)
            ->where('a.parent_id', '0')
            ->where('a.version', '>', '0')
            ->where(DB::raw('(a.NI_identity_number = "'.$request->National_Number.'"
                            OR a.NI_identity_number = "'.CommonController::EncryptNI($request->National_Number).'"
                            OR a.NI_identity_number = "'.CommonController::DecryptNI($request->National_Number).'")'))
            ->select('a.*', 'b.ocb_name', 'b.website', DB::raw("CASE WHEN c.branch_name is null THEN b.ocb_name ELSE concat(b.ocb_name,'[',c.branch_name,']') END AS created_by"))
            ->get();

        $parent_data = DB::select("SELECT `a`.*, `b`.`ocb_name`, `b`.`website`,
                                        CASE WHEN c.branch_name IS NULL
                                        THEN b.ocb_name
                                        ELSE concat( b.ocb_name, '[', c.branch_name, ']' )
                                        END AS created_by
                                    FROM
                                        `m_record_databank_perm` AS `a`
                                        LEFT JOIN `e_cbr_table` AS `b` ON `a`.`CBR_id` = `b`.`id`
                                        LEFT JOIN `f_branch_table` AS `c` ON `a`.`Branch` = `c`.`id`
                                    WHERE
                                        `a`.`DOB` = '".$request->dob."'
                                        AND `a`.`parent_id` = 0
                                        AND `a`.`version` > 0
                                        AND ( a.NI_identity_number = '".$request->National_Number."'
                                        OR a.NI_identity_number = '".CommonController::EncryptNI($request->National_Number)."'
                                        OR a.NI_identity_number = '".CommonController::DecryptNI($request->National_Number)."')");

        if(count($parent_data) > 0) {
            foreach ($parent_data as $item) {
                $max_version = DB::table('m_record_databank_perm AS a')
                    ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                    ->leftjoin('f_branch_table AS c', 'a.Branch', 'c.id')
                    ->where('a.DOB', $request->dob)
                    ->where('a.parent_id', $item->id)
                    ->where('a.version', '>', '0')
                    ->whereIn('a.NI_identity_number', [$request->National_Number, CommonController::EncryptNI($request->National_Number), CommonController::DecryptNI($request->National_Number)])
                    ->orderBy('a.version', 'desc')
                    ->select('a.*', 'b.ocb_name', 'b.website', DB::raw("CASE WHEN c.branch_name is null THEN b.ocb_name ELSE concat(b.ocb_name,'[',c.branch_name,']') END AS created_by"))
                    ->get();
                $max_version = DB::select("SELECT
                                            `a`.*,
                                            `b`.`ocb_name`,
                                            `b`.`website`,
                                            CASE
                                                WHEN c.branch_name IS NULL THEN
                                                b.ocb_name ELSE concat( b.ocb_name, '[', c.branch_name, ']' )
                                            END AS created_by
                                        FROM
                                            `m_record_databank_perm` AS `a`
                                            LEFT JOIN `e_cbr_table` AS `b` ON `a`.`CBR_id` = `b`.`id`
                                            LEFT JOIN `f_branch_table` AS `c` ON `a`.`Branch` = `c`.`id`
                                        WHERE
                                            `a`.`DOB` = '".$request->dob."'
                                            AND `a`.`parent_id` = '".$item->id."'
                                            AND `a`.`version` > 0
                                            AND (`a`.`NI_identity_number` = '".$request->National_Number."'
                                            OR `a`.`NI_identity_number` = '".CommonController::EncryptNI($request->National_Number)."'
                                            OR `a`.`NI_identity_number` = '".CommonController::DecryptNI($request->National_Number)."')
                                        ORDER BY
                                            `a`.`version` DESC");

                $item_child = array();
                $child_record_added = 0;
                if(count($max_version) > 0) {
                    foreach ($max_version as $key => $child) {
                        if(json_decode($item->RECORD_content) == null) {
                            $child->RECORD_content = str_replace('{"', '', $child->RECORD_content);
                            $child->RECORD_content = str_replace('"}', '', $child->RECORD_content);
                        } else {
                            $content = '';

                            foreach (json_decode($child->RECORD_content) as $key => $value) {
                                $content .= $key.': <br> ';
                                $content .= $value.' <br>';
                            }

                            $item->RECORD_content = $content;
                            // dd($content);
                        }

                        if(strlen($child->NI_identity_number) == Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                            $child->National_Number = $child->NI_identity_number;
                        } else {
                            $child->National_Number = CommonController::DecryptNI($child->NI_identity_number);
                        }

                        unset($child->connection_type);
                        unset($child->NI_identity_number);
                        unset($child->IP_address);
                        unset($child->API_Activity_ID);
                        unset($child->HRIS_id);
                        unset($child->status);
                        $child_record_pattern_array = (object)array();
                        $child_record_pattern_array->RDB_record_unique_id = $child->id;

                        if($request->National_Number != 'ABC123456789') {
                            $child_record_pattern_array->Record_creators_CBR_id = $child->CBR_id;
                            $child_record_pattern_array->Record_creators_website = $child->website;
                            $child_record_pattern_array->ocb_name = $child->ocb_name;
                        } else {
                            $child_record_pattern_array->Record_creators_CBR_id = "RU000000";
                            $child_record_pattern_array->Record_creators_website = "www.marspartnersltd.ccc";
                            $child_record_pattern_array->ocb_name = 'Mars Partners Ltd';
                        }

                        $child_record_pattern_array->Branch = $child->Branch;
                        $child_record_pattern_array->National_Number = $child->National_Number;
                        $child_record_pattern_array->DOB = $child->DOB;
                        $child_record_pattern_array->record_type = $child->record_type;
                        $child_record_pattern_array->record_date = $child->record_date;
                        $child_record_pattern_array->RECORD_content = $child->RECORD_content;
//                    $child_record_pattern_array->parent_id = $child->parent_id;
//                    $child_record_pattern_array->version = $child->version;
                        $child_record_pattern_array->time_stamp = $child->time_stamp;
//                    array_push($item_child, $child_record_pattern_array);
                        array_push($search_result,$child_record_pattern_array);
                        $child_record_added = 1;

                        break;
                    }
                }

                if($child_record_added == 1) {
                    continue;
                }

                if(json_decode($item->RECORD_content) == null) {
                    $item->RECORD_content = str_replace('{"', '', $item->RECORD_content);
                    $item->RECORD_content = str_replace('"}', '', $item->RECORD_content);
                } else {
                    $content = '';

                    foreach (json_decode($item->RECORD_content) as $key => $value) {
                        $content .= $key.': <br> ';
                        $content .= $value.' <br>';
                    }
                    $item->RECORD_content = $content;
                }

                if(strlen($item->NI_identity_number) == Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                    $item->National_Number = $item->NI_identity_number;
                } else {
                    $item->National_Number = CommonController::DecryptNI($item->NI_identity_number);
                }

                unset($item->connection_type);
                unset($item->NI_identity_number);
                unset($item->IP_address);
                unset($item->API_Activity_ID);
                unset($item->HRIS_id);
                unset($item->status);
                $record_pattern_array = (object)array();
                $record_pattern_array->RDB_record_unique_id = $item->id;

                if($request->National_Number != 'ABC123456789') {
                    $record_pattern_array->Record_creators_CBR_id = $item->CBR_id;
                    $record_pattern_array->Record_creators_website = $item->website;
                    $record_pattern_array->ocb_name = $item->ocb_name;
                } else {
                    $record_pattern_array->Record_creators_CBR_id = "RU000000";
                    $record_pattern_array->Record_creators_website = "www.marspartnersltd.ccc";
                    $record_pattern_array->ocb_name = 'Mars Partners Ltd';
                }

                $record_pattern_array->Branch = $item->Branch;
                $record_pattern_array->National_Number = $item->National_Number;
                $record_pattern_array->DOB = $item->DOB;
                $record_pattern_array->record_type = $item->record_type;
                $record_pattern_array->record_date = $item->record_date;
                $record_pattern_array->RECORD_content = $item->RECORD_content;
                $record_pattern_array->time_stamp = $item->time_stamp;
                array_push($search_result, $record_pattern_array);

            }
        } else {
            $citizen_info = CUR_table::where('replacement_search_number', $request->National_Number)->first();

            if($citizen_info) {
                $NI_number = $citizen_info->NI_identity_number;

                if(strlen($NI_number) != $min_num ) {
                    $NI_number = CommonController::DecryptNI($NI_number);
                }

                $parent_data = DB::select("SELECT `a`.*, `b`.`ocb_name`, `b`.`website`,
                                        CASE WHEN c.branch_name IS NULL
                                        THEN b.ocb_name
                                        ELSE concat( b.ocb_name, '[', c.branch_name, ']' )
                                        END AS created_by
                                    FROM
                                        `m_record_databank_perm` AS `a`
                                        LEFT JOIN `e_cbr_table` AS `b` ON `a`.`CBR_id` = `b`.`id`
                                        LEFT JOIN `f_branch_table` AS `c` ON `a`.`Branch` = `c`.`id`
                                    WHERE
                                        `a`.`DOB` = '".$request->dob."'
                                        AND `a`.`parent_id` = 0
                                        AND `a`.`version` > 0
                                        AND ( a.NI_identity_number = '".$NI_number."'
                                        OR a.NI_identity_number = '".CommonController::EncryptNI($NI_number)."')");

                foreach ($parent_data as $item) {
                    $max_version = DB::table('m_record_databank_perm AS a')
                        ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                        ->leftjoin('f_branch_table AS c', 'a.Branch', 'c.id')
                        ->where('a.DOB', $request->dob)
                        ->where('a.parent_id', $item->id)
                        ->where('a.version', '>', '0')
                        ->whereIn('a.NI_identity_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                        ->orderBy('a.version', 'desc')
                        ->select('a.*', 'b.ocb_name', 'b.website', DB::raw("CASE WHEN c.branch_name is null THEN b.ocb_name ELSE concat(b.ocb_name,'[',c.branch_name,']') END AS created_by"))
                        ->get();
                    $max_version = DB::select("SELECT
                                            `a`.*,
                                            `b`.`ocb_name`,
                                            `b`.`website`,
                                            CASE
                                                WHEN c.branch_name IS NULL THEN
                                                b.ocb_name ELSE concat( b.ocb_name, '[', c.branch_name, ']' )
                                            END AS created_by
                                        FROM
                                            `m_record_databank_perm` AS `a`
                                            LEFT JOIN `e_cbr_table` AS `b` ON `a`.`CBR_id` = `b`.`id`
                                            LEFT JOIN `f_branch_table` AS `c` ON `a`.`Branch` = `c`.`id`
                                        WHERE
                                            `a`.`DOB` = '".$request->dob."'
                                            AND `a`.`parent_id` = '".$item->id."'
                                            AND `a`.`version` > 0
                                            AND (`a`.`NI_identity_number` = '".$NI_number."'
                                            OR `a`.`NI_identity_number` = '".CommonController::EncryptNI($NI_number)."')
                                        ORDER BY
                                            `a`.`version` DESC");

                    $item_child = array();
                    $child_record_added = 0;
                    if(count($max_version) > 0) {
                        foreach ($max_version as $key => $child) {
                            if(json_decode($item->RECORD_content) == null) {
                                $child->RECORD_content = str_replace('{"', '', $child->RECORD_content);
                                $child->RECORD_content = str_replace('"}', '', $child->RECORD_content);
                            } else {
                                $content = '';
                                foreach (json_decode($child->RECORD_content) as $key => $value) {
                                    $content .= $key.': <br> ';
                                    $content .= $value.' <br>';
                                }
                                $item->RECORD_content = $content;
                                // dd($content);
                            }

                            if(strlen($child->NI_identity_number) == Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                                $child->National_Number = $request->National_Number;
                            } else {
                                $child->National_Number = $request->National_Number;
                            }

                            unset($child->connection_type);
                            unset($child->NI_identity_number);
                            unset($child->IP_address);
                            unset($child->API_Activity_ID);
                            unset($child->HRIS_id);
                            unset($child->status);
                            $child_record_pattern_array = (object)array();
                            $child_record_pattern_array->RDB_record_unique_id = $child->id;

                            if($request->National_Number != 'ABC123456789') {
                                $child_record_pattern_array->Record_creators_CBR_id = $child->CBR_id;
                                $child_record_pattern_array->Record_creators_website = $child->website;
                                $child_record_pattern_array->ocb_name = $child->ocb_name;
                            } else {
                                $child_record_pattern_array->Record_creators_CBR_id = "RU000000";
                                $child_record_pattern_array->Record_creators_website = "www.marspartnersltd.ccc";
                                $child_record_pattern_array->ocb_name = 'Mars Partners Ltd';
                            }

                            $child_record_pattern_array->Branch = $child->Branch;
                            $child_record_pattern_array->National_Number = $child->National_Number;
                            $child_record_pattern_array->DOB = $child->DOB;
                            $child_record_pattern_array->record_type = $child->record_type;
                            $child_record_pattern_array->record_date = $child->record_date;
                            $child_record_pattern_array->RECORD_content = $child->RECORD_content;
//                    $child_record_pattern_array->parent_id = $child->parent_id;
//                    $child_record_pattern_array->version = $child->version;
                            $child_record_pattern_array->time_stamp = $child->time_stamp;
//                    array_push($item_child, $child_record_pattern_array);
                            array_push($search_result,$child_record_pattern_array);
                            $child_record_added = 1;

                            break;
                        }
                    }

                    if($child_record_added == 1) {
                        continue;
                    }

                    if(json_decode($item->RECORD_content) == null) {
                        $item->RECORD_content = str_replace('{"', '', $item->RECORD_content);
                        $item->RECORD_content = str_replace('"}', '', $item->RECORD_content);
                    } else {
                        $content = '';

                        foreach (json_decode($item->RECORD_content) as $key => $value) {
                            $content .= $key.': <br> ';
                            $content .= $value.' <br>';
                        }
                        $item->RECORD_content = $content;
                    }

                    if(strlen($item->NI_identity_number) == Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                        $item->National_Number = $request->National_Number;
                    } else {
                        $item->National_Number = $request->National_Number;
                    }

                    unset($item->connection_type);
                    unset($item->NI_identity_number);
                    unset($item->IP_address);
                    unset($item->API_Activity_ID);
                    unset($item->HRIS_id);
                    unset($item->status);
                    $record_pattern_array = (object)array();
                    $record_pattern_array->RDB_record_unique_id = $item->id;

                    if($request->National_Number != 'ABC123456789') {
                        $record_pattern_array->Record_creators_CBR_id = $item->CBR_id;
                        $record_pattern_array->Record_creators_website = $item->website;
                        $record_pattern_array->ocb_name = $item->ocb_name;
                    } else {
                        $record_pattern_array->Record_creators_CBR_id = "RU000000";
                        $record_pattern_array->Record_creators_website = "www.marspartnersltd.ccc";
                        $record_pattern_array->ocb_name = 'Mars Partners Ltd';
                    }

                    $record_pattern_array->Branch = $item->Branch;
                    $record_pattern_array->National_Number = $item->National_Number;
                    $record_pattern_array->DOB = $item->DOB;
                    $record_pattern_array->record_type = $item->record_type;
                    $record_pattern_array->record_date = $item->record_date;
                    $record_pattern_array->RECORD_content = $item->RECORD_content;
                    $record_pattern_array->time_stamp = $item->time_stamp;
                    array_push($search_result, $record_pattern_array);

                }

                if($request->National_Number != 'ABC123456789') {
                    if(count($search_result) > 0) {
                        $balance = Auth()->user()->credits_remaining - 1;

                        $today = strtotime(date('Y-m-d'));
                        $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                        $match = DB::table('g_credit_usage_history')
                            ->where('CBR_id', Auth::user()->id)
                            ->where('time_stamp','>', $six_month_ago)
                            ->whereIn('NI_Insurance_Number', [$NI_number, CommonController::EncryptNI($NI_number)])
                            ->exists();

                        $match = DB::select("SELECT
                                        *
                                    FROM
                                        `g_credit_usage_history`
                                    WHERE
                                        `CBR_id` = '".Auth::user()->id."'
                                        AND `time_stamp` > '".$six_month_ago."'
                                        AND (`NI_Insurance_Number` = '".$NI_number."'
                                        OR `NI_Insurance_Number` = '".CommonController::EncryptNI($NI_number)."')");

                        if(!$match)
                        {
                            $api_session_data = Api_Session::find($request->user()->token()->id);

                            User::Where('id', Auth::user()->id)->update(['credits_remaining' => $balance]);
                            Credits::Insert([
                                'CBR_id' => Auth::user()->id,
                                'cohort_id' => Auth::user()->cohort_id,
                                'adjustment_value' => '0',
                                'balance' => $balance,
                                'time_stamp' => date('Y-m-d H:i:s'),
                                'NI_Insurance_Number' => CommonController::EncryptNI($NI_number),
                                'branch_id' => $api_session_data->branch_id,
                            ]);

                        }

                        if($balance < 3) {
                            $data = Email::find('11');

                            $user = Auth::user();
                            $to_email = $user->email;

                            if($user->user_type == 'citizen') {
                                $user_data = CUR_table::find($user->id);
                                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                            } else {
                                $cbr_data = CBR_table::find($user->id);
                                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                            }

                            $this->email_send($data, $to_email, $full_name);
                        }

                        if($balance == 0) {
                            $data = User::find(Auth::user()->id);
                            $data->credits_zero_date = date('Y-m-d H:i:s');
                            $data->update();
                            //                    User::where('id', Auth::user()->id)->update(['credits_zero_date', date('Y-m-d H:i:s')]);
                        }

                        $data = Email::find('150');

                        $user = Auth::user();

                        $today = date_create();
                         date_modify($today, "-4 weeks");
//                        date_modify($today, "-10 minutes");
                        $today = date_format($today, "Y-m-d H:i:s");
                        $today_time = strtotime($today);
                        $refer_sent_on = strtotime($user->refer_sent_on);

                        if($refer_sent_on < $today_time) {
                            $to_email = $user->email;

                            if($user->user_type == 'citizen') {
                                $user_data = CUR_table::find($user->id);
                                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                            } else {
                                $cbr_data = CBR_table::find($user->id);
                                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                            }

                            if($this->email_send($data, $to_email, $full_name)) {
                                $user_info = User::find($user->id);
                                $user_info->refer_sent_on = date('Y-m-d H:i:s');
                                $user_info->update();
                            }

                        }

                    } else {
                        return response()->json(['status' => 'There is no data to show.']);
                    }
                } else {
                    if(count($search_result) > 0) {
                        $data = Email::find('149');

                        $user = Auth::user();

                        $today = date_create();
                         date_modify($today, "-4 weeks");
//                        date_modify($today, "-10 minutes");
                        $today = date_format($today, "Y-m-d H:i:s");
                        $today_time = strtotime($today);
                        $refer_sent_on = strtotime($user->refer_sent_on);

                        if($refer_sent_on < $today_time) {
                            $to_email = $user->email;

                            if($user->user_type == 'citizen') {
                                $user_data = CUR_table::find($user->id);
                                $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                            } else {
                                $cbr_data = CBR_table::find($user->id);
                                $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                            }

                            if($this->email_send($data, $to_email, $full_name)) {
                                $user_info = User::find($user->id);
                                $user_info->refer_sent_on = date('Y-m-d H:i:s');
                                $user_info->update();
                            }

                        }
                    }
                }

                return response()->json(['data' => $search_result, 'status' => 'success']);
            }
        }

        if($request->National_Number != 'ABC123456789') {
            if(count($search_result) > 0) {
                $balance = Auth()->user()->credits_remaining - 1;

                $today = strtotime(date('Y-m-d'));
                $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                $match = DB::table('g_credit_usage_history')
                    ->where('CBR_id', Auth::user()->id)
                    ->where('time_stamp','>', $six_month_ago)
                    ->whereIn('NI_Insurance_Number', [$request->National_Number, CommonController::DecryptNI($request->National_Number), CommonController::EncryptNI($request->National_Number)])
                    ->exists();

                $match = DB::select("SELECT
                                        *
                                    FROM
                                        `g_credit_usage_history`
                                    WHERE
                                        `CBR_id` = '".Auth::user()->id."'
                                        AND `time_stamp` > '".$six_month_ago."'
                                        AND (`NI_Insurance_Number` = '".$request->National_Number."'
                                        OR `NI_Insurance_Number` = '".CommonController::DecryptNI($request->National_Number)."'
                                        OR `NI_Insurance_Number` = '".CommonController::EncryptNI($request->National_Number)."')");

                if(!$match)
                {
                    $api_session_data = Api_Session::find($request->user()->token()->id);

                    User::Where('id', Auth::user()->id)->update(['credits_remaining' => $balance]);
                    Credits::Insert([
                        'CBR_id' => Auth::user()->id,
                        'cohort_id' => Auth::user()->cohort_id,
                        'adjustment_value' => '0',
                        'balance' => $balance,
                        'time_stamp' => date('Y-m-d H:i:s'),
                        'NI_Insurance_Number' => CommonController::EncryptNI($request->National_Number),
                        'branch_id' => $api_session_data->branch_id,
                    ]);

                }

                if($balance < 3) {
                    $data = Email::find('11');

                    $user = Auth::user();
                    $to_email = $user->email;

                    if($user->user_type == 'citizen') {
                        $user_data = CUR_table::find($user->id);
                        $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                    } else {
                        $cbr_data = CBR_table::find($user->id);
                        $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                    }

                    $this->email_send($data, $to_email, $full_name);
                }

                if($balance == 0) {
                    $data = User::find(Auth::user()->id);
                    $data->credits_zero_date = date('Y-m-d H:i:s');
                    $data->update();
//                    User::where('id', Auth::user()->id)->update(['credits_zero_date', date('Y-m-d H:i:s')]);
                }

                $data = Email::find('150');

                $user = Auth::user();

                $today = date_create();
                 date_modify($today, "-4 weeks");
//                date_modify($today, "-10 minutes");
                $today = date_format($today, "Y-m-d H:i:s");
                $today_time = strtotime($today);
                $refer_sent_on = strtotime($user->refer_sent_on);

                if($refer_sent_on < $today_time) {
                    $to_email = $user->email;

                    if($user->user_type == 'citizen') {
                        $user_data = CUR_table::find($user->id);
                        $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                    } else {
                        $cbr_data = CBR_table::find($user->id);
                        $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                    }

                    if($this->email_send($data, $to_email, $full_name)) {
                        $user_info = User::find($user->id);
                        $user_info->refer_sent_on = date('Y-m-d H:i:s');
                        $user_info->update();
                    }
                }

            } else {
                return response()->json(['status' => 'There is no data to show.']);
            }
        } else {
            if(count($search_result) > 0) {
                $data = Email::find('149');

                $user = Auth::user();

                $today = date_create();
                 date_modify($today, "-4 weeks");
//                date_modify($today, "-10 minutes");
                $today = date_format($today, "Y-m-d H:i:s");
                $today_time = strtotime($today);
                $refer_sent_on = strtotime($user->refer_sent_on);

                if($refer_sent_on < $today_time) {
                    $to_email = $user->email;

                    if($user->user_type == 'citizen') {
                        $user_data = CUR_table::find($user->id);
                        $full_name = ucwords($user_data->firstname).' '.ucwords($user_data->lastname);
                    } else {
                        $cbr_data = CBR_table::find($user->id);
                        $full_name = ucwords($cbr_data->lrd_firstname).' '.ucwords($cbr_data->lrd_lastname);
                    }

                    if($this->email_send($data, $to_email, $full_name)) {
                        $user_info = User::find($user->id);
                        $user_info->refer_sent_on = date('Y-m-d H:i:s');
                        $user_info->update();
                    }

                }
            }
        }

        return response()->json(['data' => $search_result, 'status' => 'success']);
    }

    public function request_record_unlock(Request $request)
    {
        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;

        $rules = array(
            'National_Number' => 'required|min:'.$min_num,
            'dob' => 'required',
        );

        $messages = array(
            'National_Number.min' => 'The Personal Identification Number for the Russia is set so it must be at least '.$min_num.' characters long.',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->National_Number == 'ABC123456789') {
            return response()->json(['errors' => ['This test number is internally controlled and cannot be added to ABC123456789']]);
        }

        $lock_citizen_info = DB::table('d_cur_table')
            ->whereIn('NI_identity_number', [$request->National_Number, CommonController::DecryptNI($request->National_Number), CommonController::EncryptNI($request->National_Number)])
            ->where('DOB', $request->dob)
            ->first();

        if(!is_null($lock_citizen_info)) {
            $user = User::findOrFail($request->CBR_id);

            $cbr_data = CBR_table::find($user->id);
            $full_name = ucwords($cbr_data->ocb_name);
            $email_sent_status = 'false';

            $citizen = CUR_table::find($lock_citizen_info->id);

            if($citizen->record_lock == '0') {
                $flag = CUR_table::where('id', $citizen->id)->where('requested_business_id', $request->CBR_id)->exists();

                if($flag) {
                    return response()->json(['status' => 'Unlock Successfully']);
                } else {
                    return response()->json(['status' => 'Failed. Already unlock']);
                }

            } else if($citizen->record_lock == '1') {
                $citizen->record_lock = '2';
                $citizen->requested_business_id = $user->id;
                $citizen->update();

                $citizen_user = User::findOrFail($citizen->id);

                $data = Email::find('154');

                $to_email = $citizen_user->email;

                if($this->unlock_email_send($data, $to_email, $full_name, $citizen_user->token_key)) {
                    $citizen_user->lock_sent_on = date('Y-m-d H:i:s');
                    $citizen_user->update();

                    $email_sent_status = 'true';
                }

                $data = Email::find('152');
                $citizen = CUR_table::find($lock_citizen_info->id);
                $full_name = ucwords($citizen->firstname).' '.ucwords($citizen->lastname);
                $to_email = $user->email;


                if($this->unlock_email_send($data, $to_email, $full_name)) {
                    $email_sent_status = 'true';
                }

                return response()->json(['status' => 'Requested Successfully']);
            } else {
                return response()->json(['status' => 'Pending']);
            }

        } else {
            return response()->json(['status' => 'No Exists']);
        }

    }

    public function rate_record(Request $request)
    {
        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;

        $rules = array(
            'National_Number' => 'required|min:'.$min_num,
            'rating_number' => 'required|min:0|max:10',
            'dob' => 'required',
        );

        $messages = array(
            'National_Number.min' => 'The Personal Identification Number for the Russia is set so it must be at least '.$min_num.' characters long.',
            'rating_number.min' => 'The rating number is at least 0',
            'rating_number.max' => 'The rating number is 10 as max',
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->National_Number == 'ABC123456789') {
            return response()->json(['errors' => ['This test number is internally controlled and cannot be added to ABC123456789']]);
        }

        $previous_business_list = DB::table('m_record_databank_perm AS a')
            ->whereIn('a.NI_identity_number', [$request->National_Number, CommonController::DecryptNI($request->National_Number), CommonController::EncryptNI($request->National_Number)])
            ->where('a.DOB', $request->dob)
            ->where('a.parent_id', '0')
            ->where('a.CBR_id', $request->previous_employer_id)
            ->where('a.CBR_id', '!=', $request->CBR_id)
            ->where('a.version', '>', '0')
            ->groupby('a.CBR_id')
            ->select('a.CBR_id')
            ->get();

        if(count($previous_business_list) > 0) {
            $today = strtotime(date('Y-m-d'));
            $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
            $match = DB::table('g_credit_usage_history')
                ->where('CBR_id', $request->CBR_id)
                ->where('branch_id', null)
                ->whereIn('NI_Insurance_Number', [$request->National_Number, CommonController::DecryptNI($request->National_Number), CommonController::EncryptNI($request->National_Number)])
                ->where('time_stamp', '>', $six_month_ago)
                ->exists();

            if(!$match) {
                Rating_history::where('current_business_id', $request->CBR_id)
                    ->where('previous_business_id', $request->previous_employer_id)
                    ->where('NI_number', $request->National_Number)
                    ->where('branch_id', null)
                    ->update(['current_rating_flag' => '0']);

                Rating_history::Insert([
                    'current_business_id' => $request->CBR_id,
                    'previous_business_id' => $request->previous_employer_id,
                    'NI_number' => $request->National_Number,
                    'rating_number' => $request->rating_number,
                    'created_at' => date('Y-m-d H:i:s'),
                    'rated_date' => date('Y-m-d H:i:s'),
                    'current_rating_flag' => '1'
                ]);

                return response()->json(['status' => 'Rated Successfully']);
            } else {
                return response()->json(['status' => 'Already rated. You can rate after six months']);
            }
        } else {
            $citizen_info = CUR_table::where('replacement_search_number', $request->National_Number)->first();

            if($citizen_info) {
                $NI_number = $citizen_info->NI_identity_number;

                if(strlen($NI_number) != $min_num) {
                    $NI_number = CommonController::DecryptNI($NI_number);
                }

                $previous_business_list = DB::table('m_record_databank_perm AS a')
                    ->whereIn('a.NI_identity_number', [$NI_number, CommonController::EncryptNI($NI_number)])
                    ->where('a.DOB', $request->dob)
                    ->where('a.CBR_id', $request->previous_employer_id)
                    ->where('a.CBR_id', '!=', $request->CBR_id)
                    ->where('a.parent_id', '0')
                    ->where('a.version', '>', '0')
                    ->groupby('a.CBR_id')
                    ->select('a.CBR_id')
                    ->get();

                $today = strtotime(date('Y-m-d'));
                $six_month_ago = date("Y-m-d", strtotime("-6 month", $today));
                $match = DB::table('g_credit_usage_history')
                    ->where('CBR_id', $request->CBR_id)
                    ->where('branch_id', null)
                    ->whereIn('NI_Insurance_Number', [$NI_number, CommonController::EncryptNI($NI_number)])
                    ->where('time_stamp', '>', $six_month_ago)
                    ->exists();

                if(!$match) {
                    Rating_history::where('current_business_id', $request->CBR_id)
                        ->where('previous_business_id', $request->previous_employer_id)
                        ->where('NI_number', $NI_number)
                        ->where('branch_id', null)
                        ->update(['current_rating_flag' => '0']);

                    Rating_history::Insert([
                        'current_business_id' => $request->CBR_id,
                        'previous_business_id' => $reqeust->previous_employer_id,
                        'NI_number' => $NI_number,
                        'rating_number' => $request->rating_number,
                        'created_at' => date('Y-m-d H:i:s'),
                        'rated_date' => date('Y-m-d H:i:s'),
                        'current_rating_flag' => '1'
                    ]);

                    return response()->json(['status' => 'Rated Successfully']);
                } else {
                    return response()->json(['status' => 'Already rated. You can rate after six months']);
                }
            } else {
                return response()->json(['status' => 'No Exists']);
            }
        }

    }

    public function request_departure_evaluation(Request $request)
    {
        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;

        $rules = array(
            'National_Number' => 'required|min:'.$min_num,
            'dob' => 'required',
            'previous_employer_email' => 'required|email'
        );

        $messages = array(
            'National_Number.min' => 'The Personal Identification Number for the Russia is set so it must be at least '.$min_num.' characters long.',
            'previous_employer_email.email' => 'Invalid email'
        );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->National_Number == 'ABC123456789') {
            return response()->json(['errors' => ['This test number is internally controlled and cannot be added to ABC123456789']]);
        }

        $form_data = array(
            'CBR_id' => $request->CBR_id,
            'applicant_name' =>  $request->applicant_name,
            'business_name' =>  $request->previous_employer_business_name,
            'receiver_email' => $request->previous_employer_email,
            'gov_number' => $request->National_Number,
            'dob' => $request->dob,
            'status' => '0',
            'created_at'=>date('Y-m-d H:i:s'),
        );

        if($request->request_id) {
            $request_dep = Request_dep_eva_history::find($request->request_id);

            if(is_null($request_dep)) {
                return response()->json(['status' => ['No Exists']]);
            }

            if($request_dep->status == '0') {
                return response()->json(['status' => ['pending']]);
            } else if($request_dep->status == '1') {
                return response()->json(['status' => ['not available']]);
            } else if($request_dep->status == '2') {
                return response()->json(['status' => ['complete']]);
            }

        } else {
            Request_dep_eva_history::Insert($form_data);
            $request_id = DB::getPDO()->lastInsertId();

            $user = User::findOrFail($request->CBR_id);
            $cbr_info = CBR_table::findOrFail($request->CBR_id);

            $data = Email::find('156');

            $to_email = $user->email;
            $email_address = $request->previous_employer_email;
            $applicant_name = $request->applicant_name;
            $business_name = $cbr_info->ocb_name;


            if($this->departure_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)) {
                $data = Email::find('159');
                $to_email = $email_address;

                if($this->departure_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)) {
                    $request_dep = Request_dep_eva_history::find($request_id);

                    $request_dep->created_at = date('Y-m-d H:i:s');
                    $request_dep->update();

                }

            }

            return response()->json(['status' => 'Requested successfully.', 'request_id' => $request_id]);
        }


    }

    public function email_send($data, $to_email, $full_name)
    {
        if(!$data) return false;

        $data->content = str_replace("[name_here]", $full_name, $data->content);
        $content['content'] = $data->content;
        $title = $full_name;
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


    public function unlock_email_send($data, $to_email, $full_name, $user_token = null)
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

    public function departure_email_send($data, $to_email, $business_name, $applicant_name, $email_address, $request_id)
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
}
