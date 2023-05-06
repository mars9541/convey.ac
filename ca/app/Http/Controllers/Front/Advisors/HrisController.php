<?php
namespace App\Http\Controllers\Front\Advisors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Guide;
use App\CBR_table;
class HrisController extends Controller
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
        $data = Guide::where('flag','hris_connect_page_of_advisors')->first()->content;
        return view('front.advisors.hris-connect',compact('data'));
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
