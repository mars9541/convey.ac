<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Email;
use App\Http\Requests;
use DB;
class MailController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        // $this->middleware('auth');
    }
    public function html_email(Request $request)
    {
        $from_email = DB::table('b_country_spec_info')->value('server_email');
        $data = Email::find($request->id);
        $address = $request->email_address;
        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">[button_name]</span>
                           </font>
                        </a>';
        $link_url = url('/').'/confirm_email/'.'some_token_string';
        $button = str_replace('{link_url}', $link_url, $button);
        $content['content'] = str_replace("[button]",$button,$data->content);

        if($request->id == '128' || $request->id == '131') {
            $img = '<img src="{link_url}" style="width: 312px;"><span style="font-family: Verdana;"><br></span>';
            $link_url = asset('assets/images/email_img/unique_code_email.png');
            $img = str_replace('{link_url}', $link_url, $img);
            $content['content'] = str_replace("[image]", $img, $data->content);
        }

        $title = $data->title;
        $subject = $data->subject;

        // $data = ['content'=>$data->content,'header_image'=>$data->header];
        Mail::send('mail.email_template', $content, function($message) use ($address,$from_email,$title,$subject){
            $message->to($address, $title)->subject($subject);
            $message->from($from_email);
        });
        return response()->json(['success'=>'Email send Successfully!']);
    }

    public function preview_email($id)
    {
        $from_email = DB::table('b_country_spec_info')->value('server_email');
        $data = Email::find($id);
        $button = '<a href="{link_url}" target="_blank" style="border: 1px solid #3bc850; border-radius: 4px; padding: 5px 12px; font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;background: #3bc850;">
                           <font face="\'Source Sans Pro\', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                              <span style="font-family: \'Source Sans Pro\', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">[button_name]</span>
                           </font>
                        </a>';

        $content = str_replace("[button]",$button,$data->content);

        return view('mail.email_template',compact('content'));
    }


}
