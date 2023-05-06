<?php
namespace App\Http\Controllers\Front\Advisors;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\PaymentsReceived;
use App\Deposits;
use App\Article;
use App\Guide;
use App\Department;
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
        $confirm = (object)[];
        if(Auth::user()->email_verify==1)
            $confirm->email = 'yes';
        else
            $confirm->email = 'no';
        if(User::where('referrer_CBR_id',Auth::user()->id)->exists())
            $confirm->referrer = 'yes';
        else $confirm->referrer = 'no';

        $total = (object)[];
        $total->signup = User::where('referrer_CBR_id',Auth::user()->id)->count();
        $total->sales = PaymentsReceived::where('referrer_CBR_id',Auth::user()->id)->sum('payment_amount_excluding_vat');
        $total->yours = Deposits::where('referrers_CBR_id',Auth::user()->id)->sum('deposit_amount_including_vat');
        $article = Article::where('account_type','consultant')->orderBy('priority','ASC')->get();
        return view('front.advisors.index', compact('confirm','total','article'));
    }

    public function get_guide_temp(Request $request)
    {
        $result = Guide::where('flag',$request->item)->first()->content;
        return response()->json($result);
    }

    public function get_article(Request $request)
    {
        $data = Article::find($request->id);
        return response()->json($data);
    }

    public function contact_view()
    {
        $FAQ = DB::table('v_knowledge')->where('section','advisors')->get();
        $department = Department::all();
        return view('front.advisors.contact-us',compact('department','FAQ'));
    }

    public function help_view(Request $request)
    {
        return view('front.advisors.help');
    }

    public function getting_started(Request $request)
    {
        $data = Guide::where('flag','getting_started_of_advisors')->first()->content;
        return view('front.advisors.getting-started', compact('data'));
    }

    public function getting_started_download($id)
    {
        $file_name = '';

        switch ($id) {
            case 'convey_for_employee':
                $file_name = "introduction_convey_for_employee.pdf";
                break;
            case 'faq_for_employee':
                $file_name = "introduction_faq_for_employee.pdf";
                break;
            case 'direct_connect_example':
                $file_name = "direct_connect_example.pdf";
                break;
            case 'hris_connect_example':
                $file_name = "hris_connect_example.pdf";
                break;
            case 'api_connect_example':
                $file_name = "api_connect_example.pdf";
                break;
            case 'convey_for_manager':
                $file_name = "introduction_convey_for_manager.pdf";
                break;
            case 'faq_for_manager':
                $file_name = "introduction_faq_for_manager.pdf";
                break;
            case 'convey_image':
                $file_name = "convey_image.png";
                break;
            case 'convey_banner':
                $file_name = "convey_banner.png";
                break;
            case 'guide_a1':
                $file_name = "guide_a1.pdf";
                break;
            case 'guide_a2':
                $file_name = "guide_a2.pdf";
                break;
            case 'guide_b1':
                $file_name = "guide_b1.pdf";
                break;
            case 'guide_b2':
                $file_name = "guide_b2.pdf";
                break;
            case 'guide_c1':
                $file_name = "guide_c1.pdf";
                break;
            case 'guide_c2':
                $file_name = "guide_c2.pdf";
                break;
            case 'guide_d1':
                $file_name = "guide_d1.pdf";
                break;
            case 'guide_d2':
                $file_name = "guide_d2.pdf";
                break;
            case 'guide_e1':
                $file_name = "guide_e1.pdf";
                break;
            case 'guide_e2':
                $file_name = "guide_e2.pdf";
                break;
            case 'guide_f1':
                $file_name = "guide_f1.pdf";
                break;
            case 'guide_f2':
                $file_name = "guide_f2.pdf";
                break;
        }

        $file_path = url('public/download/get_start/'.$file_name);

        $tempImage = tempnam(sys_get_temp_dir(), $file_name);
        copy($file_path, $tempImage);

        return response()->download($tempImage, $file_name);
    }

}
