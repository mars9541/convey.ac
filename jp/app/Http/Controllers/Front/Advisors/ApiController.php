<?php
namespace App\Http\Controllers\Front\Advisors;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Guide;
class ApiController extends Controller
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
        $data = Guide::where('flag','api_connect_page_of_advisors')->first()->content;
        return view('front.advisors.api-connect',compact('data'));
    }

}
