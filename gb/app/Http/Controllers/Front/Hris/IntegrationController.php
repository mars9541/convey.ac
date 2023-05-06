<?php
namespace App\Http\Controllers\Front\Hris;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Guide;
class IntegrationController extends Controller
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
        $data = Guide::where('flag','integration_tips_page_of_hris')->first()->content;
        return view('front.hris.integration-tips',compact('data'));
    }

}
