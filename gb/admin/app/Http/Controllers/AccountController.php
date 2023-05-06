<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\CBR_table;
use App\CUR_table;
class AccountController extends Controller
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
        return view('admin.account_access');
    }

    public function get_business(Request $request)
    {
        if($request->filter=='all')
            $business = CBR_table::where('user_type','business')->get();
        else
            $business = CBR_table::where('user_type','business')->where('created_at','>',date('Y-m-d',strtotime(date('Y-m-d').'-30 days')))->get();
        return response()->json(['data'=>$business]);
    }

    public function get_hris(Request $request)
    {
        if($request->filter=='all')
            $hris = CBR_table::where('user_type','hris')->orderBy('approved_to_list','desc')->get();
        else
            $hris = CBR_table::where('user_type','hris')->where('created_at','>',date('Y-m-d',strtotime(date('Y-m-d').'-30 days')))->orderBy('approved_to_list','desc')->get();
        return response()->json(['data'=>$hris]);
    }

    public function hris_approve(Request $req)
    {
        $hris = CBR_table::findOrFail($req->id);
        if($req->stats == '1')
            $hris->Approved_to_list = 'Listed';
        else
            $hris->Approved_to_list = 'Ready';
        $hris->update();
        return response()->json(['status'=>'Updated Successfully!']);
    }
    public function hris_order_list(Request $req)
    {
        $hris = CBR_table::where('user_type','hris')
                        ->where('hris_order','>',0)
                        ->groupby('hris_order')
                        ->get('hris_order');
        $order = CBR_table::find($req->id)->hris_order;
        return response()->json(['hris_order'=>$hris,'this_order'=>$order]);
    }

    public function hris_order_update(Request $req){
        CBR_table::where('id',$req->id)->update(['hris_order'=>$req->hris_order]);
        return response()->json(['status'=>'success']);
    }

    public function get_consultants(Request $request)
    {
        if($request->filter=='all'){
            $consultants =  DB::table('e_cbr_table')
                ->leftJoin('users','e_cbr_table.id','=','users.id')
                ->select('e_cbr_table.*','users.advisors_type')
                ->where('users.user_type','advisors')
                ->orderBy('e_cbr_table.approved_to_list','desc')
                ->orderBy('users.advisors_type','asc')
                ->get();
        }else{
            $consultants = DB::table('e_cbr_table')
                ->leftJoin('users','e_cbr_table.id','=','users.id')
                ->select('e_cbr_table.*','users.advisors_type')
                ->where('users.user_type','advisors')
                ->where('e_cbr_table.created_at','>',date('Y-m-d',strtotime(date('Y-m-d').'-30 days')))
                ->orderBy('e_cbr_table.approved_to_list','desc')
//                ->orderBy('users.advisors_type','asc')
                ->get();
        }
        return response()->json(['data'=>$consultants]);
    }
    public function consultants_approve(Request $req)
    {
        $hris = CBR_table::findOrFail($req->id);
        if($req->stats == '1')
            $hris->Approved_to_list = 'Listed';
        else
            $hris->Approved_to_list = 'Ready';
        $hris->update();
        return response()->json(['status'=>'Updated Successfully!']);
    }

    public function get_citizen(Request $request)
    {
        if($request->filter=='all')
            $citizen = CUR_table::all();
        else
            $citizen = CUR_table::where('created_at','>',date('Y-m-d',strtotime(date('Y-m-d').'-30 days')))->get();
        return response()->json(['data'=>$citizen]);
    }

}
