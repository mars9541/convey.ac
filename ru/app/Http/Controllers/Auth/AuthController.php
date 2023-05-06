<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Api_Session;
use Laravel\Passport\Passport;
use App\Branch;
class AuthController extends Controller
{
    //
    public function login(Request $request) {

      $request->validate([
           'CBR_id' => 'required|string',
           'password' => 'required|string'
         ]);
      $user = User::find($request->CBR_id);
      if($user)
        $credentials = ['email'=>$user->email,'password'=>$request->password];
      else
          return response()->json(['message'=>'Unauthorized, credential not like'
          ],401);

      if(!Auth::attempt($credentials))
         return response()->json([
            'message' => 'Unauthorized, credential not like'
         ],401);

      $user = $request->user();
      if($user->user_type != 'business')
        return response()->json([
            'message' => 'Unauthorized,because not business type'
         ],401);
      if($request->hris_id)
      {
        $check_hris = User::where('id',$request->hris_id)->where('user_type','hris')->exists();
        if(!$check_hris)
          return response()->json([
            'message' => 'HRIS account error!'
          ],401);
      }

      if($request->branch_id)
      {
        $check_branch = Branch::where('CBR_id',$user->id)->where('id',$request->branch_id)->exists();
        if(!$check_branch)
          return response()->json([
            'message' => 'Branch account error!'
          ],401);
      }
      $tokenResult = $user->createToken('Personal Access Token');
      $token = $tokenResult->token;

      if ($request->remember_me)
          $token->expires_at = Carbon::now()->addWeeks(1);
     else
          $token->expires_at = Carbon::now()->addHours(2);
      $token->save();

      $api_session = new Api_Session;
      $api_session->id = $token->id;
      $api_session->date = date('Y-m-d');
      $api_session->time = date('H:i:s');
      $api_session->type = "POST";
      $api_session->hris_id = $request->hris_id;
      $api_session->user_id = $user->id;
      $api_session->branch_id = $request->branch_id;
      $api_session->save();

      return response()->json([
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'api_session_id' => $token->id,
        'expires_at' => Carbon::parse(
           $tokenResult->token->expires_at
        )->toDateTimeString()
      ]);
    }

    public function register(Request $request)
    {
      $request->validate([
             'fName' => 'required|string',
             'lName' => 'required|string',
             'email' => 'required|string|email|unique:users',
             'password' => 'required|string'
      ]);
      $user = new User;
      $user->first_name = $request->fName;
      $user->last_name = $request->lName;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return response()->json([
           'message' => 'Successfully created user!'
      ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
          'message' => 'Successfully logged out'
        ]);
    }
    public function user(Request $request)
    {
      $user_info = [];
      $user_info['CBR_ID'] = $request->user()->id;
      // $user_info['user_type'] = $request->user()->user_type;
      // $user_info['business_type'] = $request->user()->business_type;
      // $user_info['email'] = $request->user()->email;
      $user_info['credits_remaining'] = $request->user()->credits_remaining;
      // $user_info['created_at'] = $request->user()->created_at;
      $user_info['email_verify'] = $request->user()->email_verify;
      return response()->json($user_info);
    }
}
