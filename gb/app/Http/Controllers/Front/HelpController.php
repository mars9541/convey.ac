<?php


namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\CBR_table;


class HelpController extends Controller
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

    public function get_advisors(Request $request)
    {
        if($request->type == 'advisor') {
            $data = DB::table('users')
                ->leftJoin('e_cbr_table','users.id', '=', 'e_cbr_table.id')
                ->whereIn('users.advisors_type', [$request->type, 'writer'])
                ->where('Approved_to_list','Listed')
                ->select('e_cbr_table.*', 'users.advisors_type')
                ->get();
        } else {
            $data = DB::table('users')
                ->leftJoin('e_cbr_table','users.id', '=', 'e_cbr_table.id')
                ->where('users.advisors_type', $request->type)
                ->where('Approved_to_list','Listed')
                ->select('e_cbr_table.*', 'users.advisors_type')
                ->get();
        }


        return response()->json(['data'=>$data]);
    }

}
