<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\CommonController;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\RDB_perm;
use App\RDB;
use App\CUR_table;
use App\Credits;
use App\Record_check_rule;
use App\RecordImport;
use App\Api_Session;
use Lcobucci\JWT\Parser;
use App\Country_spec_info;
use Illuminate\Support\Str;
class RecordController extends Controller
{

    public function InsertMultiRecords(Request $request)
    {
        $token = $request->user()->token()->id;
        $rules = array(
            'data' => 'required',
            // 'API_Activity_ID' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = json_decode($request->data);

        $min_num = Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number');

        // validation loop //
        foreach ($data as $item) {
            $rules = array('National_Number' => 'required|min:'.$min_num);
            $messages = array(
                'National_Number.min' => 'The National Insurance number for the UK is set so it must be at least '.$min_num.' characters long.',
            );
            $array['National_Number'] = $item->National_Number;
            $error = Validator::make($array, $rules, $messages);

            if($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            if($item->National_Number == 'ABC123456') {
                return response()->json(['errors' => ['This test number is internally controlled and cannot be added to ABC123456']]);
            }

            $item->record_content = str_replace("{", '', $item->record_content);
            $item->record_content = str_replace("}", '', $item->record_content);
//            return response()->json(['error' => strpos($item->record_content,'</p>')=== false || strpos($item->record_content,'</p>') < (strlen($item->record_content)-5)]);
            if(strpos($item->record_content,'<p>') === false || strpos($item->record_content,'<p>') > 0) {
                if (strpos($item->record_content, 'p>') === 0) {
                    return response()->json(['error' => 'the < is missing making the tag incomplete']);
                }

                if(
                    strpos($item->record_content,'</p>') === false ||
                    strpos($item->record_content,'</p>',strlen($item->record_content) - 5) < (strlen($item->record_content) - 5)
                ) {
                    return response()->json(['error' => '<p> </p> tags are missing ']);
                }

                return response()->json(['error'=>'"<p>" tag is missing ']);
            }

            if(
                strpos($item->record_content,'</p>') === false ||
                strpos($item->record_content,'</p>',strlen($item->record_content) - 5) < (strlen($item->record_content) - 5)
            ) {

                return response()->json(['error'=>'</p> tag is missing ']);
            }

            if(!$this->closetags($item->record_content)) {
                return response()->json(['error'=>'<p> </p> tags are not matched']);
            }

            if(strpos($item->record_content,'<br><br><br>')) {
                return response()->json(['error' => 'theres too many break tags']);
            }

            /// check record country id
            if($item->RDB_record_unique_id != '' && substr($item->RDB_record_unique_id, 0, 2) != Country_spec_info::value('country_ID')) {
                return response()->json(['error'=>'Record\'s country id is false']);
            }
        }

        $response = array();
        foreach ($data as $item) {
            $item->record_content = str_replace("{", '', $item->record_content);
            $item->record_content = str_replace("}", '', $item->record_content);
            $save_data = [
                'NI_identity_number' => $item->National_Number,
                'DOB' => $item->DOB,
                'CBR_id' => $request->user()->id,
                'id' => $item->RDB_record_unique_id,
                'security_number' => $item->security_number,
                'record_type' => $item->record_type,
                'record_date' => $item->record_date,
                'record_content' => str_replace("`", '"', $item->record_content),
                'creators_record_unique_id' => $item->creators_record_unique_id,
                // 'API_Activity_ID'=>$request->API_Activity_ID
                'API_Activity_ID' => $token,
            ];
            array_push($response, $this->save_data($save_data));
        }

        return response()->json(['data' => $response]);
    }

    private function save_data($data)
    {
        $api_session_data = Api_Session::find($data['API_Activity_ID']);

        $form_data = array(
            'CBR_id' => $data['CBR_id'],
            'NI_identity_number' => CommonController::EncryptNI($data['NI_identity_number']),
            'DOB' => $data['DOB'],
            'record_type' => $data['record_type'],
            'record_date' => $data['record_date'],
            'RECORD_content' => $data['record_content'],
            'Creators_record_unique_id' => $data['creators_record_unique_id'],
            'parent_id' => '0',
            'connection_type' => 'API',
            'time_stamp' => date('Y-m-d H:i:s'),
            'version' => '1',
            'IP_address' => $_SERVER['REMOTE_ADDR'],
            'status' => null,
            'API_Activity_ID' => $data['API_Activity_ID'],
            'Branch' => $api_session_data->branch_id,
            'HRIS_id' => $api_session_data->hris_id,
            'security_number' => Str::random(10),
        );
        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id)-2) AS int)) AS MaxNum
                                FROM (  SELECT id FROM l_record_databank_temp
                                        UNION ALL
                                        SELECT id FROM m_record_databank_perm
                                    ) a')[0]->MaxNum;

        if($maxId == '') $maxId = 7145678;
        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);

        // $max_id = RDB_perm::max('id');
        // $max_id_temp = RDB::max('id');
        // if($max_id > $max_id_temp)
        //     $form_data['id']=$max_id+1;
        // else
            // $form_data['id']=$max_id_temp + 1;
        $form_data['id'] = $newId;

        //// version update /////
        if($data['id'] != '') {
            if(RDB::where('id', $data['id'])
                ->where('CBR_id', $form_data['CBR_id'])
                ->where('HRIS_id', $form_data['HRIS_id'])
                ->where('Branch', $form_data['Branch'])
                ->exists()) {
                $version_data = RDB::whereId($data['id'])->first();
            } else if(RDB_perm::where('id', $data['id'])
                ->where('CBR_id', $form_data['CBR_id'])
                ->where('HRIS_id', $form_data['HRIS_id'])
                ->where('Branch', $form_data['Branch'])
                ->exists()) {
                $version_data = RDB_perm::whereId($data['id'])->first();
            }

            if(isset($version_data)) {
                if($version_data->security_number != $data['security_number']) {
                    return array('creators_record_unique_id' => $data['creators_record_unique_id'],
                        'RDB_record_unique_id' => 'Wrong security number.', 'security_number' => '');
                }

                $form_data['version'] = $version_data->version + 1;

                if($version_data->version == 1) {
                    $form_data['parent_id'] = $version_data->id;
                } else {
                    $form_data['parent_id'] = $version_data->parent_id;
                }

                if($version_data->version > 1) {
                    $same_version = RDB_perm::where('parent_id', $version_data->parent_id)
                                            ->where('version', $version_data->version + 1)
                                            ->exists();
                } else {
                    $same_version = RDB_perm::where('parent_id', $version_data->id)
                                            ->exists();
                }

                if($same_version)
                {
                    return array('creators_record_unique_id' => $data['creators_record_unique_id'],
                                'RDB_record_unique_id' => 'This version already exist.', 'security_number' => '');
                }
            } else {
                return array('creators_record_unique_id' => $data['creators_record_unique_id'],
                            'RDB_record_unique_id' => 'This id is not exist.', 'security_number' => '');
            }
        }

        $now = date('Y-m-d H:i:s');
        $two_years_before = date('Y-m-d H:i:s', strtotime($now . "-2 years"));
        $record_date = date('Y-m-d H:i:s', strtotime($data['record_date']));

        if($record_date < $two_years_before) {
            $form_data['status'] = 0; //error - record date over 2 years old

            RDB::Insert($form_data);

            return array('creators_record_unique_id' => $data['creators_record_unique_id'],
                'RDB_record_unique_id' => 'error_record_too_old', 'security_number' => '');
        } else {
            RDB::Insert($form_data);
        }

        // $RDB_id = DB::getPDO()->lastInsertId();
        /// check spam
        if($this->check_spam($newId))
        {
            // $form_data['id']=$newId;
            RDB_perm::Insert($form_data);

            $RDB = RDB::findOrFail($newId);
            $RDB->delete();

            if($form_data['Branch'] != '' && $form_data['Branch'] != null) {
                $citizen_info = CUR_table::where('DOB', $form_data['DOB'])
                                         ->where('NI_identity_number', $form_data['NI_identity_number'])
                                         ->first();

                if($citizen_info) {
                    if($citizen_info->current_past_employers != '' && $citizen_info->current_past_employers != null) {
                        $current_past_employers = $citizen_info->current_past_employers;
                        $current_array = explode(',', $current_past_employers);

                        $same_flag = 0;
                        for($i = 0; $i < count($current_array); $i++) {
                            if($current_array[$i] == $form_data['CBR_id']) {
                                $same_flag++;
                            }
                        }

                        if($same_flag == 0) {
                            $citizen_info->current_past_employers = $current_past_employers.','.$form_data['CBR_id'];
                        }

                        $citizen_info->last_record_created_by = $form_data['CBR_id'];
                    } else {
                        $citizen_info->current_past_employers = $form_data['CBR_id'];
                        $citizen_info->last_record_created_by = $form_data['CBR_id'];
                    }

                    $citizen_info->update();
                }
            } else {
                $citizen_info = CUR_table::where('DOB', $form_data['DOB'])
                                    ->where('NI_identity_number', $form_data['NI_identity_number'])
                                    ->orwhere('NI_identity_number', CommonController::DecryptNI($form_data['NI_identity_number']))
                                    ->orwhere('NI_identity_number', CommonController::EncryptNI($form_data['NI_identity_number']))
                                    ->first();

                if($citizen_info) {
                    if($citizen_info->current_past_employers != '' && $citizen_info->current_past_employers != null) {
                        $current_past_employers = $citizen_info->current_past_employers;
                        $current_array = explode(',', $current_past_employers);

                        $same_flag = 0;
                        for($i = 0; $i < count($current_array); $i++) {
                            if($current_array[$i] == $form_data['CBR_id']) {
                                $same_flag++;
                            }
                        }

                        if($same_flag == 0) {
                            $citizen_info->current_past_employers = $current_past_employers.','.$form_data['CBR_id'];
                        }

                        $citizen_info->last_record_created_by = $form_data['CBR_id'];
                    } else {
                        $citizen_info->current_past_employers = $form_data['CBR_id'];
                        $citizen_info->last_record_created_by = $form_data['CBR_id'];
                    }

                    $citizen_info->update();
                }
            }

        }
        // array_push($insert_ids, $RDB_id);
        return array('creators_record_unique_id' => $data['creators_record_unique_id'],
                      'RDB_record_unique_id' => $newId, 'security_number' => $form_data['security_number'] );

    }

    public function InsertRecordByFile(Request $request)
    {
        if($request->hasFile('csvfile')) {
            // $path = $request->file('csvfile')->getRealPath();
            $array = \Excel::toArray(new RecordImport, request()->file('csvfile'));
            // \Excel::import($data,$path);

            $data = $array[0];

            if (count($data)) {
                for ($i = 1; $i < count($data); $i++) {
                    $form_data = array(
                           'CBR_id' => $request->user()->id,
                            'NI_identity_number' => CommonController::EncryptNI($data[$i][0]),
                            'DOB' => date_format(date_create($data[$i][1]),'Y-m-d'),
                            'record_type' => $data[$i][2],
                            'record_date' => date_format(date_create($data[$i][3]),'Y-m-d'),
                            'RECORD_content' => $data[$i][4],
                            'Creators_record_unique_id' => $data[$i][5],
                            'parent_id' => '0',
                            'time_stamp' => date('Y-m-d H:i:s'),
                            'version' => '1',
                            'IP_address' => $_SERVER['REMOTE_ADDR'],
                            'status' => null,
                            'connection_type' => 'API',
                            'API_Activity_ID' => $data[$i][6],
                         );
                    if (!empty($data)) {
                        $max_id = RDB_perm::max('id');
                        $max_id_temp = RDB::max('id');

                        if($max_id > $max_id_temp) {
                            $form_data['id'] = $max_id + 1;
                        } else {
                            $form_data['id'] = $max_id_temp + 1;
                        }

                        RDB::Insert($form_data);
                        $RDB_id = DB::getPDO()->lastInsertId();

                        /// check spam
                        if($this->check_spam($RDB_id))
                        {
                            $form_data['id'] = $RDB_id;
                            RDB_perm::Insert($form_data);

                            $RDB = RDB::findOrFail($RDB_id);
                            $RDB->delete();
                        }
                    }
                }
            }
        }

        return response()->json(['success' => 'All records are inserted']);
    }

    private function check_spam($id)
    {
        $record_rule = Record_check_rule::all();
        $record_content = RDB::findOrFail($id)->RECORD_content;

        if($this->closetags($record_content) == false){
            return false;
        }

        foreach ($record_rule as $key => $value) {
            if(strstr(strtolower($record_content), strtolower($value->text))) {
                return false;
            }
        }

        return true;
    }

    function closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);

        if(count($closedtags) == $len_opened) {
            return true;
        } else {
            return false;
        }
    }

}
