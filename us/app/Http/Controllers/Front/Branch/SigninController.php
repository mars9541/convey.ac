<?php
namespace App\Http\Controllers\Front\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Branch;
class SigninController extends Controller
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
        return view('front.branch.login');
    }

    public function login_user(Request $request)
    {
        require_once base_path().'/vendor/securimage/securimage.php';

        $securimage = new \Securimage();
        if ($securimage->check($request->captcha_code) == false) {
            return redirect()->back()->withInput()->with('captch_error', 'Captcha code incorrect. Please try again!');
        }

        $user = Branch::where(['id'=>$request->ID_code])->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                \Session::put('user',$user);
                return redirect()->route('branch.search');
            }else
                return redirect()->back()->with('error','Please Check again your Password.');

        }else{
            return redirect()->back()->with('error','Please Check again your ID and Password.');
        }
    }

    public function login_redirect($id)
    {
        $user = Branch::Where('id', $id)->first();

        if($user){
            \Session::put('user',$user);
            return redirect()->route('branch.search');

        } else {
            return redirect()->back()->with('error','Please Check again your ID and Password.');
        }
    }

    public function logout()
    {
        \Session::flush();
        return redirect()->back();
    }

}
