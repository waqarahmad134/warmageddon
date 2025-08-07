<?php

namespace App\Http\Controllers\Auth;
use App\AffiliateApiHistory;
use App\GeneralSetting;
use App\Http\Controllers\backend\affiliate\AffiliateAppController;
use Auth;
use Mail;
use Session;
use App\User;
use App\Token;
use Socialite;
use App\Account;
use Carbon\Carbon;
use App\VerifyUser;
use App\SocialLogin;
use App\Notification;
use App\PropersixBonus;
use App\Mail\VerifyMail;
use App\RegistrationBonus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
       // dd($request->all());
//        if($request->method()=="GET")
//        {
////            Toastr::warning("Something Went Wrong");
//            return redirect('/user-registration');
//        }
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     // 'first_name' => ['required', 'string', 'max:255'],
        //     // 'gender' => ['required', 'string', 'max:255'],
        //     // 'country' => ['required'],
        //     // 'zipcode' => ['required'],
        //     'phoneField1' => ['required','min:8'],
        //     // 'state' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255','unique:user_profiles'],
        //     'address' => ['required', 'string', 'max:255'],
        //     // 'last_name' => ['required', 'string', 'max:255'],
        //     'dob' => ['required','before:-18 years'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|<>.^*()%!-]).*$/'],
        // ]);
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:user_profiles'],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required','before:-18 years'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // unique reference key
    function generateReferenceKey() {
        $number = str_random(10); // better than rand()

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateReferenceKey();
        }

        // otherwise, it's valid and can be used
        return $number;
    }
    function barcodeNumberExists($number) {
        return User::whereRef_key($number)->exists();
    }
    // pusher token
    function generatePusherToken()
    {
        $number              = str_random(10);
        if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
        {
            return $this->generatePusherToken();
        }
        else
        {
           return $number;
        }
    }
    protected function create(array $data)
    {

        $user=new User;
        $user->user_name=strip_tags($data['username']);
        $user->email=strip_tags($data['email']);
        $user->dob=strip_tags(date('Y-m-d', strtotime($data['dob'])));
        $user->country=strip_tags($data['country']);
//        $user->country_code=+92;
        $user->country_code=strip_tags($data['phoneField1_phoneCode']);
        $user->phone=Ltrim($data['phoneField1'],0);
        $user->password=Hash::make(strip_tags($data['password']));
        $user->ip_address= \Request::ip();
        $user->pro_child = strip_tags($data['pro_child']);
        if (isset($data['tac']))
        {
            $user->terms_condition    = 1;
        }
        if (isset($data['bonus_offer']))
        {
            $user->bonus_offers   = 1;
        }
        $user->ref_key         = $this->generateReferenceKey();
        $user->pusher_token    = $this->generatePusherToken();
        $user->save();

        if ($data['ref_key']!="null") {
            $aff_user       = User::where('ref_key',$data['ref_key'])->first();
            $listaffiliate=new \App\ListAffiliate;
            $listaffiliate->user_id=$user->id;
            $listaffiliate->name=strip_tags($data['username']);
            $listaffiliate->aff_id=$aff_user->id;
            $listaffiliate->ref_key=strip_tags($data['ref_key']);
            $listaffiliate->save();
            $user->aff_id = $listaffiliate->id;
            $user->save();
        }

        $user_profile =new \App\UserProfile;
        $user_profile->user_id = $user->id;
        $user_profile->first_name=strip_tags($data['first_name']);
        $user_profile->last_name=strip_tags($data['last_name']);
        $user_profile->username=strip_tags($data['username']);
        $user_profile->gender=strip_tags($data['gender']);
        $user_profile->base_image='user/profile/avatar_new.png';
        $user_profile->country = strip_tags($data['country']);
        $user_profile->state = strip_tags($data['state']);
        $user_profile->zipcode =strip_tags($data['zipcode']);
        $user_profile->phone_number =strip_tags($data['phoneField1']);
        $user_profile->address =strip_tags($data['address']);
        $user_profile->date_of_birth =date('Y-m-d', strtotime(strip_tags($data['dob'])));
        $user_profile->save();


        $earning_game = new \App\GameEarning;
        $earning_game->user_id=$user->id;
        $earning_game->save();

        /*$account=new Account;
        $account->user_id=$user->id;
        $account->save();*/

        $wallet = new \App\ProsixUserWallet;
        $wallet->user_id=$user->id;
        $wallet->spin=0;
        $wallet->free_spin=0;
        $wallet->save();
        if($user->bonus_offers==1)
        {
//            Mail::send('mail.bonus_email', [
//            'username'      => $user->user_name,
//              'user_token'    => $user->ref_key,
////                   'verify_url'     => url('user/verify',$verifyUser->token),
//        ], function($message) use($data){
//            $message->subject('ProperSix Special Bonus Offers');
//            $message->to($data['email']);
//        });
            // subscribe to sendgrid email
            try {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => "{\"list_ids\":[\"f424453a-f9c1-42fc-b3e5-e7a46714cda6\"],\"contacts\":[{\"address_line_1\":\"string (optional)\",\"address_line_2\":\"string (optional)\",\"alternate_emails\":[\"$user->email\"],\"city\":\"string (optional)\",\"country\":\"string (optional)\",\"email\":\"$user->email\",\"first_name\":\" \",\"last_name\":\"string (optional)\",\"postal_code\":\"string (optional)\",\"region\":\"string (optional)\",\"custom_fields\":{}}]}",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer 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",
                        "content-type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                }
            } catch (\Exception $e) {
            Toastr::error('Something went wrong try again!','Error');
            return redirect()->back();
        }
        }
        $registerBounusDetail = \App\PropersixBonus::where('type','registration')->where('status',1)->first();
        if(!$registerBounusDetail){
            //account
            $role_r = Role::where('name', '=','User')->firstOrFail();
            $user->assignRole($role_r);
            $verifyUser = \App\VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);
        // Mail::to($user->email)->send(new VerifyMail($user));

             if(GeneralSetting::whereId(1)->first()->email_verification==1)
             {
                 Mail::send('mail.email_verify', [
                     'username'      => $user->user_name,
                     'user_token'    => $user->ref_key,
                     'verify_url'     => url('user/verify',$verifyUser->token),
                 ], function($message) use($data){
                     $message->subject('ProperSix email verification');
                     $message->to($data['email']);
                 });
             }


            return $user;
        }
        $exCountries = ($registerBounusDetail->ex_country) ? explode(',', $registerBounusDetail->ex_country) : [];

        $eligible = false;
        if(!in_array($user_profile->country, $exCountries) ){
          $eligible = true;
        }

        if($eligible){

            /* Register bnous for specific date */
              if ($registerBounusDetail->specific_day) {

                $bnousDate = date('Y-m-d' , strtotime($registerBounusDetail->specific_day));
                $currentDate = date('Y-m-d',time());

                /* if bonus date and current date is same then give register bonus to user */
                if($bnousDate == $currentDate){
                  $this->Bonus($user,$registerBounusDetail);
                }
              }

            /* login bnous for from and till date */
              if ($registerBounusDetail->till) {
                  $bnousfrom = strtotime($registerBounusDetail->from);
                  $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($registerBounusDetail->till) ) );
                  $currentDate = time();
                  if($bnousfrom <= $currentDate && $currentDate <= $bnoustill){
                    $this->Bonus($user,$registerBounusDetail);
                  }
              }

              if ($registerBounusDetail->recurring && !$registerBounusDetail->specific_day) {
                if ($registerBounusDetail->recurring == 'w') {
                    if ($registerBounusDetail->w_2 == date("D"))  {
                        $this->Bonus($user,$registerBounusDetail);
                    }
                  }
                if ($registerBounusDetail->recurring == 'm') {
                    if ($registerBounusDetail->w_2 == date("d"))  {
                          $this->Bonus($user,$registerBounusDetail);
                      }
                  }
              }
        }


        //account
        $role_r = Role::where('name', '=','User')->firstOrFail();
        $user->assignRole($role_r);

        $verifyUser = \App\VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

       // Mail::to($user->email)->send(new VerifyMail($user));

        if(GeneralSetting::whereId(1)->first()->email_verification==1)
        {
            Mail::send('mail.email_verify', [
                'username'      => $user->user_name,
                'user_token'    => $user->ref_key,
                'verify_url'     => url('user/verify',$verifyUser->token),
            ], function($message) use($data){
                $message->subject('ProperSix email verification');
                $message->to($data['email']);
            });
        }
        return $user;
    }
    protected function registered(Request $request,$user)
    {
        $stag                      = $request->session()->get('affiliate_session')!=null?$request->session()->get('affiliate_session')->stag:null;
       if ($stag!=null)
       {
           $check                     = AffiliateApiHistory::where('stag',$stag)->first();
           if ($check!=null && $check->count()>0)
           {
               $duplicate = true;
           }
           else
           {
               $duplicate = false;
           }
           $datetime = new \DateTime($user->created_at);
           $registration_date = $datetime->format(\DateTime::ATOM);
           $playerData = [];
           $playerData['players'] = [
               [
                   'tag' => $stag,
                   'email' => $user->email,
                   'user_id' => $user->id,
                   // optional data
                   'date_of_birth' => $user->dob,
                   'first_name' => $user->first_name,
                   'last_name' => $user->last_name,
                   'nickname' => null,
                   'gender' => null,
                   'country' => null,
                   'language' => null,
                   'sign_up_at' => $registration_date,
                   'duplicate' => $duplicate,

               ]
           ];
           $apihistory                          = new AffiliateApiHistory();
           $apihistory->api_type                = "import player";
           $apihistory->source_fun              = "User Registration";
           $apihistory->host                    = request()->getHost()=="propersix.casino"?'propersix':'dev';
           $apihistory->user_id                 = $user->id;
           $apihistory->stag                    = $stag;
           $apihistory->data                    = \Opis\Closure\serialize($playerData);
           //$apihistory->responseCode          = json_decode($response->getStatusCode());
           // $apihistory->response              = \Opis\Closure\serialize(json_decode($response->getBody()));
           $apihistory->status                   = 0;
           $apihistory->save();
       }
        if (Auth::user()->verified == 0) {
            $userId = Auth::user()->id;
            if (GeneralSetting::whereId(1)->first()->email_verification==1)
            {
                auth()->logout();
            }
//            $this->emailVerify($userId);
//            dd($userId);
//            return redirect()->back()->with('status','You need to verify your account. We have sent you an activation code, please check your email.');
//            Toastr::Error('You need to verify your account. We have sent you an activation code, please check your email.','Error');
//            return redirect('user-login')/* ->with('error','You need to verify your account. We have sent you an activation code, please check your email.') */;
//
            try {
                if(@Auth::check()){

                    return [
                        'verification_status'   => 0
                    ];
                }
                else {
                    return view('frontend.login.after_reg',[
                        'data'   => '1',
                        'userId' => $userId
                    ]);
                }
            }
            catch (\Exception $e) {
                Toastr::error('Something went wrong please try again!');
                return redirect()->back();
            }
        }
       /*  if (Auth::user()->phone_verification == 0) {

            $token = Token::create([
                'user_id' => Auth::user()->id
            ]);
            if ($token->sendCode()) {
                session()->put("token_id", $token->id);
                session()->put("user_id",  Auth::user()->id);

                return redirect()->route('user.sms_send_verification');
            }
            $token->delete();// delete token because it can't be sent
            return redirect('user-login')->withErrors([
                "Your number is not correct ! Please enter your right number "
            ]);
            //return redirect('verification');
          } */
        $this->guard()->logout();
       // Toastr::success('We sent you an activation code. Check your email and click on the link to verify.','Success');
        return redirect('/');

       //return response()->json(['success'=>'success']);
    }
    function emailVerify($userId){
        try {
            if(@Auth::check()){

                return redirect('/');
            }
            else {
                return view('frontend.login.after_reg',[
                    'data'   => '1',
                    'userId' => $userId
                ]);
            }
        }
        catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function Bonus($user,$data){

        $bonus=new \App\Bonus;
        $bonus->user_id = $user->id;
        $bonus->add_bonus_id=$data->id;
        $bonus->amount= strip_tags($data->bonus_amount);
        $bonus->spin = strip_tags($data->free_spin);
        $bonus->betsize = strip_tags($data->bet_size);
        $bonus->line = strip_tags($data->lines);
        $bonus->type='registration_bonus';
        $bonus->from='casino';
        $bonus->to=$user->user_name;
        $bonus->save();
        $user_id  = $user->id;
        $logModel = $bonus;
        $request = $bonus;
        $log =  $bonus->type;
        logCreatedActivity($user_id,$logModel,$request,$log);
        // notification
        if ($data->bonus_amount>0 || $data->free_spin>0)
        {
            $notification=new \App\Notification;
            $notification->user_id=$user->id;
            if ($data->bonus_amount>0 && $data->free_spin>0)
            {
                $notification->message='You got '.$data->bonus_amount.' token and '.$data->free_spin.' spin bonus for registration';
            }
            else if ($data->bonus_amount>0)
            {
                $notification->message='You got '.$data->bonus_amount.' token for registration';
            }
            else if ($data->free_spin>0)
            {
                $notification->message='You got '.$data->free_spin.' spin bonus for registration';
            }
            $notification->save();
        }


        /*$account=\App\Account::find($user->account->id);
        $account->total= strip_tags($data->bonus_amount);
        $account->total_spin= strip_tags($data->free_spin);
        $account->save();*/

        $wal = \App\ProsixWalletType::where('type',$bonus->type)->first();
        if (is_null($wal)) {
            $wallet_type= new \App\ProsixWalletType();
        } else {
            $wallet_type = $wal;
        }
        $wallet_type->type=$bonus->type;
        $wallet_type->save();
        $wallet =new \App\ProsixWallet();
        $wallet->user_id = $user->id;
        $wallet->amount = strip_tags($data->bonus_amount);
        $wallet->type_id =  $wallet_type->id;
        $wallet->created_by=$user->id;
        $wallet->save();

        $account=\App\ProsixUserWallet::updateOrCreate(['user_id'=>$user->id]);
        $account->free_token= @$data->bonus_amount;
        $account->free_spin= @$data->free_spin;
        $account->type_id= $wallet_type->id;
        $account->save();


    }

}
