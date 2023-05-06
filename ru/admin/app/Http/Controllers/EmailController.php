<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Email;
class EmailController extends Controller
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
        return view('admin.auto_emails');
    }

    public function save_email_temp(Request $request)
    {
        if($request->id)
        {
            $email =  Email::find($request->id);
            $email->subject = $request->subject;
            $email->tab_section = $request->tab_section;
            $email->title = $request->title;
            $email->rule = $request->rule;
            $email->content = $request->content;


            /// file upload ////
            if($request->file('header')){
                $file = $request->file('header');
                $imagename = time().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/header_image');

                if (!is_dir($destinationPath)) {

                    mkdir($destinationPath, 0700, true);
                }
                $file->move($destinationPath, $imagename);
                $email->header = $imagename;
            }
            $email->save();
            return response()->json(['success'=>'Updated Successfully!']);
        }else
        {
            $email = new Email;
            $email->subject = $request->subject;
            $email->tab_section = $request->tab_section;
            $email->title = $request->title;
            $email->rule = $request->rule;
            $email->content = $request->content;

            /// file upload ////
            if($request->file('header')){
                $file = $request->file('header');
                $imagename = time().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('uploads/header_image');

                if (!is_dir($destinationPath)) {

                    mkdir($destinationPath, 0700, true);
                }
                $file->move($destinationPath, $imagename);
                $email->header = $imagename;
            }

            $email->save();
            return response()->json(['success'=>'Added Successfully!']);
        }
    }

    public function email_temp_list(Request $request)
    {
        if($request->tab_section == "invites") {
            $data = Email::where('tab_section', $request->tab_section)->orderBy('rule')->get();
        } else if($request->tab_section == "business") {
            $data = Email::where('tab_section', $request->tab_section)->orderBy('tab_order')->get();
        } else {
            $data = Email::where('tab_section', $request->tab_section)->orderBy('id')->get();
        }

        return response()->json(['data'=>$data]);
    }

    public function get_email_temp($id)
    {
        $data = Email::find($id);
        return response()->json(['data'=>$data]);
    }

    public function add_group_email(Request $request)
    {
        $parent_email = new Email;
        $parent_email->title = $request->title;
        $parent_email->subject = $request->subject;
        $parent_email->rule = $request->rule;
        $parent_email->parent_id = '0';
        $parent_email->save();

        $sublen = 3;
        if($request->subject='advisors')
            $sublen = 2;
        for ($i=0; $i < $sublen ; $i++) {
            $sub_email = new Email;
            $sub_email->subject = $request->subject;
            $sub_email->parent_id = $parent_email->id;
            $sub_email->save();
        }
        return response()->json(['success'=>'Add successfully']);

    }



}
