<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Country_list;
use App\Market;
use App\Signup_history;
use App\User_main;
use App\Country_spec_info;
use App\CBR_table;
use App\CUR_table;
use App\Cohort;
use App\Invite_code;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $market = Market::where('short_lang', 'it')->get();
        $country = Country_list::where('short_lang', 'it')->get();
        return view('auth.register',compact('country','market'));
    }


    public function email_verify(Request $request)
    {
        $email_verify = User::where('email',$request->email)->exists();

        echo json_encode($email_verify);
    }

    public function code_verify(Request $request)
    {
        $code_verify = Invite_code::where('invite_code',$request->code)->where('expires_on','>=',date('Y-m-d'))->exists();

        echo json_encode($code_verify);
    }

    public function user_create(Request $request)
    {
        $user = new User;
        if(User::count()==0)
            $user->id = Country_spec_info::value('CUR_CBR_starting_number');
        else
            $user->id = User::max('id')+1;

        $user->user_type = $request->user_type;

        if($request->user_type=='hris'){
            $user->hris_type = $request->hris_type;
        }



        /*   cohort id and referral code */
        $date = $this->week_start_date();
        if($date)
        {
            $cohort_id = Cohort::where(['week_start_date'=>$date, 'Type_of_cohort'=>$user->user_type])->first()->cohort_id;
        }

        /*  Invite code  */
        if($request->referral_code!='')
        {
            $refferre = Invite_code::where('invite_code',$request->referral_code)->where('expires_on','>',date('Y-m-d'))->first();
            if($refferre!=null)
            {
                $refferre_CBR_id = $refferre->generated_by_CBR_id;
                Invite_code::where('invite_code',$request->referral_code)
                            ->update(['used_by_CBR_id'=>$user->id]);
            }else
                 return redirect()->back()->with('referral_code','refferral code error');
        }else
        {
            $refferre_CBR_id = '';
        }


        $user->signup_date = date('Y-m-d H:i:s');
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->cohort_id = $cohort_id;
        $user->referrer_CBR_id = $refferre_CBR_id;
        if($request->user_type!='citizen')
            $user->business_type = $request->business_type;
        $user->save();


        $birthday = $request->year.'-'.$request->month.'-'.$request->day;
        if($request->user_type!='citizen')
        {
            if(CBR_table::find($request->id))
                $business = CBR_table::find($user->id);
            else
                $business = new CBR_table;
                $business->id = $user->id;
                $business->user_type = $user->user_type;
                $business->hris_type = $user->hris_type;
                $business->business_type = $request->business_type;
                $business->market = $request->market;
                $business->employees = $request->employees;
                $business->save();


            switch ($user->business_type) {
              case 'organisation':
                {

                    $cbr_data = CBR_table::Where('id',$user->id)->update([
                        'ocb_name'=>$request->ocb_name,
                        'VAT_if_registered'=>$request->VAT_if_registered,
                        'lrd_firstname'=>$request->lrd_firstname,
                        'lrd_lastname'=>$request->lrd_lastname,
                        'lrd_DOB'=>$birthday,
                        'lrd_country'=>$request->lrd_country,
                        'lrd_nationality'=>$request->lrd_nationality,
                        'ma_HBN'=>$request->ma_HBN,
                        'ma_street'=>$request->ma_street,
                        'ma_town_or_city'=>$request->ma_town_or_city,
                        'ma_postcode'=>$request->ma_postcode
                    ]);
                    break;
                }

              case 'selfemployed':

                    $cbr_data = CBR_table::Where('id',$user->id)->update([
                        'ocb_name'=>$request->ocb_name,
                        'VAT_if_registered'=>$request->VAT_if_registered,
                        'lrd_firstname'=>$request->lrd_firstname,
                        'lrd_lastname'=>$request->lrd_lastname,
                        'lrd_DOB'=>$birthday,
                        'lrd_country'=>$request->lrd_country,
                        'lrd_nationality'=>$request->lrd_nationality,
                        'ma_HBN'=>$request->ma_HBN,
                        'ma_street'=>$request->ma_street,
                        'ma_town_or_city'=>$request->ma_town_or_city,
                        'ma_postcode'=>$request->ma_postcode
                    ]);
                break;
              case 'company':

                    $cbr_data = CBR_table::Where('id',$user->id)->update([
                        'ocb_name'=>$request->ocb_name,
                        'company_no'=>$request->company_no,
                        'VAT_if_registered'=>$request->VAT_if_registered,
                        'lrd_firstname'=>$request->lrd_firstname,
                        'lrd_lastname'=>$request->lrd_lastname,
                        'lrd_DOB'=>$birthday,
                        'lrd_country'=>$request->lrd_country,
                        'lrd_nationality'=>$request->lrd_nationality,
                        'ma_HBN'=>$request->ma_HBN,
                        'ma_street'=>$request->ma_street,
                        'ma_town_or_city'=>$request->ma_town_or_city,
                        'ma_postcode'=>$request->ma_postcode
                    ]);
                break;


              default:
                break;
            }
        }else{

            $cur_data = CUR_table::Insert([
                'id'=>$user->id,
                'user_type'=>$user->user_type,
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'DOB'=>$birthday,
                'country'=>$request->country,
                'nationality'=>$request->nationality,
                'ma_HBN'=>$request->ma_HBN,
                'ma_street'=>$request->ma_street,
                'ma_town_or_city'=>$request->ma_town_or_city,
                'ma_postcode'=>$request->ma_postcode
            ]);
        }

        return redirect('/login_redirect/'.$user->email);
    }


    public function week_start_date()
    {
        // dd(app()->getLocale());
        $last_week = Cohort::latest('week_start_date')->first();
        $dt_min = new \DateTime("last saturday"); // Edit
        $dt_min->modify('+1 day');
        $week_start_date = $dt_min->format('Y-m-d');
        if($last_week==null||$last_week->week_start_date!=$week_start_date)
        {
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'business'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'advisors'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'citizen'));
            Cohort::Insert(array('week_start_date' => $week_start_date,'Type_of_cohort' => 'hris'));
        }

        return $week_start_date;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => 'unique:users|required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
