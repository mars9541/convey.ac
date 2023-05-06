<?php
namespace App\Http\Controllers\Front\Branch;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\RecordType;
use App\Employees;
use App\RDB;
use App\RDB_perm;
use App\RecordHistory;
use App\Country_spec_info;
use App\Record_check_rule;
use App\User;
use App\CUR_table;
use App\RecordTypeMode;
use App\Email;
use App\Branch;
use PDF;
use Mail;
class DirectController extends Controller
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
        if(!session('user'))
            return redirect('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CBR_info = User::findOrFail(session('user')->CBR_id);
        $draft = RDB::where('status', '0')->where('CBR_id', session('user')->CBR_id)->where('Branch', session('user')->id)->first();

        if($draft == null) {
            $draft = (object)array();
            $draft->RECORD_content = '';
            $draft->connection_type = '';
            $draft->NI_identity_number = '';
            $draft->time_stamp = '';
        }

        $NI_min_number = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;

        return view('front.branch.direct-connect', compact('CBR_info', 'draft','NI_min_number'));
    }
////////// new record /////////////
    public function get_employees()
    {
        $data = Employees::where('branch_id', session('user')->id)->get();

        return response()->json(['data' => $data]);
    }


    public function get_record_types()
    {
        if(request()->ajax())
        {
            $data = array();
            $standard_data = RecordType::where('priority','1')->get();
            foreach ($standard_data as $key1 => $value1) {
                $standard_data[$key1]['index']=count($data) + 1;
                array_push($data, $standard_data[$key1]);
            }

            $user_data = RecordType::where('CBR_id',session('user')->CBR_id)->where('priority','2')->get();
            foreach ($user_data as $key => $value) {

                $user_data[$key]['index']=count($data) + 1;
                array_push($data, $user_data[$key]);
            }

            $tabledata['data'] = $data;

            echo json_encode($tabledata);
        }
    }

    public function save_draft(Request $request)
    {
        $rules = array(
            'employee_id' =>'required',
            'record_type_id' =>'required',
            'RECORD_content' =>'required|max:65535 ',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id)-2) AS int)) AS MaxNum
                                FROM (  SELECT id FROM l_record_databank_temp
                                        UNION ALL
                                        SELECT id FROM m_record_databank_perm
                                    ) a')[0]->MaxNum;

        if($maxId=='') $maxId = 0;
        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);

        $form_data = array(
            'id' => $newId,
            'CBR_id' => session('user')->CBR_id,
            'Branch' => session('user')->id,
            'NI_identity_number' =>  $request->employee_id,
            'connection_type' =>  $request->record_type_id,
            'RECORD_content' =>  $request->RECORD_content,
            'time_stamp' => date('Y-m-d H:i:s'),
            'status' => 0
        );

        RDB::where('CBR_id', session('user')->CBR_id)->where('Branch', session('user')->id)->where('status', '0')->delete();
        RDB::Insert($form_data);

        return response()->json(['success' => 'Draft Added successfully.']);
    }

    public function record_add(Request $request)
    {
        $rules = array(
            'employee_id' =>'required',
            'record_type_id' =>'required',
            'RECORD_content' =>'required|max:65535',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id)-2) AS int)) AS MaxNum
                                FROM (  SELECT id FROM l_record_databank_temp
                                        UNION ALL
                                        SELECT id FROM m_record_databank_perm
                                    ) a')[0]->MaxNum;

        if($maxId == '') $maxId = 0;
        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);

        $employee_info = Employees::findOrFail($request->employee_id);

        if(strlen($employee_info->NI_Insurance_Number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
            $employee_info->NI_Insurance_Number = CommonController::DecryptNI($employee_info->NI_Insurance_Number);
        }

        $record_type_info = RecordType::findOrFail($request->record_type_id);

        $form_data = array(
            'id' => $newId,
            'CBR_id' => session('user')->CBR_id,
            'Branch'=> session('user')->id,
            'NI_identity_number' =>  CommonController::EncryptNI($employee_info->NI_Insurance_Number),
            'DOB' =>  $employee_info->date_of_birth,
            'record_type' =>  $record_type_info->record_type,
            'record_date'=>  date('Y-m-d H:i:s'),
            'connection_type' =>'direct connect',
            'RECORD_content'=> $request->RECORD_content,
            'parent_id'=>'0',
            'time_stamp'=>date('Y-m-d H:i:s'),
            'version'=>'1',
            'IP_address'=>$_SERVER['REMOTE_ADDR'],
            'status'=>null,
        );

        if($request->history_id != '')
        {
            if(RDB::whereId($request->history_id)->exists()) {
                $data = RDB::whereId($request->history_id)->first();
            } else if(RDB_perm::whereId($request->history_id)->exists()) {
                $data = RDB_perm::whereId($request->history_id)->first();
            }

            $form_data['version'] = $data->version + 1;

            if($data->version == 1) {
                $form_data['parent_id'] = $data->id;
            } else {
                $form_data['parent_id'] = $data->parent_id;
            }
        } else {
            $citizen_info = CUR_table::where('DOB', $form_data['DOB'])
                ->whereIn('NI_identity_number', [$form_data['NI_identity_number'], CommonController::DecryptNI($form_data['NI_identity_number']), CommonController::EncryptNI($form_data['NI_identity_number'])])
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


        RDB::Insert($form_data);
        // $RDB_id = DB::getPDO()->lastInsertId();
        $record_history_data = array(
            'id' => $newId,
            'NI_identity_number' => CommonController::EncryptNI($employee_info->NI_Insurance_Number),
            'branch_id' => session('user')->id,
            'record_date' => date('Y-m-d H:i:s'),
            'record_type_id' => $request->record_type_id,
            'content' => $request->RECORD_content,
            'time_stamp' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        );
        RecordHistory::Insert($record_history_data);

        /// check spam
        if($this->check_spam($newId))
        {
            $form_data['id'] = $newId;
            RDB_perm::Insert($form_data);

            RDB::where('CBR_id', session('user')->CBR_id)->where('Branch', session('user')->id)->where('status', 0)->delete();

            $RDB = RDB::findOrFail($newId);
            $RDB->delete();
        }

        $citizen = CUR_table::whereIn('NI_identity_number', [$employee_info->NI_Insurance_Number, CommonController::EncryptNI($employee_info->NI_Insurance_Number), CommonController::DecryptNI($employee_info->NI_Insurance_Number)])
            ->where('DOB', $employee_info->date_of_birth)
            ->first();

        if($citizen) {
            //// user info and mail send ///
            $data = Email::find('127');

            $user = User::findOrFail($citizen->id);
            $to_email = $user->email;

            $this->email_send($data, $to_email);
        }

        return response()->json(['success' => 'Record Created successfully.']);
    }

    public function clear_draft(Request $request)
    {
        if(request()->ajax()) {
            RDB::where('CBR_id', session('user')->CBR_id)->where('Branch', session('user')->id)->where('status', 0)->delete();

            return response()->json(['data' => 'Clear draft successfully!!!']);
        }
    }

    public function email_send($data, $to_email)
    {
        if(!$data) return false;

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

    private function check_spam($id)
    {
        $record_rule = Record_check_rule::all();
        $RECORD_content = RDB::findOrFail($id)->RECORD_content;

        foreach ($record_rule as $key => $value) {
            if(strstr(strtolower($RECORD_content), strtolower($value->text))) {
                return false;
            }
        }

        return true;
    }


//////// employees ////////////

    public function employee_list()
    {
        if(request()->ajax())
        {
            $data = Employees::where('branch_id', session('user')->id)->latest()->get();
            $tabledata['data'] = $data;

            echo json_encode($tabledata);
        }
        // return view('ajax_index');
    }

    public function employee_add(Request $request)
    {
        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;
        $rules = array(
            'date_of_birth' =>'required',
            'first_name' =>'required',
            'second_name'=>'required',
            'NI_Insurance_Number'=>'required|not_regex:/\s/i|min:'.$min_num,
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        if($request->NI_Insurance_Number == 'ABC123456')
            return response()->json(['errors' => ['This test number is internally controlled and cannot be added to']]);

        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id) - 2) AS int)) AS MaxNum FROM h_direct_connect_employee')[0]->MaxNum;
        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);

        $form_data = array(
            'id' => $newId,
            'CBR_id' => session('user')->CBR_id,
            'branch_id' => session('user')->id,
            'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'NI_Insurance_Number' => CommonController::EncryptNI($request->NI_Insurance_Number),
        );

        Employees::Insert($form_data);
        $user = User::find(session('user')->CBR_id);

        $today = date_create();
         date_modify($today, "-4 weeks");
//        date_modify($today, "-10 minutes");
        $today = date_format($today, "Y-m-d H:i:s");
        $today_time = strtotime($today);
        $refer_sent_on = strtotime(session('user')->refer_sent_on);

        $email_sent_flag = 'false';
        if($refer_sent_on < $today_time) {
            $to_email = session('user')->branch_email;
            $data = Email::find('151');

            if($this->email_send($data, $to_email)) {
                $branch_info = Branch::find(session('user')->id);
                $branch_info->refer_sent_on = date('Y-m-d H:i:s');
                $branch_info->update();

                $email_sent_flag = 'true';
            }

        }

        return response()->json(['success' => 'Data Added successfully.', 'email_sent_flag' => $email_sent_flag]);
    }

    public function employee_update(Request $request)
    {
        $min_num = Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number;
        $rules = array(
            'date_of_birth' => 'required',
            'first_name' =>'required',
            'second_name' => 'required',
            'NI_Insurance_Number' => 'required|min:'.$min_num,
        );
        $messages = array(
            'NI_Insurance_Number.min' => 'The Personal Public Service Number for the Ireland is set so it must be at least '.$min_num.' characters long.',
        );
        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'CBR_id' => session('user')->CBR_id,
            'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'NI_Insurance_Number' => CommonController::EncryptNI($request->NI_Insurance_Number),
        );
        Employees::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function get_employee($id)
    {
        if(request()->ajax())
        {
            $data = Employees::findOrFail($id);
            $data->dob = $data->date_of_birth;

            if(strlen($data->NI_Insurance_Number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                $data->NI_Insurance_Number = CommonController::DecryptNI($data->NI_Insurance_Number);
            }

            $record_history = RecordHistory::where('NI_identity_number', $data->NI_Insurance_Number)
                                            ->orwhere('NI_identity_number', CommonController::EncryptNI($data->NI_Insurance_Number))
                                            ->orwhere('NI_identity_number', CommonController::DecryptNI($data->NI_Insurance_Number))
                                            ->exists();

            return response()->json(['data' => $data, 'used' => $record_history]);
        }
    }

    public function delete_employee($id)
    {
        if(request()->ajax())
        {
            $data = Employees::findOrFail($id);
            // $record_history = RecordHistory::where('NI_identity_number',$data->NI_Insurance_Number)->exists();
            // if($record_history)
            //     return response()->json(['warning'=>'This employee has recorders']);
            $data->delete();

            return response()->json(['success' => 'Data is successfully deleted']);
        }
    }

/////////// record history /////////////


    public function get_record_history_content($id)
    {
        if(request()->ajax())
        {
            $data = RecordHistory::findOrFail($id);
            $data->employee = Employees::where('CBR_id', session('user')->CBR_id)
                ->whereIn('NI_Insurance_Number', [$data->NI_identity_number, CommonController::DecryptNI($data->NI_identity_number), CommonController::EncryptNI($data->NI_identity_number)])
                ->first();

            if(strlen($data->NI_identity_number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                $data->NI_identity_number = CommonController::DecryptNI($data->NI_identity_number);
            }

            if($data->employee)
            if(strlen($data->employee->NI_Insurance_Number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                $data->employee->NI_Insurance_Number = CommonController::DecryptNI($data->employee->NI_Insurance_Number);
            }

            $data->record_type = RecordType::where('id', $data->record_type_id)->first();

            return response()->json(['data' => $data]);
        }
    }

    public function record_history_list(Request $request)
    {
        if(request()->ajax())
        {
            /*$totalData = RDB_perm::where('Branch', session('user')->id)
                ->where('connection_type', 'direct connect')
                ->where('parent_id', '0')
                ->where('version', '1')
                ->count();*/
            $sql_str = '';
            if($request->filter != 'all') {
                $employee_info = Employees::where('id', $request->filter)->first();

                if($employee_info) {
                    $ni_insurance_number = $employee_info->NI_Insurance_Number;
                    $date_of_birth = $employee_info->date_of_birth;
                } else {
                    $ni_insurance_number = '';
                    $date_of_birth = '';
                }

                $sql_str = ' AND (m.NI_identity_number = "'.$ni_insurance_number.'"
                                    OR m.NI_identity_number = "'.CommonController::DecryptNI($ni_insurance_number).'"
                                    OR m.NI_identity_number = "'.CommonController::EncryptNI($ni_insurance_number).'")
                            AND m.DOB = "'.$date_of_birth.'"';
            }

            $totalData = count(DB::select('SELECT j.*, m.version, m.parent_id, concat(h.first_name," ",h.second_name) full_name, i.record_type, if(parent_id = \'0\', j.id, m.parent_id) union_id
                                            FROM j_direct_connect_record_history j
                                            LEFT JOIN m_record_databank_perm m ON (j.id = m.id)
                                            LEFT JOIN (SELECT a.* FROM h_direct_connect_employee a) h
                                            ON (m.NI_identity_number = h.NI_Insurance_Number AND m.CBR_id = h.CBR_id AND m.DOB = h.date_of_birth)
                                            LEFT JOIN i_direct_connect_record_type i ON (j.record_type_id = i.id)
                                            WHERE j.branch_id = "'.session('user')->id.'"'.$sql_str.'
                                            ORDER BY union_id DESC, m.version ASC'));
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            $data_total = DB::select('SELECT j.*, m.version, m.parent_id, ifnull(concat(h.first_name," ",h.second_name), "Employee Off-boarded") full_name, i.record_type, if(parent_id = "0", j.id, m.parent_id) union_id
                                    FROM j_direct_connect_record_history j
                                    LEFT JOIN m_record_databank_perm m ON (j.id = m.id)
                                    LEFT JOIN (SELECT a.* FROM h_direct_connect_employee a) h
                                    ON (m.NI_identity_number = h.NI_Insurance_Number AND m.CBR_id = h.CBR_id AND m.DOB = h.date_of_birth)
                                    LEFT JOIN i_direct_connect_record_type i ON (j.record_type_id = i.id)
                                    WHERE j.branch_id = "'.session('user')->id.'"'.$sql_str.'
                                    ORDER BY union_id DESC, m.version ASC limit '.$limit.' offset '.$start);

            foreach ($data_total as $key2 => $value2) {
                if($value2->parent_id == '0') {
                    $max_version = DB::select('SELECT MAX(a.version) max_version
                        FROM(SELECT j.*, m.version, m.parent_id
                            FROM j_direct_connect_record_history j
                            LEFT JOIN m_record_databank_perm m ON (j.id = m.id)
                            WHERE m.parent_id ="'.$value2->id.'") a')[0]->max_version;

                } else {
                    $max_version = DB::select('SELECT MAX(a.version) max_version
                        FROM(SELECT j.*, m.version, m.parent_id
                            FROM j_direct_connect_record_history j
                            LEFT JOIN m_record_databank_perm m ON (j.id = m.id)
                            WHERE m.parent_id = "'.$value2->parent_id.'") a')[0]->max_version;
                }

                if($max_version==null||$value2->version == $max_version) {
                    $data_total[$key2]->max_version = 'yes';
                } else {
                    $data_total[$key2]->max_version = 'no';
                }
            }

            $tabledata['data'] = $data_total;
            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data_total
            );

            echo json_encode($json_data);
        }


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
                if(isset($qa_record_info['answer_text'])) {
                    $qa_info .= '<p contentEditable="false">Q: ' . $qa_record_info['question_name'] . '</p>' . $qa_record_info['answer_text'];
                } else {
                    $qa_info .= '<p contentEditable="false">Q: ' . $qa_record_info['question_name'] . '</p><p>A: </p>';
                }
            }

            return response()->json(['data' => $qa_info, 'record_title' => $record_title]);
        }
    }

    public function recordTemplateDownload($id)
    {
        if(0 < $id && $id < 6) {
            $qa_record_list = RecordTypeMode::where('record_type_id', $id)
                ->where('status', 1)
                ->get();
        } else {
            $qa_record_list = RecordTypeMode::where('record_type_id', $id)
                ->where('CBR_id', session('user')->CBR_id)
                ->where('status', 1)
                ->orderBy('order','ASC')
                ->get();
        }

        $record_title = RecordType::where('id', $id)->first()->record_type;

        $qa_info = "";
        $i = 0;
        $star_png = \URL::asset('assets/images/star.png');
        $yellow_star_png = \URL::asset('assets/images/yellow_star.png');
        $star_img = "<img src=$star_png width=14px/>";
        $yellow_star_img = "<img src=$yellow_star_png width=14px/>";

        foreach($qa_record_list as $qa_record_info) {
            $i++;

            if(isset($qa_record_info['answer_text'])){
                $qa_record_info['answer_text'] = str_replace('<span class="fa fa-star"></span>', $star_img, $qa_record_info['answer_text']);
                $qa_record_info['answer_text'] = str_replace('<span class="fa fa-star marked"></span>', $yellow_star_img, $qa_record_info['answer_text']);
                $qa_record_info['answer_text'] = str_replace('<p>', '<p class="font-verdana">', $qa_record_info['answer_text']);
                $qa_record_info['answer_text'] = str_replace('<p class="">', '<p class="font-verdana">', $qa_record_info['answer_text']);
                $qa_info .= '<p class="font-verdana">Q: '.$qa_record_info['question_name'].'</p>'.$qa_record_info['answer_text'];
            } else {
                $qa_info .= '<p class="font-verdana">Q: '.$qa_record_info['question_name'].'<br><br>A: </p><br><br><br>';
            }
        }

        $logo_url = User::where('id', session('user')->CBR_id)->first()->logo_url;
        $data = [
            'id' => $id,
            'record_logo' => $logo_url,
            'qa_record_list'=>$qa_record_list,
            'record_title'=> $record_title,
        ];

//         $record_logo=$recordType->record_logo;
//         $qa_info=$qa_info;
//         return view('front.record_template_pdf',compact('record_logo','qa_info'));

        $pdf = PDF::loadView('front.record_template_pdf', $data)->setPaper('a4');

        return $pdf->download('Record Template.pdf');
    }

    public function recordHistoryDownload($id)
    {
        $data = RecordHistory::findOrFail($id);
        $data->record_type = RecordType::where('id', $data->record_type_id)->first();

        $star_png = \URL::asset('assets/images/star.png');
        $yellow_star_png = \URL::asset('assets/images/yellow_star.png');
        $star_img = "<img src=$star_png width=14px/>";
        $yellow_star_img = "<img src=$yellow_star_png width=14px/>";
        $data->content = str_replace('<span class="fa fa-star"></span>', $star_img, $data->content);
        $data->content = str_replace('<span class="fa fa-star marked"></span>', $yellow_star_img, $data->content);
        $data->content = str_replace('<span class="fa fa-star" data-nsfw-filter-status="swf"></span>', $star_img, $data->content);
        $data->content = str_replace('<span class="fa fa-star marked" data-nsfw-filter-status="swf"></span>', $yellow_star_img, $data->content);

        $logo_url = User::where('id', session('user')->CBR_id)->first()->logo_url;

        $data = [
            'id' => $id,
            'record_logo' => $logo_url,
            'qa_info' => $data->content,
            'record_title' => $data->record_type->record_type
        ];


//$record_logo = $logo_url;
//$qa_info = $data->content;
//$record_title = $data->record_type->record_type;
//         return view('front.record_history_pdf',compact('record_logo','qa_info', 'record_title'));

        $pdf = \PDF::loadView('front.record_history_pdf', $data)->setPaper('a4');

        return $pdf->download('Record History.pdf');
    }

}
