<?php
namespace App\Http\Controllers\GlobalAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Department;
class DepartmentController extends Controller
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
        $departments = Department::all();
        return view('global_admin.department',compact('departments'));
    }
    public function insert(Request $request)
    {
        if($request->id=='')
        {
            $department = new Department;
            $department->department_name = $request->department_name;
            $department->save();
        }else{
            $department = Department::find($request->id);
            $department->department_name = $request->department_name;
            $department->update();
        }
        return redirect()->back()->with('msg','success');
    }

}
