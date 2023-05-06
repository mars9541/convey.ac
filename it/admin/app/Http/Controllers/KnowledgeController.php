<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Country_spec_info;
class KnowledgeController extends Controller
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
        return view('admin.knowledge_base');
    }

    public function save_knowledge(Request $request)
    {
        if($request->id)
        {
            DB::table('v_knowledge')->where('id',$request->id)->update(['section'=>$request->section, 'question'=>$request->text_question, 'answer'=>$request->text_answer, 'updated_at'=>date('Y-m-d H:i:s')]);
            return response()->json(['success' => 'Updated Successfully!']);
        }else
        {
            $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id)-2) AS int)) AS MaxNum FROM v_knowledge')[0]->MaxNum;
            $newId = Country_spec_info::value('country_ID').strval($maxId+1);
            DB::table('v_knowledge')->insert(['id'=>$newId, 'section'=>$request->section, 'question'=>$request->text_question, 'answer'=>$request->text_answer,'created_at'=>date('Y-m-d H:i:s')]);
        }
        return response()->json(['success' => 'Saved Successfully!']);
    }

    public function knowledge_list()
    {
        $data = DB::table('v_knowledge')->get();
        return response()->json(['data' => $data]);
    }

    public function get_knowledge($id)
    {
        $data = DB::table('v_knowledge')->where('id',$id)->first();
        return response()->json(['data' => $data]);
    }

    public function delete_knowledge($id)
    {
        DB::table('v_knowledge')->where('id',$id)->delete();
        return response()->json(['success' => 'Deleted Successfully!']);
    }

}