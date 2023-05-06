<?php
namespace App\Http\Controllers\Front\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Article;
use App\Department;
use Auth;
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

        $article = Article::where('account_type','citizen')->orderBy('priority','ASC')->get();
        return view('front.citizen.index',compact('article'));
    }
    public function get_article(Request $request)
    {
        $data = Article::find($request->id);
        return response()->json($data);
    }

    public function contact_view()
    {
        $FAQ = DB::table('v_knowledge')->where('section','citizen')->get();
        $department = Department::all();
        return view('front.citizen.contact-us',compact('department','FAQ'));
    }

}
