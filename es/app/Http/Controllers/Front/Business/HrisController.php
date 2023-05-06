<?php
namespace App\Http\Controllers\Front\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\CBR_table;
use App\User;
class HrisController extends Controller
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
        // dd(Auth::user());
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        return view('front.business.hris-connect', compact('connect_flag'));
    }

    public function get_hris(Request $request)
    {
        if($request->filter=='software')
            $hris = CBR_table::where('user_type','hris')->where('Approved_to_list','Listed')->where('hris_type','software')->orderby('hris_order','asc')->get();
        else
            $hris = CBR_table::where('user_type','hris')->where('Approved_to_list','Listed')->orderby('hris_order','asc')->get();
        return response()->json(['data'=>$hris]);
    }

}
