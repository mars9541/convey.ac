<?php
namespace App\Http\Controllers\Front\Business;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
use Crypt;
use App\Country_spec_info;
use App\CBR_table;
use App\MangopayKyc;
use App\Market;
use App\Signup_rule;
use App\User;
use Illuminate\Http\Request;
class SettingsController extends Controller
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
        $now = date('Y-m-d H:i:s');
        $user_info = CBR_table::where('id',Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->where('email_verify', '!=', '1')->where('signup_date', '<', date('Y-m-d H:i:s', strtotime($now . "-4 days")))->first();
        $email_verify = 1;

        if($user) {
            $email_verify = 0;
        }

        $connect_flag = CBR_table::where('id', Auth::user()->id)->select('direct_connect_flag', 'hris_connect_flag', 'api_connect_flag')->first();
        $logo_url = User::where('id', Auth::user()->id)->first()->logo_url;
        $market = Market::where('short_lang', 'en')->get();
        $countries = CommonController::countriesArray();
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

        return view('front.business.settings', compact('user_info','market', 'countries', 'freeEmailList', 'logo_url', 'connect_flag', 'email_verify'));
    }

    public function template_logo_add(Request $request)
    {
        $fileName = '';
        $user_info = User::find(Auth::user()->id);

        if($request->file('upload_logo')) {
            $file = $_FILES['upload_logo']['tmp_name'];
            $source_properties = getimagesize($file);
            $image_type = $source_properties[2];

            if(!is_null($user_info->logo_url))
            {
                Storage::disk('file_upload')->delete($user_info->logo_url);
            }

            $fileName = Storage::disk('file_upload')->put('template_logo', $request->file('upload_logo'));
            $fileFullName = public_path('upload') . '/' . $fileName;
            if ($image_type == 2) {
                $old_image = imagecreatefromjpeg($fileFullName);
                $target_layer = $this->fn_resize($old_image, $source_properties[0], $source_properties[1]);
                imagejpeg($target_layer, $fileFullName);
            } elseif ($image_type == 1) {
                $old_image = imagecreatefromgif($fileFullName);
                $target_layer = $this->fn_resize($old_image, $source_properties[0], $source_properties[1]);
                imagegif($target_layer, $fileFullName);
            } elseif ($image_type == 3) {
                $old_image = imagecreatefrompng($fileFullName);
                $target_layer = $this->fn_resize($old_image, $source_properties[0], $source_properties[1]);
                imagepng($target_layer, $fileFullName);

            }
        }

        $form_data = array(
            'logo_url' => $fileName
        );
        User::where('id', Auth::user()->id)->update($form_data);

        return response()->json(['success' => 'Data Added successfully.', 'logo_url' => $fileName]);
    }

    private function fn_resize($old_image, $width, $height) {
        $target_width = 280;
        $target_height = 50;
        $image_size_rate = $width / $height;
        $new_image = imagecreatetruecolor($target_width, $target_height);
        $white = imagecolorallocate($new_image, 255, 255, 255);
        imagefill($new_image,0,0, $white);

        $wm = $width / $target_width;
        $hm = $height / $target_height;
        $h_height = $target_height / 2;
        $w_height = $target_width / 2;

        if($image_size_rate > 3) {
            imagecopyresampled($new_image, $old_image, 0 , 0, 0, 0, $target_width, $target_height, $width, $height);
            return $new_image;
        } else {
            $adjusted_height = $height / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled($new_image, $old_image,0,-$int_height,0,0,$target_width,$adjusted_height,$width,$height);

            return $new_image;
        }

        /*if($width > $height) {
            $adjusted_width = $width / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            dd('111');

            imagecopyresampled($new_image, $old_image, -$int_width,0,0,0, $adjusted_width, $target_width, $width, $height);
        } elseif(($width < $height) || ($width == $height)) {
            $adjusted_height = $height / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            dd('222');
            imagecopyresampled($new_image, $old_image,0,-$int_height,0,0,$target_width,$adjusted_height,$width,$height);
        } else {
            imagecopyresampled($new_image, $old_image,0,0,0,0,$target_width,$target_height,$width,$height);
        }*/

/*        imagefill($new_image,0,0, $white);
        imagecopyresampled($new_image, $old_image, 0 , 0, 0, 0, $target_width, $target_height, $width, $height);*/
//        return $new_image;
    }

}
