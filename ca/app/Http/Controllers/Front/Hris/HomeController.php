<?php
namespace App\Http\Controllers\Front\Hris;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\PaymentsReceived;
use App\Deposits;
use App\Article;
use App\Department;
use App\Guide;
use App\Api_Session;
use Carbon\Carbon;
class HomeController extends Controller
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
        $total = (object)[];
        $total->signup = User::where('referrer_CBR_id',Auth::user()->id)->count();
        $total->sales = PaymentsReceived::where('referrer_CBR_id',Auth::user()->id)->sum('payment_amount_excluding_vat');
        $total->yours = Deposits::where('referrers_CBR_id',Auth::user()->id)->sum('deposit_amount_including_vat');
        $connection = (object)[];
        $connection->total = Api_Session::where('hris_id',Auth::user()->id)->groupBy('user_id')->get()->count();
        $dateLastMonth = Carbon::now()->startOfMonth()->subMonth(1);
        $dateThisMonth = Carbon::now()->startOfMonth();
        $dateNextMonth = Carbon::now()->startOfMonth()->subMonth(-1);
        $connection->this_month = Api_Session::where('hris_id',Auth::user()->id)->whereBetween('created_at',[$dateThisMonth,$dateNextMonth])->groupBy('user_id')->get()->count();
        $connection->last_month = Api_Session::where('hris_id',Auth::user()->id)->whereBetween('created_at',[$dateLastMonth,$dateThisMonth])->groupBy('user_id')->get()->count();
        $article = Article::where('account_type','hris')->orderBy('priority','ASC')->get();
        return view('front.hris.index', compact('total','article','connection'));
    }

    public function get_article(Request $request)
    {
        $data = Article::find($request->id);
        return response()->json($data);
    }

    public function get_guide_temp(Request $request)
    {
        $result = Guide::where('flag',$request->item)->first()->content;
        return response()->json($result);
    }

    public function contact_view()
    {
        $FAQ = DB::table('v_knowledge')->where('section', 'hris')->get();
        $department = Department::all();
        return view('front.hris.contact-us',compact('department','FAQ'));
    }

    public function help_view(Request $request)
    {
        return view('front.hris.help');
    }

}
