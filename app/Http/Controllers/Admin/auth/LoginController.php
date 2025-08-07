<?php

namespace App\Http\Controllers\admin\auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use App\Bonus;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Auth;
use Session;
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

public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
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
    function authenticated(Request $request, $user)
    {
        $backend  = DB::table('backend')->latest()->first();
        if (Auth::user()->hasRole(['User'])) {
            auth()->logout();
            Toastr::Error('You are not an user! ','Error');
            return back();
        }
        if ($backend!=null && $backend->status==0)
        {
            auth()->logout();
            return view('backend.blocked');
        }
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning','You need to verify your account. We have sent you an activation code, please check your email.');
        }
        if ($user->hasRole('Affiliate'))
        {
            if (Auth::user()->status != 1) {
                auth()->logout();
                Toastr::Error('You are blocked! If you have any questions, contact us.','Error');
                return back();
            }
            if ($request->type==1)
            {
                auth()->logout();
                return redirect('affiliate/login');
            }
            else
            return redirect('/affiliate/dashboard');
        }
        $agent = new Agent();
        $user->last_login_at = Carbon::now();
        $user->last_login_ip = $request->getClientIp();
        $loggedIn=\App\LoggedinUser::firstOrCreate(['user_id' => Auth::user()->id]);
        $loggedIn->user_id= Auth::user()->id;
        $loggedIn->s_id = Session::getId();
        $loggedIn->save();
        $user->ip_address == ''?$user->ip_address=\Request::ip():'';
        $user->save();
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
        ?: redirect()->route('dashboard');

    }
    public function showLoginForm()
    {
        $type = '1'; // 1 for admin 0 for affiliate
        return view('auth.adminlogin',compact('type'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dash-panel';

    /**
     * Create a new controller instance.
     *
     *r     * @return void
     */

    public function logout(Request $request)
    {
        if(\Auth::user()->logged_id){
            \Auth::user()->logged_id->delete();
        }
        if (Auth::user()->hasRole('Affiliate'))
        {
            $this->guard()->logout();
            return redirect('/affiliate/login');
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }
//    protected function guard(){
//        return \Auth::guard('admin');
//    }
     }
