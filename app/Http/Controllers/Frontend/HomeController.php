<?php

namespace App\Http\Controllers\Frontend;
use App\AffiliateApiSession;
use App\AffilkaVistorHistory;
use App\ContactUS;
use App\GamesCategory;
use App\GameSessionChild;
use App\HelpCategory;
use App\VerifyUser;
use App\VisitorHistory;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Session;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\AddGame;
use App\Http\Controllers\Controller;
use Newsletter;

/**
 * Class HomeController.
 */
class HomeController extends Controller {

    /*public function __construct(Request $request)
    {
        $this->middleware('checkUser');
        $ip             = $request->ip();
        $url            = "https://api.ipstack.com/".$ip."?access_key=d7885935fa278cb5c8d9d28ccb975f97";
        $json           = \GuzzleHttp\json_decode(file_get_contents($url));
        $history        = new VisitorHistory();
        $history->ip              = $json->ip;
        $history->country_code    = $json->country_code;
        $history->country_name    = $json->country_name;
        $history->region_code     = $json->region_code;
        $history->region_name     = $json->region_name;
        $history->city            = $json->city;
        $history->latitude        = $json->latitude;
        $history->longitude       = $json->longitude;
//         $history->connection      = $json->connection;
        $history->status          = 1;
        $history->save();
    }*/

    /**
     * @return \Illuminate\View\View
     */
    public function affliate($id){
        $data=\App\User::findOrFail($id);
        $aff_id=$data->id;
        Session::put('aff_id',$aff_id);
        return redirect()->route('index');
    }

    
    public function comingSoon(Request $request){
        return view('frontend.home.comingsoon');
    }


    public function index(Request $request) {
        if ($request->query('stag'))
        {
//            $partner_id = strtok($request->query('stag'), '_');
//            dd($request->query('stag'));
            $affiliate_session                = new AffiliateApiSession();
            $affiliate_session->add($request->query('stag'));
            $request->session()->put('affiliate_session',$affiliate_session);
            // maintain visitor history
            $affilka_visitor                 = new AffilkaVistorHistory();
            $affilka_visitor->stag           = $request->query('stag');
            $affilka_visitor->save();
        }
        $all=AddGame::orderBy('order','desc')->get();
//        $winners                      = GameSessionChild::where('spin_type','paid')
//            ->where('status','won')
//            ->whereRaw('(select max(created_at) from game_session_childs)')
//            ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (amount_won))')
//            ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (user_id))')
//            ->groupBy('user_id')
//            ->with('useracc')
//            ->orderBy('amount_won','desc')
//            ->limit(5)
//            ->get();
        $query = "SELECT
	game_session_childs.user_id,
	MAX( game_session_childs.amount_won ) AS amount,
	game_session_childs.created_at,
	users.user_name
FROM
	game_session_childs
	INNER JOIN users ON game_session_childs.user_id = users.id
WHERE
	Date( game_session_childs.created_at )= CURDATE() AND game_session_childs.spin_type='paid' AND game_session_childs.`status`='won'
GROUP BY
	game_session_childs.user_id
ORDER BY
	amount DESC
	LIMIT 5
";
        // views variables
        $data                  = DB::table('cms')->find(1);
        $games_category        = GamesCategory::where('status',0)->with('getGames')->get();
        $winners               = DB::select(DB::raw($query));
        if (Auth::user()) {
            $route=route('affliate_registration',Auth::user()->id);
            $share= \Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            //$data = 'home';
            return view('frontend.home.index', compact('data','user','share','all','winners','games_category'));
        }else {
            //$data = 'home';
            return view('frontend.home.index', compact('data','all','winners','games_category'));
        }


    }
    public function visit($affiliate_id,$type,$source,Request $request)
    {
        try {
            $ip = $request->ip();
            $url = "https://api.ipstack.com/" . $ip . "?access_key=d7885935fa278cb5c8d9d28ccb975f97";
            $json = \GuzzleHttp\json_decode(file_get_contents($url));
            // dd($json);
            // return redirect('/');
        }catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    public function help()
    {
        $faqs                        = HelpCategory::where('status',1)->orderBy('order_no','asc')->get();
        return view('frontend.home.help_support',compact('faqs'));
    }
    public function contact() {
        return view('frontend.contact_us.contact_us');
    }
    public function save_contact(Request $request)
    {

        $input                        = $request->all();
        if (Validator::make($input, ['email' =>'required|email:rfc,dns'])->fails()) {
            Toastr::error('Please enter a valid email address.');
            return redirect()->back();
        }
        try {
            $contact = new ContactUS();
            $contact->name = $input['name'];
            $contact->email = $input['email'];
            $contact->subject = $input['subject'];
            $contact->message = $input['message'];
            $contact->type = "contact";
            $contact->status = 1;
            $contact->save();
            Mail::send('mail.contact_us', [
                'username' => $input['name'],
                'name' => $input['name'],
                'email' => $input['email'],
                'subject' => $input['subject'],
                'message_query' => $input['message']
            ], function ($message) use ($input) {
                $message->subject('ProperSix Support');
                $message->to($input['email']);
            });
            Mail::send('mail.contactInfo', [
                'name' => $input['name'],
                'email' => $input['email'],
                'subject' => $input['subject'],
                'message_query' => $input['message']
            ], function ($message) use ($input) {
                $message->subject('ProperSix Contacts');
                $message->to('info@propersix.com');
            });
            Toastr::success('Your message has been submitted. Our support team will contact you as soon as possible.');
            return redirect()->back();
        }catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    public function save_support(Request $request)
    {

        $input                        = $request->all();
        if (Validator::make($input, ['email' =>'required|email:rfc,dns'])->fails()) {
            Toastr::error('Please enter a valid email address.');
            return redirect()->back();
        }
        try {
            $contact = new ContactUS();
            $contact->name = $input['name'];
            $contact->email = $input['email'];
            $contact->subject = $input['subject'];
            $contact->message = $input['message'];
            $contact->type = "support";
            $contact->status = 1;
            $contact->save();
            Mail::send('mail.contact_us', [
                'username' => $input['name'],
                'name' => $input['name'],
                'email' => $input['email'],
                'subject' => $input['subject'],
                'message_query' => $input['message']
            ], function ($message) use ($input) {
                $message->subject('ProperSix Support');
                $message->to($input['email']);
            });
            Mail::send('mail.contactInfo', [
                'name' => $input['name'],
                'email' => $input['email'],
                'subject' => $input['subject'],
                'message_query' => $input['message']
            ], function ($message) use ($input) {
                $message->subject('ProperSix Contacts');
                $message->to('support@propersix.com');
            });
            Toastr::success('Your message has been submitted. Our support team will contact you as soon as possible.');
            return redirect()->back();
        }catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    public function about() {
        if (Auth::check()) {
            $route=route('affliate_registration');
            $share=\Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'about';
            return view('frontend.about_us.about_us', compact('data','user','share'));
        }
        else {
            $data = 'about';
            return view('frontend.about_us.about_us', compact('data'));
        }

    }
    public function games() {

        if (Auth::check()) {
            $user=\App\User::findOrFail(Auth::user()->id);
        }
        $data = 'games';

        return view('frontend.games.games', compact('data','user'));
    }
    public function allgame(){
        if (Auth::check()) {
            $route=route('index');
            $share=\Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'games';
            return view('frontend.games.games', compact('data','user','share'));
        }
        else {
            $data = 'games';
            return view('frontend.games.games', compact('data'));
        }
    }
    public function login_modal() {
        return view('frontend.show.modals.login');
    }
    public function get_city(Request $request)
    {
        $country = $request->id;

        $city = DB::table('states')->where('country_id', $country)->orderBy('name', 'asc')->get();

        foreach ($city as $item)
        {
            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
    }
    function login(){
        if (Session::has('login_message'))
        {
            Toastr::error(Session::get('login_message'));
        }
        return redirect('/#popup-login');
        // if(@Auth::check()){
        //     auth()->logout();
        //     return view('frontend.login.login');
        //     // return redirect('/');
        // }
        // else {

        //     return view('frontend.login.login');
        // }
    }

    function Registration(){
        return redirect('/#popup-signup');
        // try {
        //     Session::forget('ref_key');
        //     $countries = DB::table('countries')->orderBy('name', 'asc')->get();
        //     if(@Auth::check()){
        //         auth()->logout();
        //         return view('frontend.registration.register',compact('countries'));
        //     }
        //     else {
        //         return view('frontend.registration.register',compact('countries'));
        //     }
        // } catch (\Exception $e) {
        //     Toastr::error('Something went wrong please try again!');
        //     return redirect()->back();
        // }
    }
    function signup_ref($ref_key,Request $request)
    {
        try {
            if(@Auth::check()){
                auth()->logout();
            }
            $request->session()->put('ref_key',$ref_key);
            return redirect('referral-registration');

        }catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    public function referral_registration()
    {
        return view('frontend.registration.register');
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
    public function verifyUser($token)
    {
        $verifyUser = \App\VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $check = \App\VerifyUser::where('token', $token)
                    ->whereBetween('updated_at', [now()->subMinutes(20), now()])
                    ->first();
                if (isset($check))
                {
                    $verifyUser->user->verified = 1;
                    $verifyUser->user->phone_verification = 1;
                    $verifyUser->user->save();
                    $status = "Your e-mail is verified. You can now log in.";
                }
                else
                {
                    Toastr::Error('Sorry, this token is expired.','Error');
                    return view('frontend.login.after_reg',[
                        'data'   => '2',
                        'userId' => $verifyUser->user_id
                    ]);
                }


            }else{
                $status = "Your email is verified.  Please login.";
            }
        }else{
            Toastr::Error('Sorry your email can not be identified','Error');
            return redirect('/');
        }
        Toastr::success($status,'success');
        return redirect('user/dashboard')->with($status,'success');
    }
    function resend_email(Request $request)
    {

        try {
            $user = $request->userId;
//            if (@Auth::check()) {
//                dd($user);
//                Toastr::success('Email already verified. ');
//                return redirect()->back();
//            } else {
                $data = DB::table('users')->find($user);
                $email = $data->email;
                $verifyUser = VerifyUser::where('user_id', $user)->first();
                $verifyUser->token = str_random(40);
                $verifyUser->save();
                Mail::send('mail.email_verify', [
                    'username' => $data->user_name,
                    'verify_url' => url('user/verify', $verifyUser->token),
                ], function ($message) use ($email) {
                    $message->subject('ProperSix email verification');
                    $message->to($email);
                });
                return view('frontend.login.after_reg', [
                    'data' => '1',
                    'userId' => $user
                ]);
           // }
        }catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    //functions for cookies and privacy policy start
    public function terms_of_service() {
        $all=AddGame::orderBy('order','desc')->get();
        if (Auth::user()) {
            $route=route('affliate_registration',Auth::user()->id);
            $share= \Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'terms_of_service';
            return view('frontend.home.terms_of_service', compact('data','user','share','all'));
        }else {
            $data = 'terms_of_service';

            return view('frontend.home.terms_of_service', compact('data','all'));
        }
    }
    public function responsible_gambling()
    {
        return view('frontend.home.gambling');
    }
    public function spinwheel(){
        return view('frontend.home.spinwheel');
    }
    public function cookies() {
        $all=AddGame::orderBy('order','desc')->get();
        if (Auth::user()) {
            $route=route('affliate_registration',Auth::user()->id);
            $share= \Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'cookies';
            return view('frontend.home.cookies', compact('data','user','share','all'));
        }else {
            $data = 'cookies';
            return view('frontend.home.cookies', compact('data','all'));
        }
    }
    public function licence()
    {
        return view('frontend.home.licence');
    }
    public function commercial_registration()
    {
        return view('frontend.home.commercial_registration');
    }
    public function support() {
        $all=AddGame::orderBy('order','desc')->get();
        if (Auth::user()) {
            $route=route('affliate_registration',Auth::user()->id);
            $share= \Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'support';
            return view('frontend.home.support', compact('data','user','share','all'));
        }else {
            $data = 'support';

            return view('frontend.home.support', compact('data','all'));
        }
    }
    public function payout()
    {
        return view('frontend.home.payouts');
    }
    public function antimoney()
    {
        return view('frontend.home.antimoney');
    }
    public function playrules()
    {
        return view('frontend.home.playRules');
    }
    public function affiliate()
    {
        return view('frontend.home.affiliate');
    }
    public function affiliate_signup()
    {
        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
        return view('frontend.home.affiliate1',compact('countries'));
    }
    public function privacy_policy() {
        $all=AddGame::orderBy('order','desc')->get();
        if (Auth::user()) {
            $route=route('affliate_registration',Auth::user()->id);
            $share= \Share::load($route ,'Registration at Proper-six')->services();
            $user=\App\User::findOrFail(Auth::user()->id);
            $data = 'privacy_policy';
            return view('frontend.home.privacy_policy', compact('data','user','share','all'));
        }else {
            $data = 'privacy_policy';

            return view('frontend.home.privacy_policy', compact('data','all'));
        }
    }
    //functions for cookies and privacy policy ends

    public function subscribe(Request $r)
    {
        if($r->method()=="GET")
        {
            Toastr::warning("Something Went Wrong");
            return redirect('/');
        }
        $input                           = $r->all();

        if (Validator::make($input, ['email' =>'required|email:rfc,dns'])->fails()) {
            return response()->json([
                'type'   => 'error',
                'message' => 'Please enter a valid email address.'
            ]);
        }
        if (Validator::make($input, ['email' =>'unique:subscription'])->fails()) {
            return response()->json([
                'type'   => 'error',
                'message' => 'You are already subscribed with this email'
            ]);
        }
        else{
            $subscribe          = DB::table('subscription')->insert([
                'email'           => $input['email'],
                'status'          => "active"
            ]);
            return response()->json([
                'type'   => 'success',
                'message' => "You have been successfully subscribed to our newsletter service"
            ]);
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 30,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "PUT",
//                CURLOPT_POSTFIELDS => "{\"list_ids\":[\"d29e345d-4b87-4f1a-b35d-e8fb9dbc89a9\"],\"contacts\":[{\"address_line_1\":\"string (optional)\",\"address_line_2\":\"string (optional)\",\"alternate_emails\":[\"$r->email\"],\"city\":\"string (optional)\",\"country\":\"string (optional)\",\"email\":\"$r->email\",\"first_name\":\" \",\"last_name\":\"string (optional)\",\"postal_code\":\"string (optional)\",\"region\":\"string (optional)\",\"custom_fields\":{}}]}",
//                CURLOPT_HTTPHEADER => array(
//                    "authorization: Bearer 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",
//                    "content-type: application/json"
//                ),
//            ));
//
//            $response = curl_exec($curl);
//            $err = curl_error($curl);
//
//            curl_close($curl);
//
//            if ($err) {
//                return response()->json($err);
//           }
//       else {
//                return response()->json($response);
//            }
//            if ($subscribe)
//            {
//                return  response()->json("Email has been subscribed!");
//            }
        }
    }
    public function getwasmfile($name)
    {
        $foldername=str_replace(' ','-',$name);
        $foldername=basename($foldername,'.wasm');
        $foldername=strtolower($foldername);

        if(str_contains($name, '.wasm')){
            $name = trim(str_replace('.wasm','', $name ));
        }
        //  $foldername;
//        return response()->file('games/'.$foldername.'/Build/'.$name,[
        return response()->file('games/'.$foldername.'/Build/'.$name.'.wasm',[
            'Content-Type'=>'application/wasm',
            'Content-Encoding'=>'gzip'
        ]);
    }
}
