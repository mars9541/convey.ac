<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Email;
class SettingsController extends Controller
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
        $email_list = Email::groupBy('from_email_address')
            ->where('title', 'not like', '%version%')
            ->where(DB::raw('from_email_address != "professionals@convey.ac" OR (from_email_address = "professionals@convey.ac" AND tab_section = "advisors1")'))
            ->orderBy('from_email_address')
            ->select('from_email_address', DB::raw('REPLACE((
                    CASE
                        WHEN from_email_address = "accounts@convey.ac" THEN GROUP_CONCAT(`subject`)
                        WHEN from_email_address = "admin@convey.ac" THEN GROUP_CONCAT(`subject`)
                        WHEN from_email_address = "citizens@convey.ac" THEN GROUP_CONCAT(`subject`)
                        WHEN from_email_address = "invites@convey.ac" THEN GROUP_CONCAT(`subject`)
                        ELSE GROUP_CONCAT(CONCAT(`subject`, rule))
                    END), ",", ", ") AS subjects'))
            ->get();

        return view('admin.settings', compact('email_list'));
    }



}
