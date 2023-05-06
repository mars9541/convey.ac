<?php
namespace App\Http\Controllers\GlobalAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
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
        return view('global_admin.index');
    }

    public function put_session(Request $request)
    {
        $team_id = $request->team_id;
        $request->session()->put('team_id', $team_id);
        echo true;
    }

}
