<?php
namespace App\Http\Controllers\TeamAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\User;
use App\Users;
use App\Openticket;
use App\Country;
use App\Email;
use Symfony\Component\HttpFoundation\StreamedResponse;
class InboxController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::user()->user_role=='globaladmin'){
            $team_admin = User::Where('id',$request->session()->get('team_id'))->get()[0];
            $assigned_country = explode(',',$team_admin->assigned_countries);
            $assigned_departments = explode(',',$team_admin->assigned_departments);
        }else{
            $assigned_country = explode(',',Auth::user()->assigned_countries);
            $assigned_departments = explode(',',Auth::user()->assigned_departments);
        }

        $ticket = Openticket::WhereIn('country_id',$assigned_country)->WhereIn('department_id',$assigned_departments)->get();

        return view('team_admin.inbox', compact('ticket'));
    }
    public function ticket_list(Request $request)
    {
        if(Auth::user()->user_role=='globaladmin'){
            $team_admin = User::Where('id',$request->session()->get('team_id'))->get()[0];
            $assigned_country = explode(',',$team_admin->assigned_countries);
            $assigned_departments = explode(',',$team_admin->assigned_departments);
        }else{
            $assigned_country = explode(',',Auth::user()->assigned_countries);
            $assigned_departments = explode(',',Auth::user()->assigned_departments);
        }
        $ticket = Openticket::WhereIn('country_id',$assigned_country)->WhereIn('department_id',$assigned_departments)->orderBy('status','ASC')->orderBy('created_at','DESC')->get();
        foreach ($ticket as $key => $value) {
            $value->country;
            $value->department;
        }
        return response()->json(['data'=>$ticket]);
    }

    public function get_ticket(Request $request)
    {
        $data = Openticket::find($request->id);

        if($data->status == '1') {
            $data->status = '2';
            $data->update();
        }

        $question = json_decode($data->content)->Q;
        $answer = json_decode($data->content)->A;

        $res = [
            'id'=>$data->id,
            'question'=>$question,
            'answer'=>$answer
        ];

        return response()->json($res);
    }

    public function send_ticket(Request $request)
    {
        $ticket = Openticket::find($request->id);
        $content = json_decode($ticket->content);
        $content->A = $request->answer;
        $ticket->replied_by = Auth::user()->id;
        $ticket->replied_at = date('Y-m-d H:i:s');
        $ticket->status = '3';
        $ticket->content = json_encode($content);
        $ticket->save();

        $user_id = $ticket->id_opened_by;

        if(strlen($user_id) > 7) {
            $country_code = strtolower(substr($user_id, 0, 2));
        } else {
            $country_code = 'gb';
        }

        Email::set_database_name($country_code);

        $user_info = Users::where('id', $user_id)->first();

        if($user_info) {
            $this->send_email($user_info, $country_code);
        }

        return response()->json(['success'=>'Your message sent successfully!']);
    }

    public function send_email($user, $country_code)
    {
        $data = Email::find('125');

        if(!$data) return false;
        $address = $user->email;

        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                       <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                          <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">{button_name}</span>
                       </font>
                    </a>';

        $link_url = url('/'.$country_code).'/check_replied_ticket/'.$user->token_key;
        $button = str_replace('{link_url}', $link_url, $button);
        $button = str_replace('{button_name}', 'Check reply' , $button);
        $userId = Users::where('token_key', $user->token_key)->get()[0]->id;
        $data->content = str_replace("[button]", $button, $data->content);

        /*if($user->user_type=='citizen') {
            $user_data = CUR_table::find($userId);
            $full_name = $user_data->firstname.' '.$user_data->lastname;
        } else {
            $cbr_data = CBR_table::find($userId);

            $full_name = $cbr_data->lrd_firstname.' '.$cbr_data->lrd_lastname;
        }

        $data->content = str_replace("[name_here]",$full_name,$data->content);*/
        $title = $data->title;
        $subject = $data->subject;
        $from_email = $data->from_email_address;
        $content['content'] = $data->content;

        Mail::send('mail.email_template', $content, function($message) use ($address, $from_email, $title, $subject) {
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });

        return true;
    }

    public function getEventStream() {


    }

}
