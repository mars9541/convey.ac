<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Email;
use App\Http\Requests;

class MailController extends Controller {

   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        // $this->middleware('global');
    }
   public function html_email(Request $request)
   {
      $data = Email::find($request->id);
      $address = $request->email_address;
      $content = ['content'=>$data->content,'header_image'=>$data->header];
      Mail::send('mail.email_template', $content, function($message) use ($address){
        $message->to($address, 'Tutorials Point')->subject
            ('Laravel HTML Testing mail');
        $message->from('dev@convey.world');
      });
      return response()->json(['success'=>'Email send Successfully!']);

   }

}
