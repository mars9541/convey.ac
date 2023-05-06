<?php
namespace App\Http\Controllers\Front\Citizen;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\RDB_perm;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\RDM_perm;
use App\CUR_table;
use App\Country_spec_info;
class RecordController extends Controller
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
    public function index()
    {
        $record = DB::table('m_record_databank_perm AS a')
                    ->leftjoin('d_cur_table AS b', function($join)
                    {
                        $join->on('a.NI_identity_number', '=', 'b.NI_identity_number');
                        $join->on('a.DOB', '=', 'b.DOB');
                    })
                    ->where('b.id', Auth::user()->id)
                    ->select('a.*')
                    ->latest('a.time_stamp')
                    ->first();

        if($record) {
            $record->business_name = DB::table('e_cbr_table')->where('id', $record->CBR_id)->first()->ocb_name;

            if(strlen($record->NI_identity_number) != Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number) {
                $record->NI_identity_number = CommonController::DecryptNI($record->NI_identity_number);
            }
        }

        return view('front.citizen.last-record', compact('record'));
    }

    public function record_list()
    {
        $record = DB::table('m_record_databank_perm AS a')
            ->leftjoin('d_cur_table AS b', function($join)
            {
                $join->on('a.NI_identity_number', '=', 'b.NI_identity_number');
                $join->on('a.DOB', '=', 'b.DOB');
            })
            ->where('b.id', Auth::user()->id)
            ->select('a.*')
            ->latest('a.time_stamp')
            ->first();

        if($record) {
            $record->business_name = DB::table('e_cbr_table')->where('id', $record->CBR_id)->first()->ocb_name;

            if(strlen($record->NI_identity_number) != Country_spec_info::first()->Number_Of_Digits_In_National_Insurance_Number) {
                $record->NI_identity_number = CommonController::DecryptNI($record->NI_identity_number);
            }
        }

        return view('front.citizen.record-list', compact('record'));
    }

    public function get_record_list(Request $request)
    {
        if(request()->ajax())
        {
            $citizen_info = CUR_table::where('id', Auth::user()->id)->first();
            $data = array();
            $record_list = DB::table('m_record_databank_perm AS a')
                ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                ->whereIn('a.NI_identity_number', [$citizen_info->NI_identity_number, CommonController::DecryptNI($citizen_info->NI_identity_number), CommonController::EncryptNI($citizen_info->NI_identity_number)])
                ->where('a.DOB', $citizen_info->DOB)
                ->select('a.*', 'b.lrd_firstname', 'lrd_lastname')
                ->orderBy('a.time_stamp', 'DESC')
                ->get();
            /*$record_list = RDB_perm::where('NI_identity_number', $citizen_info->NI_identity_number)
                ->where('DOB', $citizen_info->DOB)
                ->orderBy('time_stamp','DESC')
                ->get();*/

            if($record_list) {
                foreach ($record_list as $key1 => $value1) {
                    $record_list[$key1]->index = count($data) + 1;
                    $record_list[$key1]->lrd_firstname = $value1->lrd_firstname.' '.$value1->lrd_lastname;
                    array_push($data, $record_list[$key1]);
                }
            }

            $tabledata['data'] = $record_list;

            echo json_encode($tabledata);
        }
    }

}
