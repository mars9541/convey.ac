<?php
namespace App\Http\Controllers\Front\Business;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use App\Guide;
use App\RDB_perm;
use App\RDB;
use App\CBR_table;
use App\Country_spec_info;
use Auth;
class ApiController extends Controller
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
        $data = Guide::where('flag','api_connect_page_of_business')->first()->content;
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        return view('front.business.api-connect',compact('data', 'connect_flag'));
    }

    public function get_api_record_list(Request $request)
    {
        if(request()->ajax())
        {
            $data1 = RDB_perm::where('CBR_id',Auth::user()->id)
                ->where('connection_type', 'API');
            $data2 = RDB::where('CBR_id',Auth::user()->id)
                ->where('connection_type', 'API')
                ->union($data1)
                ->orderByDesc('time_stamp')
                ->orderByDesc('id')
                ->limit(5)
                ->get();
            $tabledata['data'] = $data2;
            echo json_encode($tabledata);
        }
    }

    public function get_api_record_error_list(Request $request)
    {
        if(request()->ajax())
        {
            $data = RDB::where('CBR_id',Auth::user()->id)
                ->where('connection_type', 'API')
                ->orderByDesc('time_stamp')
                ->get();
            $tabledata['data'] = $data;
            //dd($tabledata);
            echo json_encode($tabledata);
        }
    }

    public function get_api_record_info($id)
    {
        if(request()->ajax())
        {
            $perm = RDB_perm::find($id);

            if($perm) {
                $data = DB::table('m_record_databank_perm AS a')
                    ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                    ->leftjoin('f_branch_table AS c', 'a.Branch', 'c.id')
                    ->where('a.id', $id)
                    ->select('a.*', 'b.ocb_name', DB::raw("CASE WHEN c.branch_name is null THEN b.ocb_name ELSE concat(b.ocb_name,'[',c.branch_name,']') END AS created_by"))
                    ->first();

                if(strlen($data->NI_identity_number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                    $data->NI_identity_number = CommonController::DecryptNI($data->NI_identity_number);
                }
            } else {
                $data = DB::table('l_record_databank_temp AS a')
                    ->leftjoin('e_cbr_table AS b', 'a.CBR_id', 'b.id')
                    ->leftjoin('f_branch_table AS c', 'a.Branch', 'c.id')
                    ->where('a.id', $id)
                    ->select('a.*', 'b.ocb_name', DB::raw("CASE WHEN c.branch_name is null THEN b.ocb_name ELSE concat(b.ocb_name,'[',c.branch_name,']') END AS created_by"))
                    ->first();

                if(strlen($data->NI_identity_number) != Country_spec_info::value('Number_Of_Digits_In_National_Insurance_Number')) {
                    $data->NI_identity_number = CommonController::DecryptNI($data->NI_identity_number);
                }
            }
            return response()->json(['data' => $data]);
        }
    }

    public function  del_api_record($id)
    {
        if(request()->ajax()) {
            $perm = RDB::find($id);
            $perm->delete();
            return response()->json(['status' => 'success']);
        }
    }

}
