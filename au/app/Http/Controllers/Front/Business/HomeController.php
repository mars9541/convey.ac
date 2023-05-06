<?php
namespace App\Http\Controllers\Front\Business;
use App\CBR_table;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\RDB_perm;
use App\Credits;
use App\User;
use App\Guide;
use App\Article;
use App\Department;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $connect_info;

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
        $confirm = (object)[];
        if(Auth::user()->email_verify==1)
            $confirm->email = 'yes';
        else
            $confirm->email = 'no';
        if(RDB_perm::where('CBR_id',Auth::user()->id)->exists())
            $confirm->record = 'yes';
        else $confirm->record = 'no';
        if(Credits::where('CBR_id',Auth::user()->id)->where('adjustment_value','0')->exists())
            $confirm->search = 'yes';
        else $confirm->search = 'no';
        if(User::where('referrer_CBR_id',Auth::user()->id)->exists()){

            $confirm->referrer = 'yes';
        }
        else $confirm->referrer = 'no';
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();

        $article = Article::where('account_type','business')->orderBy('priority','ASC')->get();
        return view('front.business.index', compact('confirm','article', 'connect_flag'));
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
        $FAQ = DB::table('v_knowledge')->where('section','business')->get();
        $department = Department::all();
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        return view('front.business.contact-us',compact('department','FAQ', 'connect_flag'));
    }

    public function help_view(Request $request)
    {
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        return view('front.business.help', compact('connect_flag'));
    }

    public function getting_started(Request $request)
    {
        $data = Guide::where('flag','getting_started_of_business')->first()->content;
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        return view('front.business.getting-started', compact('data','connect_flag'));
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
