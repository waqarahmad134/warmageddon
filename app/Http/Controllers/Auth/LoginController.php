<?php

namespace App\Http\Controllers\Auth;
use App\AffiliateApiHistory;
use App\GeneralSetting;
use Auth;
use Session;
use Validator;
use App\User;
use App\Bonus;
use App\Token;
use Socialite;
use App\Account;
use Carbon\Carbon;
use App\LoggedinUser;
use App\ProsixWallet;
use App\PropersixBonus;
use App\SocialIdentity;
use App\ProsixUserWallet;
use App\ProsixWalletType;
use App\RegistrationBonus;
use Jenssegers\Agent\Agent;
use App\LoggedinHistoryUser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    function authenticated(Request $request, $user)
    {

        $request->session()->put('userDetail',Auth::user()->id);
        // if (!$user->verified) {
        //     auth()->logout();
        //     Toastr::Error('You need to verify your account. We have sent you an activation code, please check your email.','Error');
        //     return back();
        // }

        $agent = new Agent();
        $user->last_login_at = Carbon::now();
        $user->last_login_ip = $request->getClientIp();
        $user->save();
        $loggedIn=\App\LoggedinUser::firstOrCreate(['user_id' => $user->id]);
        $loggedIn->user_id=$user->id;
        $loggedIn->s_id = Session::getId();
        $loggedIn->save();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $version = $agent->version($platform);
        $login_history=\App\LoggedinHistoryUser::firstOrCreate(['user_id' => $user->id]);
        $login_history->user_id=$user->id;
        $login_history->device=$agent->device();
        $login_history->browser=$browser.'/'.$version.'('.$platform.')';
        $login_history->save();

    }

    protected function sendLoginResponse(Request $request)
    {
      # code...
        /* checking User status active or inactive */
        if (Auth::user()->status != 1) {
            auth()->logout();
            Toastr::Error('You are blocked! If you have any questions, contact us.','Error');
            return back();
        }
        /*if (!Auth::user()->hasRole(['User'])) {
            auth()->logout();
            Toastr::Error('You are not an user .Please register first! ','Error');
            return back();
        }*/
        if(GeneralSetting::whereId(1)->first()->email_verification==1)
        {
            if (Auth::user()->verified != 1) {
                $user = Auth::user();
                $userId = Auth::user()->id;
                auth()->logout();
                return [
                    'verification_status' => 0,
                    'user'  => $user,
                    'userId' => $userId
                ];
//                Toastr::Error('You need to verify your account. We have sent you an activation code, please check your email.','Error');
//                return view('frontend.login.after_reg',[
//                    'data'   => '1',
//                    'userId' => $userId
//                ]);
            }
        }


        /* Updating user last Login History */
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $user=\App\User::where('email',$request->email)->first();
        $now = Carbon::now();
        $created_at = Carbon::parse($user['last_login_at']);
        $diffHours = $created_at->diffInHours($now);

        $userUp=\App\User::find(Auth::user()->id);
        $agent = new Agent();
        $userUp->last_login_at = Carbon::now();
        $userUp->last_login_ip = $request->getClientIp();
        $userUp->save();

        /*  active login Bonus detail */

        $LoginBonusDetail = \App\PropersixBonus::where('type','login')->where('status',1)->first();

        if(!$LoginBonusDetail){
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        }
        $validUserArray = ($LoginBonusDetail->users) ? explode(',', $LoginBonusDetail->users) : [];
        $exCountries = ($LoginBonusDetail->ex_country) ? explode(',', $LoginBonusDetail->ex_country) : [];

        /* Current login user Profile Detail */
        $profile =  \DB::table("user_profiles")->where('user_id' , Auth::user()->id)->first();

        /* check user already take bonus or not */
        $userBonus = Bonus::where('add_bonus_id', $LoginBonusDetail->id)->where('user_id',$profile->user_id)->first();

        /* Check user is valid for bonus and also checking is country excluded for bonus or not */

        $eligible = false;

        if( empty($LoginBonusDetail->users) && !in_array($profile->country, $exCountries) ){
          $eligible = true;
        }

        if(!empty($LoginBonusDetail->users) && in_array($profile->user_id, $validUserArray) ){
          $eligible = true;
        }



        if($eligible && !$userBonus) {
          /* Total user Earnong ot Total Token user occupy */
          $earn = \DB::table('game_earnings')->where('user_id', Auth::id())->sum('token');
          if($LoginBonusDetail->wagering_req <= $earn ){

              /* login bnous for specific date */
              if ($LoginBonusDetail->specific_day) {

                $bnousDate = date('Y-m-d' , strtotime($LoginBonusDetail->specific_day));
                $currentDate = date('Y-m-d',time());

                /* if bonus date and current date is same then give login bonus to user */
                if($bnousDate == $currentDate){
                  $this->Bonus($user,$LoginBonusDetail);
                }
              }

              /* login bnous for from and till date */
              if ($LoginBonusDetail->till) {
                  $bnousfrom = strtotime($LoginBonusDetail->from);
                  $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($LoginBonusDetail->till) ) );
                  $currentDate = time();
                  if($bnousfrom <= $currentDate && $currentDate <= $bnoustill){
                    $this->Bonus($user,$LoginBonusDetail);
                  }
              }

              if ($LoginBonusDetail->recurring) {
                if ($LoginBonusDetail->recurring == 'w') {
                    if ($LoginBonusDetail->w_2 == date("D"))  {
                        $this->Bonus($user,$LoginBonusDetail);
                    }
                  }
                if ($LoginBonusDetail->recurring == 'm') {
                    if ($LoginBonusDetail->w_2 == date("d"))  {
                          $this->Bonus($user,$LoginBonusDetail);
                      }
                  }
              }
          }
        }

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());

    }

    protected function sendLoginResponse23(Request $request)
    {
        if (Auth::user()->status != 1) {
            auth()->logout();
            Toastr::Error('You are blocked! If you have any questions, contact us.','Error');
            return back();
        }
        if (!Auth::user()->hasRole(['User'])) {
            auth()->logout();
            Toastr::Error('You are not registered. Please register! ','Error');
            return back();
        }
        if (Auth::user()->verified != 1) {
            $userId = Auth::user()->id;
            auth()->logout();
            Toastr::Error('You need to verify your account. We have sent you an activation code, please check your email.','Error');
            return view('frontend.login.after_reg',[
                'data'   => '1',
                'userId' => $userId
            ]);
        }



        /*   if (Auth::user()->phone_verification == 0) {
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
        } */
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $user=\App\User::where('email',$request->email)->first();
        $now = Carbon::now();
        $created_at = Carbon::parse($user['last_login_at']);
        $diffHours = $created_at->diffInHours($now);

        $userUp=\App\User::find(Auth::user()->id);
        $agent = new Agent();
        $userUp->last_login_at = Carbon::now();
        $userUp->last_login_ip = $request->getClientIp();
        $userUp->save();

        /**
        * Checking either user country in valid for bonus or not
        */
        if ((EligibleBonus($user->id)->count()) >= 1) {

            /* Get detail of bonus of type login */
            $bonus_am = PropersixBonus::where('type','login')->where('status',1)->first();
            if (isset($bonus_am)) {
                /* Checking user already avail the bonus or not */
                $b_c = Bonus::where('add_bonus_id', $bonus_am->id)->first();

                if (is_null($b_c)) {

                    /* As user has not avail, now checking either cojuntry wuse vaild or not. country exclude for bonus */
                    $da = PropersixBonus::where('type','login')->where('ex_country','like', '%'.$user->profile->country.'%')->count();

                    /*$earn = \DB::table('game_earnings')->where('user_id', Auth::id())->sum('token');

                    if($bonus_am->wagering_req < $earn){
                      if(!empty($bonus_am->specific_day)){
                        if()
                      }
                      if(!empty($bonus_am->till)){}
                    }*/

                    if ($da <= 0) {
                        $earn = \DB::table('game_earnings')->where('user_id', Auth::id())->sum('token');
                        if ($bonus_am->wagering_req < $earn) {
                        if ($bonus_am->specific_day) {
                            $data = PropersixBonus::where('type','login')->where('specific_day','=',Carbon::today()->toDateString())->where('status',1)->first();
                            if (!is_null($data)) {
                                $this->Bonus($user,$bonus_am);
                            }
                        }
                        if ($bonus_am->till) {
                            $data = PropersixBonus::where('type','login')
                                                ->where('from', '<=', Carbon::today()->toDateString())
                                                ->where('till', '>=', Carbon::today()->where('status',1)->toDateString())
                                                ->first();
                            if ($data->count() > 0) {
                                $this->Bonus($user,$bonus_am);
                            }
                        }
                        if ($bonus_am->recurring) {
                            if ($bonus_am->recurring == 'w') {
                                if ($bonus_am->w_2 == date("W"))  {
                                    $this->Bonus($user,$bonus_am);
                                }
                            }
                            if ($bonus_am->recurring == 'm') {
                                if ($bonus_am->w_2 == date("d"))  {
                                    $this->Bonus($user,$bonus_am);
                                }
                            }
                         }
                        }
                    }
                }
            }

            $bonus_am = PropersixBonus::where('type','registration')->where('status',1)->first();
            if (isset($bonus_am)) {
                $b_c = Bonus::where('add_bonus_id',$bonus_am->id)->first();
                if (is_null($b_c)) {
                    $da = PropersixBonus::where('type','login')->where('ex_country','like', '%'.$user->profile->country.'%')->count();
                    if ($da <= 0) {
                        $earn = \DB::table('game_earnings')->where('user_id', Auth::id())->sum('token');
                        if ($bonus_am->wagering_req < $earn) {
                        if ($bonus_am->specific_day) {
                            $data = PropersixBonus::where('type','login')->where('specific_day','=',Carbon::today()->toDateString())->where('status',1)->first();
                            if (!is_null($data)) {
                                $this->Bonus($user,$bonus_am);
                            }
                        }
                        if (@$bonus_am->till) {
                            $data = PropersixBonus::where('type','login')
                                                ->where('from', '<=', Carbon::today()->toDateString())
                                                ->where('till', '>=', Carbon::today()->where('status',1)->toDateString())
                                                ->first();
                            if ($data->count() > 0) {
                                $this->Bonus($user,$bonus_am);
                            }
                        }
                        if (@$bonus_am->recurring) {
                            if (@$bonus_am->recurring == 'w') {
                                if (@$bonus_am->w_2 == date("W"))  {
                                    $this->Bonus($user,$bonus_am);
                                }
                            }
                            if (@$bonus_am->recurring == 'm') {
                                if (@$bonus_am->w_2 == date("d"))  {
                                    $this->Bonus($user,$bonus_am);
                                }
                            }
                         }
                        }
                    }
                }
            }
        }

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        if(\Auth::user()->logged_id){
            \Auth::user()->logged_id->delete();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ? : redirect('/');
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($provider,Request $request)
   {

      try {
           $user = Socialite::driver($provider)->user();
       } catch (\Exception $e) {
           return redirect('user-login')->with('login_message',$e->getMessage());
       }
       $authUser = $this->findOrCreateUser($user, $provider);
      // affilca code
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
           $datetime = new \DateTime($authUser->created_at);
           $registration_date = $datetime->format(\DateTime::ATOM);
           $playerData = [];
           $playerData['players'] = [
               [
                   'tag' => $stag,
                   'email' => $authUser->email,
                   'user_id' => $authUser->id,
                   // optional data
                   'date_of_birth' => $authUser->dob,
                   'first_name' => $authUser->first_name,
                   'last_name' => $authUser->last_name,
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
           $apihistory->user_id                 = $authUser->id;
           $apihistory->stag                    = $stag;
           $apihistory->data                    = \Opis\Closure\serialize($playerData);
           //$apihistory->responseCode          = json_decode($response->getStatusCode());
           // $apihistory->response              = \Opis\Closure\serialize(json_decode($response->getBody()));
           $apihistory->status                   = 0;
           $apihistory->save();
       }
       Auth::login($authUser, true);
       if (Auth::check()) {
         if (!Auth::user()->password) {
            Session::put('get_id',Auth::user()->id);
            auth()->logout();
            return view('frontend.auth.social_register');
         }
         else {
              Auth::login($authUser, true);
            return redirect($this->redirectTo);
         }

       }else {
           return redirect()->back();
       }
   }
    // instagram
    public function redirectToInstagramProvider()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = config('services.instagram.redirect');
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }

    public function instagramProviderCallback(Request $request)
    {

        $code = $request->code;
        if (empty($code))
        {
            return redirect('user-login')->with('login_message',"Failed to login with Instagram.");
        }

        $appId = config('services.instagram.client_id');
        $secret = config('services.instagram.client_secret');
        $redirectUri = config('services.instagram.redirect');

        $client = new Client();

        // Get access token
        $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'app_id' => $appId,
                'app_secret' => $secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
                'code' => $code,
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            Toastr::error('Unauthorized login to Instagram.');
            return redirect()->back();
        }

        $content = $response->getBody()->getContents();
        $content = json_decode($content);

        $accessToken = $content->access_token;
        $userId = $content->user_id;

        // Get user info
        $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

        $content = $response->getBody()->getContents();
        $oAuth = json_decode($content);

        // Get instagram user name
        $username = $oAuth->username;
        $authUser = $this->findOrCreateInstaUser($oAuth, "instagram");
        // affilka registration
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
            $datetime = new \DateTime($authUser->created_at);
            $registration_date = $datetime->format(\DateTime::ATOM);
            $playerData = [];
            $playerData['players'] = [
                [
                    'tag' => $stag,
                    'email' => $authUser->email,
                    'user_id' => $authUser->id,
                    // optional data
                    'date_of_birth' => $authUser->dob,
                    'first_name' => $authUser->first_name,
                    'last_name' => $authUser->last_name,
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
            $apihistory->user_id                 = $authUser->id;
            $apihistory->stag                    = $stag;
            $apihistory->data                    = \Opis\Closure\serialize($playerData);
            //$apihistory->responseCode          = json_decode($response->getStatusCode());
            // $apihistory->response              = \Opis\Closure\serialize(json_decode($response->getBody()));
            $apihistory->status                   = 0;
            $apihistory->save();
        }
        Auth::login($authUser, true);
        if (Auth::check()) {
            if (!Auth::user()->password) {
                Session::put('get_id',Auth::user()->id);
                auth()->logout();
                return view('frontend.auth.social_register');
            }
            else {
                Auth::login($authUser, true);
                return redirect($this->redirectTo);
            }

        }else {
            return redirect()->back();
        }

    }
    public function findOrCreateInstaUser($providerUser, $provider)
    {

        $account = SocialIdentity::whereProviderName($provider)
                                        ->whereProviderId($providerUser->id)
                                        ->first();

        if ($account) {
            return $account->user;
        }
        else {
            $user = User::where('user_name',$providerUser->username)->first();
            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->username.'@propersix.casino',
                    'user_name'  => $providerUser->username,
                    'ref_key'      => $this->generateReferenceKey(),
                    'pusher_token' => $this->generatePusherToken(),
                    'verified' =>1,
                ]);
                // assigning role to user
                $role_r = Role::where('name', '=','User')->firstOrFail();
                $user->assignRole($role_r);
                $user_profile             = new \App\UserProfile;
                $user_profile->user_id    = $user->id;
                $user_profile->username   = $providerUser->username;
                $user_profile->first_name = 'First Name';
                $user_profile->last_name  = 'Last Name';
                $user_profile->gender     = 'M';
                $user_profile->country    = '1';
                $user_profile->state      = 'Badakhshan';
                $user_profile->zipcode    = '00000';
                $user_profile->phone_number = "00";
                $user_profile->address = 'Address';
                $user_profile->date_of_birth = date('Y-m-d', strtotime('01-01-1970'));
                $user_profile->base_image = 'user/profile/avatar_new.png';
                $user_profile->save();

                $earning_game           = new \App\GameEarning;
                $earning_game->user_id  = $user->id;
                $earning_game->save();

                $wallet                 = new \App\ProsixUserWallet;
                $wallet->user_id        = $user->id;
                $wallet->spin           = 0;
                $wallet->free_spin      = 0;
                $wallet->save();

                $registerBounusDetail = \App\PropersixBonus::where('type','registration')->where('status',1)->first();
                if(!$registerBounusDetail){


                    $verifyUser = \App\VerifyUser::create([
                        'user_id' => $user->id,
                        'token' => str_random(40)
                    ]);
                    $user->identities()->create([
                        'provider_id'   => $providerUser->getId(),
                        'provider_name' => $provider,
                    ]);
                    return $user;
                }
                // registration bonus code
                $exCountries = ($registerBounusDetail->ex_country) ? explode(',', $registerBounusDetail->ex_country) : [];

                $eligible = false;
                if(!in_array($user_profile->country, $exCountries) ){
                    $eligible = true;
                }

                //  if($eligible){

                /* Register bnous for specific date */
                if ($registerBounusDetail->specific_day) {

                    $bnousDate = date('Y-m-d' , strtotime($registerBounusDetail->specific_day));
                    $currentDate = date('Y-m-d',time());

                    /* if bonus date and current date is same then give register bonus to user */
                    if($bnousDate == $currentDate){
                        $this->registration_bonus($user,$registerBounusDetail);
                    }
                }

                /* login bnous for from and till date */
                if ($registerBounusDetail->till) {
                    $bnousfrom = strtotime($registerBounusDetail->from);
                    $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($registerBounusDetail->till) ) );
                    $currentDate = time();
                    if($bnousfrom <= $currentDate && $currentDate <= $bnoustill){
                        $this->registration_bonus($user,$registerBounusDetail);
                    }
                }

                if ($registerBounusDetail->recurring && !$registerBounusDetail->specific_day) {
                    if ($registerBounusDetail->recurring == 'w') {
                        if ($registerBounusDetail->w_2 == date("D"))  {
                            $this->registration_bonus($user,$registerBounusDetail);
                        }
                    }
                    if ($registerBounusDetail->recurring == 'm') {
                        if ($registerBounusDetail->w_2 == date("d"))  {
                            $this->registration_bonus($user,$registerBounusDetail);
                        }
                    }
                }
                // }
                $verifyUser = \App\VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => str_random(40)
                ]);

            }

            $user->identities()->create([
                'provider_id'   => $providerUser->id,
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }
   public function findOrCreateUser($providerUser, $provider)
   {

       $account                  = SocialIdentity::whereProviderName($provider)
                                                  ->whereProviderId($providerUser->getId())
                                                  ->first();
       if ($account) {
           return $account->user;
       }
       else {
           $user = User::whereEmail($providerUser->getEmail())->first();
           if (!$user) {
               $user                         = new User();
               $user->email                  = $providerUser->getEmail()!=null?$providerUser->getEmail():str_replace(' ', '', $providerUser->getName()).'@propersix.casino';
               $user->user_name              = str_replace(' ', '', $providerUser->getName());
               $user->ref_key                = $this->generateReferenceKey();
               $user->pusher_token           = $this->generatePusherToken();
               $user->verified               = 1;
               $user->dob                    = date('Y-m-d', strtotime('01-01-1970'));
               $user->country                = '1';
               $user->phone                  = "12345678";
               $user->ip_address            = \Request::ip();
               $user->save();
               // assigning role to user
               $role_r = Role::where('name', '=','User')->firstOrFail();
               $user->assignRole($role_r);
//               $user = User::create([
//                   'email'        => $providerUser->getEmail()!=null?$providerUser->getEmail():$providerUser->getName().'@propersix.casino',
//                   'user_name'    => $providerUser->getName(),
//                   'ref_key'      => $this->generateReferenceKey(),
//                   'pusher_token' => $this->generatePusherToken(),
//                   'verified'     => 1,
//               ]);
               $user_profile             = new \App\UserProfile;
               $user_profile->user_id    = $user->id;
               $user_profile->username   = str_replace(' ', '', $providerUser->getName());
               $user_profile->first_name = 'First Name';
               $user_profile->last_name  = 'Last Name';
               $user_profile->gender     = 'M';
               $user_profile->country    = '1';
               $user_profile->state      = 'Badakhshan';
               $user_profile->zipcode    = '00000';
               $user_profile->phone_number  = "12345678";
               $user_profile->address    = 'Address';
               $user_profile->date_of_birth = date('Y-m-d', strtotime('01-01-1970'));
               $user_profile->base_image = 'user/profile/avatar_new.png';
               $user_profile->save();

               $earning_game           = new \App\GameEarning;
               $earning_game->user_id  = $user->id;
               $earning_game->save();

               $wallet                 = new \App\ProsixUserWallet;
               $wallet->user_id        = $user->id;
               $wallet->spin           = 0;
               $wallet->free_spin      = 0;
               $wallet->save();

               $registerBounusDetail = \App\PropersixBonus::where('type','registration')->where('status',1)->first();
               if(!$registerBounusDetail){
                   $verifyUser = \App\VerifyUser::create([
                       'user_id' => $user->id,
                       'token' => str_random(40)
                   ]);
                   $user->identities()->create([
                       'provider_id'   => $providerUser->getId(),
                       'provider_name' => $provider,
                   ]);
                   return $user;
               }
               // registration bonus code
               $exCountries = ($registerBounusDetail->ex_country) ? explode(',', $registerBounusDetail->ex_country) : [];

               $eligible = false;
               if(!in_array($user_profile->country, $exCountries) ){
                   $eligible = true;
               }

             //  if($eligible){

                   /* Register bnous for specific date */
                   if ($registerBounusDetail->specific_day) {

                       $bnousDate = date('Y-m-d' , strtotime($registerBounusDetail->specific_day));
                       $currentDate = date('Y-m-d',time());

                       /* if bonus date and current date is same then give register bonus to user */
                       if($bnousDate == $currentDate){
                           $this->registration_bonus($user,$registerBounusDetail);
                       }
                   }

                   /* login bnous for from and till date */
                   if ($registerBounusDetail->till) {
                       $bnousfrom = strtotime($registerBounusDetail->from);
                       $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($registerBounusDetail->till) ) );
                       $currentDate = time();
                       if($bnousfrom <= $currentDate && $currentDate <= $bnoustill){
                           $this->registration_bonus($user,$registerBounusDetail);
                       }
                   }

                   if ($registerBounusDetail->recurring && !$registerBounusDetail->specific_day) {
                       if ($registerBounusDetail->recurring == 'w') {
                           if ($registerBounusDetail->w_2 == date("D"))  {
                               $this->registration_bonus($user,$registerBounusDetail);
                           }
                       }
                       if ($registerBounusDetail->recurring == 'm') {
                           if ($registerBounusDetail->w_2 == date("d"))  {
                               $this->registration_bonus($user,$registerBounusDetail);
                           }
                       }
                   }
              // }
               $verifyUser = \App\VerifyUser::create([
                   'user_id' => $user->id,
                   'token' => str_random(40)
               ]);
           }

           $user->identities()->create([
               'provider_id'   => $providerUser->getId(),
               'provider_name' => $provider,
           ]);
           // affilka code will be here

           return $user;
       }
   }
   // social user registration
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
        $token                = User::where('pusher_token',$number)->first();
        if($token!=null && $token->count()>0)
        {
            return $this->generatePusherToken();
        }

            return $number;

    }
    // registration bonus
    function registration_bonus($user,$data){

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
    function Password_create(){
        return view('frontend.auth.social_register');
    }
   function Password_store(Request $request){
       $this->validate($request,[
           'password' =>'required|min:8'
       ]);
       $user=User::find(Session::get('get_id'));
       $user->password=Hash::make($request->password);
       $user->save();
       Auth::login($user, true);
       return redirect('user/dashboard');
//       if (@$user->phone_verification == 0) {
//        return view('frontend.auth.phone_verification');
//      }

   }

   protected function guard()
    {

        return Auth::guard();
    }

    function showLogin(){
        return redirect('user-login');
    }

    function Mail_Check($email){
//        $validator = Validator::make($email, [
//            'email' => 'required|email|unique:users'
//        ]);
//        if ($validator->fails()) {
//           return response()->json("invalid");
//        }
          $data = User::where('email',$email)->count();
          if ($data > 0) {
              return response()->json('This email is already used!',400);
            }else {
                return response()->json('success',200);
          }
    }
    function username_Check($username){
          $data = User::where('user_name',$username)->count();
          if ($data > 0) {
              return response()->json('This username is already taken',400);
            }else {
                return response()->json('success',200);
          }
    }

    function Bonus($user,$data){
        $bonus=new \App\Bonus;
        $bonus->user_id = $user->id;
        $bonus->add_bonus_id = $data->id;
        $bonus->amount= $data->bonus_amount;
        $bonus->spin = $data->free_spin;
        $bonus->betsize = $data->bet_size;
        $bonus->line = $data->lines;
        $bonus->type = $data->type;
        $bonus->from='casino';
        $bonus->to=$user->user_name;
        $bonus->save();
       // logCreatedActivity($data,$bonus->type,$bonus);
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

        /*$account=Account::find($user->account->id);
        $account->total= $data->bonus_amount;
        $account->total_spin= $data->free_spin;
        $account->save();*/

        $wal = ProsixWalletType::where('type',$bonus->type)->first();
        if (is_null($wal)) {
            $wallet_type= new ProsixWalletType();
        } else {
            $wallet_type = $wal;
        }
        $wallet_type->type=$bonus->type;
        $wallet_type->save();
        $wallet =new ProsixWallet();
        $wallet->user_id = Auth::user()->id;
        $wallet->amount = $data->bonus_amount;
        $wallet->type_id =  $wallet_type->id;
        $wallet->created_by=Auth::id();
        $wallet->save();

        $account=ProsixUserWallet::updateOrCreate(['user_id'=>$user->id]);
        $account->free_token= $account->free_token + floatval(@$data->bonus_amount);
        $account->free_spin= $account->free_spin + floatval(@$data->free_spin);
        $account->type_id= $wallet_type->id;
        $account->save();

        $user_id  = Auth::id();
        $logModel = $bonus;
        $request = $bonus;
        $log =  $bonus->type;
        logCreatedActivity($user_id,$logModel,$request,$log);
    }
    // Auth override functions
    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function validateLogin(Request $request)
    {
        if ($request->getHttpHost()=="propersix.casino") {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string'
            ]);
        }
        else
        {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }
}
