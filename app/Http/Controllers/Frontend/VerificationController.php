<?php

namespace App\Http\Controllers\Frontend;
use Auth;
use App\User;
use App\Token;
use Brian2694\Toastr\Facades\Toastr;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
class VerificationController extends Controller
{
    function mobile_verification(){
        if (Auth::user()->phone_verification == 0) {
            return view('frontend.auth.phone_verification');
          }else {
             return redirect()->back();
          }
    }

    function verification(Request $r){
        $this->validate($r,[
            'mobile_phoneCode' => 'required|string|max:255',
            'mobile' => 'required||numeric',
        ]);
        $mobile=Ltrim($r->mobile,0);
        $data=User::find(Auth::user()->id);
        $data->country_code = $r->mobile_phoneCode;
        $data->phone = $mobile;
        $data->save();
        //$data->profile->phone_number=$r->mobile->save();

        $token = Token::create([
            'user_id' => Auth::user()->id
        ]);
        if ($token->sendCode()) {
            session()->put("token_id", $token->id);
            session()->put("user_id", $data->id);

            return redirect()->route('user.sms_send_verification');
        }
        $token->delete();// delete token because it can't be sent
        return redirect('user-login')->withErrors([
            "Your number is not correct ! Please enter your right number "
        ]);
    }

    function Resend(){
        $token = Token::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);
        if ($token->sendCode()) {
            session()->put("token_id", $token->id);
            session()->put("user_id", Auth::user()->id);

            return redirect()->route('user.sms_send_verification');
        }

        $token->delete();// delete token because it can't be sent
        return redirect('user-login')->withErrors([
            "Your number is not correct ! Please enter your right number "
        ]);
    }
    function SendCodeForm(){
        if (Auth::user()->phone_verification == 0) {
            return view('frontend.auth.verification_code');
          }else {
             return redirect('/');
          }
    }

    public function storeCodeForm(Request $request)
    {
        // throttle for too many attempts
        if (! session()->has("token_id", "user_id")) {
            return redirect("user-login");
        }

        $token = Token::find(session()->get("token_id"));
        if (! $token ||
            ! $token->isValid() ||
            $request->code !== $token->code ||
            (int)session()->get("user_id") !== $token->user->id
        ) {
        	 Toastr::Error('Invalid Token','Error');
           // return redirect()->route('user.sms_send_verification');
        }
        $data=User::find($token->user_id);
        $data->phone_verification=1;
        $data->save();
        $token->used = true;
        $token->save();
      //  $this->guard()->login($token->user, session()->get('remember', false));

        session()->forget('token_id', 'user_id');
        //auth()->logout();
        Toastr::success('Verification successful !','Success');
       // return redirect('/');
       return response()->json('succes',200);
    }

    // email verification

    public function email_verification()
    {
        $user                             = \Illuminate\Support\Facades\Auth::user();
        $new_token                        = str_random(40);
        $verifyUser                       = \App\VerifyUser::where('user_id',$user->id)->first();
        $verifyUser->token                = $new_token;
        $verifyUser->save();
        Mail::send('mail.email_verify', [
            'username'      => $user->user_name,
            'user_token'    => $user->ref_key,
            'verify_url'     => url('user/verify',$new_token),
        ], function($message) use($user){
            $message->subject('ProperSix email verification');
            $message->to($user->email);
        });
        return 'success';
    }
    public function send_email_verification()
    {
        $user                             = \Illuminate\Support\Facades\Auth::user();
        $new_token                        = str_random(40);
        $verifyUser                       = \App\VerifyUser::where('user_id',$user->id)->first();
        $verifyUser->token                = $new_token;
        $verifyUser->save();
        Mail::send('mail.email_verify', [
            'username'      => $user->user_name,
            'user_token'    => $user->ref_key,
            'verify_url'     => url('user/verify',$new_token),
        ], function($message) use($user){
            $message->subject('ProperSix email verification');
            $message->to($user->email);
        });
       Toastr::success('Verification email has been sent successfully');
       return redirect()->back();
    }

}
