<?php
namespace App\Http\Controllers\Front\Business;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\CBR_table;
use App\Branch;
use App\User;
use App\Credits;
use App\Country_spec_info;
use App\Signup_rule;
class BranchesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $business = CBR_table::where('id', Auth::user()->id)->first();
        $branch = Branch::where('CBR_id', Auth::user()->id)->exists();
        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        $freeEmails = Signup_rule::all();

        $freeEmailList = '';
        foreach ($freeEmails as $item)
        {
            if($freeEmailList == '') {
                $freeEmailList = $item->email_type;
            } else {
                $freeEmailList .= ',' . $item->email_type;
            }
        }

        return view('front.business.branches', compact('business', 'freeEmailList', 'branch', 'connect_flag'));
    }

    public function validation_email_duplication(Request $request)
    {
        $email_verify = User::where('email', $request->email)->exists();

        if($email_verify == false) {
            $email_verify = Branch::where('branch_email', $request->email)->where('id', '!=', $request->branch_id)->exists();
        }

        return response()->json(['status' => $email_verify]);
    }

    public function activate_branch_manager(Request $request)
    {

        $user = User::where('id',Auth::user()->id)->update(array('activate_branch_manager'=>$request->status, 'activate_branch_direct_connect'=>'0'));
        echo json_encode($user);
    }
    public function activate_branch_direct_manager(Request $request)
    {

        $user = User::where('id',Auth::user()->id)->update(array('activate_branch_direct_connect'=>$request->status));
        echo json_encode($user);
    }

    public function branch_list()
    {
        $now = date('Y-m-d');
        if(request()->ajax())
        {
            $data = Branch::where('CBR_id',Auth::user()->id)->latest()->get();
            foreach ($data as $key => $value) {
                $data[$key]->credits_his = Credits::where('branch_id',$value->id)->where('time_stamp','>',date('Y-m-d H:i:s',strtotime($now . "-1 months")))->count();

            }
            $tabledata['data'] = $data;
            // dd($data);
            // return $tabledata;
            echo json_encode($tabledata);
        }
        // return view('ajax_index');
    }

    public function branch_add(Request $request)
    {
        $rules = array(
            'branch_name'     =>  'required',
            'branch_email'     =>  'required',
            'branch_postcode'     =>  'required',
            'internal_identifier'     =>  'required',
            'password' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id) - 2) AS int)) AS MaxNum FROM f_branch_table')[0]->MaxNum;

        if($maxId == '') $maxId = Country_spec_info::value('branch_starting_number') - 1;

        $newId = Country_spec_info::value('country_ID').strval($maxId + 1);

//        $max_id = Branch::max('id');
//        if($max_id) {
//            $max_id += 1;
//        } else {
//            $max_id = Country_spec_info::value('branch_starting_number');
//        }

        $form_data = array(
            'id' => $newId,
            'CBR_id' => Auth::user()->id,
            'branch_name' =>  $request->branch_name,
            'branch_email' =>  $request->branch_email,
            'branch_postcode' =>  $request->branch_postcode,
            'internal_identifier'   =>  $request->internal_identifier,
            'password' => Hash::make($request->password),
        );

        Branch::Insert($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function branch_update(Request $request)
    {
        /*
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }*/

        $form_data = array(
            'CBR_id' => Auth::user()->id,
            'branch_name' =>  $request->branch_name,
            'branch_email' =>  $request->branch_email,
            'branch_postcode' =>  $request->branch_postcode,
            'internal_identifier'   =>  $request->internal_identifier,
        );

        if(strpos($request->password, '********') === false) {
            $form_data['password'] = Hash::make($request->password);
        }

        Branch::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    public function get_branch($id)
    {
        if(request()->ajax())
        {
            $data = Branch::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
    public function delete_branch($id)
    {
        if(request()->ajax())
        {
            $data = Branch::findOrFail($id);
            $data->delete();
            return response()->json(['success' => 'Data is successfully deleted']);
        }
    }

}
