<?php
namespace App\Http\Controllers\GlobalAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Country;
use App\Department;
use App\User;
class MemberController extends Controller
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
        $country = Country::all();
        $department = Department::all();
        $members = User::Where('user_role','globalteamadmin')->get();
        // var_dump($members);exit;
        return view('global_admin.team-members', compact('country','department','members'));
    }

    public function insert(Request $request)
    {
        if($request->id=='')
        {
            $request->validate([
                'name' => ['required', 'unique:users'],
            ]);
            $member = new User;
            $member->name = $request->name;
            $member->password = Hash::make($request->password);
            
            foreach ($request->department_id as $key => $value) {
                if($key==0)
                    $department_ids=$value;
                else
                    $department_ids=$department_ids.','.$value;
            }
            foreach ($request->country_id as $key1 => $value1) {
                if($key1==0)
                    $country_ids=$value1;
                else
                    $country_ids=$country_ids.','.$value1;
            }

            $member->assigned_departments = $department_ids;
            $member->assigned_countries = $country_ids;
            $member->user_role = 'globalteamadmin';
            $member->save();
        }else{
            $member = User::find($request->id);
            $member->name = $request->name;
            if($request->password!='')
                $member->password = Hash::make($request->password);
            foreach ($request->department_id as $key => $value) {
                if($key==0)
                    $department_ids=$value;
                else
                    $department_ids=$department_ids.','.$value;
            }
            foreach ($request->country_id as $key1 => $value1) {
                if($key1==0)
                    $country_ids=$value1;
                else
                    $country_ids=$country_ids.','.$value1;
            }
            $member->assigned_departments = $department_ids;
            $member->assigned_countries = $country_ids;
            $member->user_role = 'globalteamadmin';
            $member->update();
        }
        return redirect()->back()->with('msg','success');
    }

    public function delete(Request $request){
        $member = User::find($request->id);
        $member->delete();
        return redirect()->back()->with('msg','delete');
    }

}
