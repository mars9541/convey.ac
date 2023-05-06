<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\RDB;
use App\Record_check_rule;
use App\RDB_perm;
use App\RecordHistory;
use App\TestData;
class RecordsController extends Controller
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
        return view('admin.records');
    }

    public function search(Request $request)
    {
        $search_result = array();
        $parent_data = DB::table('m_record_databank_perm AS a')
            ->leftjoin('e_cbr_table AS b','a.CBR_id','b.id')
            ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
            ->where('a.parent_id','0')
            ->where('a.version', '>','0')
            ->select('a.*', 'b.ocb_name')
            ->get();

        foreach ($parent_data as $item) {
            $max_version = DB::table('m_record_databank_perm AS a')
                ->leftjoin('e_cbr_table AS b','a.CBR_id','b.id')
                ->whereIn('a.NI_identity_number', [$request->NI_number, CommonController::DecryptNI($request->NI_number), CommonController::EncryptNI($request->NI_number)])
                ->where('a.parent_id',$item->id)
                ->where('a.version', '>','0')
                ->orderBy('a.version', 'desc')
                ->select('a.*', 'b.ocb_name')
                ->get();


            if(count($max_version)>0){
                $ids = array();
                for ($i=1; $i < count($max_version); $i++) {
                    array_push($ids,$max_version[$i]->id);
                }
                array_push($ids,$item->id);
                $max_version[0]->ids = $ids;
                if(json_decode($max_version[0]->RECORD_content)==null){
                    $max_version[0]->RECORD_content = str_replace('{"', '', $max_version[0]->RECORD_content);
                    $max_version[0]->RECORD_content = str_replace('"}', '', $max_version[0]->RECORD_content);
                }else{
                    $content = '';
                    foreach (json_decode($max_version[0]->RECORD_content) as $key => $value) {
                        $content .= 'Question: '.$key.' <br> ';
                        $content .= 'Answer: '.$value.' <br> <br>';
                    }
                    $max_version[0]->RECORD_content = $content;
                }
                array_push($search_result, $max_version[0]);
            }else{
                if(json_decode($item->RECORD_content)==null){
                    $item->RECORD_content = str_replace('{"', '', $item->RECORD_content);
                    $item->RECORD_content = str_replace('"}', '', $item->RECORD_content);
                }else{
                    $content = '';
                    foreach (json_decode($item->RECORD_content) as $key => $value) {
                        $content .= 'Question: '.$key.' <br> ';
                        $content .= 'Answer: '.$value.' <br> <br>';
                    }
                    $item->RECORD_content = $content;
                    // dd($content);
                }

                array_push($search_result, $item);
            }
        }
        return response()->json(['data' => $search_result]);
    }

    public function get_record_version(Request $request)
    {
        $record = RDB_perm::findOrFail($request->id);
        return response()->json(['data' => $record]);
    }
    public function RDB_temp_list()
    {

        $data = RDB::all();
        foreach ($data as $key => $value) {
            $flaged_for = $this->check_spam($value->id);
            $data[$key]->flaged_for = $flaged_for;
        }


        return response()->json(['data' => $data]);
    }

    private function check_spam($id)
    {
        $record_rule = Record_check_rule::all();
        $RECORD_content = RDB::findOrFail($id)->RECORD_content;
        foreach ($record_rule as $key => $value) {
            if(strstr(strtolower($RECORD_content),strtolower($value->text)))
                return $value->text;
        }
        return true;
    }

    public function approve($id)
    {
        $RDB_temp = RDB::whereId($id)->first()->toArray();

        RDB_perm::Insert($RDB_temp);
        $RDB = RDB::findOrFail($id);
        $RDB->delete();

        return response()->json(['success' => 'Data approved successfully.']);

    }

    public function remove($id)
    {
        $RDB_temp = RDB::whereId($id)->first()->toArray();
        $RDB_temp['version']='0';
        RDB_perm::Insert($RDB_temp);
        $RDB = RDB::findOrFail($id);
        $RDB->delete();
        return response()->json(['success' => 'Data Removed successfully.']);

    }

    public function flag_rules_list(Request $request)
    {
        $data = Record_check_rule::all();
        return response()->json(['data' => $data]);
    }

    public function flag_rules_save(Request $request)
    {

        if($request->id=='')
            $rule = new Record_check_rule;
        else
            $rule=Record_check_rule::findOrFail($request->id);

        $rule->text = $request->text;
        $rule->save();
        return response()->json(['success' => 'Data Updated successfully.']);
    }

    public function flag_rule_delete($id)
    {
        $rule=Record_check_rule::findOrFail($id);
        $rule->delete();
        return response()->json(['success' => 'Data Deleted successfully.']);
    }

    public function test_data_list(Request $request)
    {
        $data = TestData::all();
        return response()->json(['data' => $data]);
    }

    public function test_data_save(Request $request)
    {

        if($request->id=='')
            $rule = new TestData;
        else
            $rule=TestData::findOrFail($request->id);

        $rule->NI_number = $request->text;
        $rule->save();
        return response()->json(['success' => 'Data Updated successfully.']);
    }

    public function test_data_delete($id)
    {
        $rule=TestData::findOrFail($id);
        $rule->delete();
        return response()->json(['success' => 'Data Deleted successfully.']);
    }

}
