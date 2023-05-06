<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Signup_rule;
class SignupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.signup_form');
    }

    public function email_types_list(Request $request)
    {
        $data = Signup_rule::all();
        return response()->json(['data' => $data]);
    }
    public function email_type_save(Request $request)
    {

        if($request->id=='')
            $rule = new Signup_rule;
        else
            $rule=Signup_rule::findOrFail($request->id);

        $rule->email_type = $request->email_type;
        $rule->save();
        return response()->json(['success' => 'Data Updated successfully.']);
    }

    public function email_type_delete($id)
    {
        $rule=Signup_rule::findOrFail($id);
        $rule->delete();
        return response()->json(['success' => 'Data Deleted successfully.']);
    }



}
