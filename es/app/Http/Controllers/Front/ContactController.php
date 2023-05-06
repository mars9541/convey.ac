<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\User;
use App\Openticket;
use App\Country;
use App\Email;
use App\Country_spec_info;
use App\Department;

class ContactController extends Controller
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

    public function send_ticket(Request $request)
    {
        $country = Country::where('country_name',Country_spec_info::value('country_name'))->first();
        $content = json_encode(['Q' => $request->content, 'A' => '']);

        $ticket = new Openticket;
        $ticket->email_opened_by = Auth::user()->email;
        $ticket->id_opened_by = Auth::user()->id;
        $ticket->country_id = $country->id;
        $ticket->status = '1';
        $ticket->department_id = $request->department_id;
        $ticket->content = $content;
        $ticket->save();

        $user_info = User::where('id', Auth::user()->id)->first();
        $this->send_email($user_info);

        return response()->json(['success'=>'Your message sent successfully!']);
    }

    public function send_email($user)
    {
        $data = Email::find('124');

        if(!$data) return false;
        $address = $user->email;

        /*$button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                       <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                          <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">[button_name]</span>
                       </font>
                    </a>';

        $link_url = url('/').'/check_replied_ticket/'.$user->token_key;
        $button = str_replace('{link_url}', $link_url, $button);
        $button = str_replace('{button_name}', 'Check reply' , $button);
        $userId = User::where('token_key', $user->token_key)->get()[0]->id;
        $data->content = str_replace("[button]", $button, $data->content);*/

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

    public function ticket_list(Request $request)
    {
        $country = Country::where('country_name',Country_spec_info::value('country_name'))->first();
        $data = Openticket::where('country_id',$country->id)
                        ->where('id_opened_by',Auth::user()->id)
                        ->orderBy('created_at','DESC')
                        ->get();
        foreach ($data as $key => $value) {
            // dd(Department::where('id', $value->department_id)->first());
            $data[$key]->department = Department::where('id', $value->department_id)->first()->department_name;
        }
        
        
        return response()->json(['data'=>$data]);
    }

    public function get_ticket(Request $request)
    {
        $data = Openticket::find($request->id);
        $data->closed_at = date('Y-m-d H:i:s');
        $data->update();

        $question = json_decode($data->content)->Q;
        $answer = json_decode($data->content)->A;

        $res = [
            'question'=>$question,
            'answer'=>$answer
        ];
        return response()->json($res);
    }
}
