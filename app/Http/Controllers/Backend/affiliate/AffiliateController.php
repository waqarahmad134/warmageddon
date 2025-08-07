<?php

namespace App\Http\Controllers\backend\Affiliate;

use App\AffiliateMedia;
use App\AffiliateUser;
use App\Deposit;
use Mail;
use Response;
use App\Notifications\UserAdmin;
use App\ProsixTransaction;
use App\ProsixUserWallet;
use App\TokenCurrency;
use App\TransactionType;
use App\User;
use App\UserDocuments;
use App\UserProfile;
use App\Withdraw;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Twilio\TwiML\Messaging\Media;
use Validator;

class AffiliateController extends Controller
{
    public function index()
    {
        $users                = User::where('pro_child','!=',null)
                                    ->where('pro_child',Auth::user()->pro_parent)
                                    ->get();
        return view('backend.affiliate.dashboard',compact('users'));
    }
    public function affiliate_requests()
    {
        $users                  = AffiliateUser::all();
        return view('backend.affiliate.requests',compact('users'));
    }
    public function affiliate_users()
    {
        $users                = User::where('pro_child','!=',null)
            ->where('pro_child',Auth::user()->pro_parent)
            ->get();
        return view('backend.affiliate.lists',compact('users'));
    }
    public function show_affiliate($id)
    {
        $aff_request = AffiliateUser::find($id);
        return view('backend.affiliate.show', compact('aff_request'));
    }
    public function showLoginForm()
    {
        $type = '0'; // 1 for admin 0 for affiliate
        return view('auth.adminlogin',compact('type'));
    }
    public function store_affiliate(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'country' => ['required'],
            'zipcode' => ['required'],
            'phoneField1' => ['required','min:8'],
            'state' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:user_profiles'],
            'last_name' => ['required', 'string', 'max:255'],
            'dob' => ['required','before:-18 years'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'],
        ]);
        $user                =   AffiliateUser::where('email',$request->email)->first();
        if ($user!=null)
        {
            if ($user->status==2)
            {
                $user->status=3;
                $user->save();
            }
            else if ($user->status==1)
            {
                Toastr::error("Your request has been approved already");
                return redirect()->back()->with('error_msg','Your request has been approved already');
            }
            else if ($user->status==0 || $user->status==3 )
            {
                Toastr::error("You have already submitted request");

                return redirect()->back()->with('error_msg','Your request has been already submitted');
            }
        }
        else{
            $user                 =    new AffiliateUser();
            $user->first_name     =   strip_tags($request->first_name);
            $user->last_name      =  strip_tags($request->last_name);
            $user->user_name      =   strip_tags($request->username);
            $user->email          = strip_tags($request->email);
            $user->dob            =  date('Y-m-d', strtotime(strip_tags($request->dob)));
            $user->country        = strip_tags($request->country);
            $user->city           = strip_tags($request->state);
            $user->address        = strip_tags($request->address);
            $user->country_code   = strip_tags($request->phoneField1_phoneCode);
//        $user->country_code=+92;
            $user->phone          = Ltrim($request->phoneField1,0);
            $user->password       = strip_tags($request->password);
            $user->ip_address=     \Request::ip();
            $user->status          = 0;
            $user->pro_child       = strip_tags($request->pro_child);
            $user->save();
        }

        Mail::send('mail.affiliate_registeration', [
            'username'      => $user->user_name,
        ], function($message) use($user){
            $message->subject('ProperSix Affiliate Registration');
            $message->to($user->email);
        });
        return redirect()->back()->with('aff_msg','We have received your details. Thanks!');
    }
    public function affcode_check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pro_parent' => 'unique:users',
        ]);
        if ($validator->fails())
        {
            return response()->json("not ok");
        }
        else{
            return response()->json("ok");
        }
    }
    public function approve_affiliate(Request $request)
    {
        $input                         = $request->all();
        $aff                           = AffiliateUser::whereId($input['requestID'])->first();
        $user                          = User::where('email',$aff->email)->first();
        if ($request->page=="show") {
            $request->validate([
                'pro_parent' => 'unique:users'
            ]);
        }
        if (isset($user))
        {
            $user->status   = 1 ;
            $user->save();
        }
        else{
            $user                          = new User();
            $user->first_name              = $aff->first_name;
            $user->last_name               = $aff->last_name;
            $user->user_name               = $aff->user_name;
            $user->email                   = $aff->email;
            $user->country                 = $aff->country;
            $user->city                    = $aff->city;
            $user->dob                     = $aff->dob;
            $user->address                 = $aff->address;
            $user->phone                   = $aff->phone;
            $user->password                = Hash::make($aff->password);
            $user->verified                = 1;
            $user->pro_parent              = $request->pro_parent;
            $user->pro_payout_percentage   = $request->affiliate_percentage;
            $user->save();
            // pro_wallet of affiliate
            $pro_wallet                = new ProsixUserWallet();
            $pro_wallet->user_id       = $user->id;
            $pro_wallet->save();
            // user profile
            $user_profile                   = new UserProfile();
            $user_profile->username         = $user->user_name;
            $user_profile->first_name       = $user->first_name;
            $user_profile->last_name        = $user->last_name;
            $user_profile->username         = $user->user_name;
            $user_profile->user_id          = $user->id;
            $user_profile->address          = $aff->address;
            $user_profile->date_of_birth    = $aff->dob;
            $user_profile->country           = $aff->country;
            $user_profile->state            = DB::table('states')->where('name',$aff->city)->first()->id;
            $user_profile->phone_number     = $aff->phone;
//            $user_profile->secret_answer    = 'aff->secret_answer';
            $user_profile->status           = 1;
            $user_profile->save();


        }
        if ($request->page=="show")
        {
            $aff->status                    = 1;
            $aff->save();
            $role_r = Role::where('name', '=', 'Affiliate')->firstOrFail();
            $user->assignRole($role_r);
            Mail::send('mail.affiliate_activation', [
                'username'      => $user->user_name,
                'email'         => $aff->email,
                'password'      => $aff->password,
            ], function($message) use($user){
                $message->subject('ProperSix Affiliate Activation');
                $message->to($user->email);
            });
            Toastr::success('Affiliate user ( '.$aff->user_name.' ) Activated successfully','Success');
        }
        else{

            Toastr::success('User ( '.$user->user_name.' ) Enabled successfully','Success');
        }

        return redirect()->back();
    }
    public function reject_affiliate(Request $request)
    {
        $aff           = AffiliateUser::whereId($request->requestID)->first();
        $user          = User::where('email',$aff->email)->first();
        if (isset($user))
        {
            $user->status   = 0 ;
            $user->save();
        }
        if ($request->page=="show")
        {
            $aff->status   = 2;
            $aff->comments = $request->comments;
            $aff->save();
            Mail::send('mail.affiliate_rejection', [
                'username'      => $aff->user_name,
                'comments'      => $aff->comments
            ], function($message) use($aff){
                $message->subject('ProperSix Affiliate Status');
                $message->to($aff->email);
            });
            Toastr::success('Affiliate user ( '.$aff->user_name.' ) request rejected','Success');
        }
        else{
            Toastr::success('User ( '.$user->user_name.' ) disabled successfully','Success');
        }


        return redirect()->back();
    }
    public function withdraws()
    {
        $notifications = DB::table('notifications')->where('user_id', @Auth::user()->id)->where('status',0)->get();
        $withData = DB::table('withdraws')->where('user_id' , @Auth::user()->id )->orderBy('created_at', 'DESC')->get();
        return view('backend.affiliate.withdrawList',compact('withData','notifications'));
    }
    public function withdraw(Request $r)
    {
        DB::beginTransaction();
//        if ($r->swift) {
            $r->validate([
//                'payment_mathod_type' => 'required',
                'w_bank_name' => 'required',
                'ibpn'   => 'required',
                'swift' => 'required',
                'amount' => 'required|integer|min:1',
            ]);
//        }
//        else {
//            $r->validate([
//                'first_name' => 'required',
//                'last_name' => 'required',
//                'w_country' => 'required',
//                'w_state' => 'required',
//                'zipcode' => 'required',
//                'Address' => 'required',
//                'w_currency' => 'required',
//                'payment_mathod_type' => 'required',
//                'w_bank_name' => 'required',
//                'w_account_number' => 'required',
//                'ibpn' => 'required',
//                'amount' => 'required|integer|min:1',
//            ]);
//        }
        try {
                /*$gameSessionChild = \App\GameSessionChild::where('user_id', Auth::user()->id)->latest('created_at')->first();
                if ($gameSessionChild) {
                    $sessionTime = strtotime($gameSessionChild->created_at);
                    $curTime = time();
                    if (($curTime - $sessionTime) <= (60 * 5)) {
                        Toastr::warning('You can not withdraw while playing a game. To withdraw, close the game and wait 5 minutes.');
                        return redirect()->back();
                    }
                }
                $doc = UserDocuments::where('user_id', Auth::user()->id)->where('status', 2)->first();*/

                /*if ($doc) {*/
                    $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
                    if ($userWallet->token < $r->amount) {
                        Toastr::warning('Can’t withdraw due to insufficient funds.');
                        return redirect()->back();
                    }
                    $data = new Withdraw();
                    $data->user_id = Auth::user()->id;
                    $data->first_name = $r->first_name;
                    $data->last_name = $r->last_name;
                    $data->w_country = $r->w_country;
                    $data->w_state = $r->w_state;
                    $data->zipcode = $r->zipcode;
                    $data->Address = $r->Address;
                    $data->w_currency = $r->w_currency;
                    $data->amount = $r->amount;
                    $data->payment_mathod_type = $r->payment_mathod_type;
                    $data->w_bank_name = $r->w_bank_name;
                    $data->w_account_number = $r->w_account_number;

                    if ($r->swift) {
                        $data->SWIFT = $r->swift;
                    }
                    if ($r->ibpn) {
                        $data->IBAN = $r->ibpn;
                    }
                    $data->save();

                    $tran_Type = new TransactionType();
                    $tran_Type->type = 'withdraw';
                    $tran_Type->created_by = Auth::id();
                    $tran_Type->save();

                    $transaction = new ProsixTransaction();
                    $transaction->user_id = Auth::user()->id;
                    $transaction->amount = $r->amount;
                    $transaction->currency = 'pley6_token';
                    $transaction->from = 'casino';
                    $transaction->type = $tran_Type->id;
                    $transaction->to = Auth::user()->user_name;
                    $transaction->created_by = Auth::id();
                    $transaction->save();

                    $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();

                    $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => Auth::id()]);
                    $userWallet->token = $userWallet->token - $r->amount;
                    $userWallet->type_id = 8;
                    $userWallet->save();
                    //updating dollars here
                    $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => Auth::id()]);
                    $userWallet->usd = $userWallet->usd - ($r->amount / $tok->pley6_token);
                    $userWallet->type_id = 8;
                    $userWallet->save();
                    //updating dollar finishes
                    $user_id = Auth::id();
                    $logModel = $data;
                    $request = $data;
                    $log = $tran_Type->type;
                    logCreatedActivity($user_id, $logModel, $request, $log);
                    DB::commit();
                    Toastr::success('Withdraw request successfully submitted.', 'Success');
                    return redirect()->back();


                /*} else {

                    Toastr::warning('Your document is not verified yet.');
                    return redirect()->back();
                }*/

        } catch (\Exception $e) {

            Toastr::error($e->getMessage(),'Error');
            return redirect()->back();
        }
    }
    function cancel_withdraw(Request $r,$id){

        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $userWallet = \App\ProsixUserWallet::where('user_id' , Auth::user()->id )->first();
        $userWithdraw = \App\Withdraw::find($id);
        if ($userWithdraw->status=='0')
        {
            $usd = $userWithdraw->amount / $tok->pley6_token;
            $userWallet->usd = $userWallet->usd + $usd;
            $userWallet->token = $userWallet->token +$userWithdraw->amount;
            $userWallet->save();

            $userWithdraw->status = 3;
            $userWithdraw->save();

            // notification
            $notification=new \App\Notification;
            $notification->user_id=Auth::id();
            $notification->message=getTranslated('withdraw_cancel').' '. $userWithdraw->amount.' token and '.$usd.' USD'. ' reverted to your Wallet.';
            $notification->save();


            Toastr::success( $notification->message ,'Success');
        }
        else{
            $notification=new \App\Notification;
            $notification->user_id=Auth::id();
            $notification->message='Withdrawal request cancelation failed. Please try again later.';
            $notification->save();


            Toastr::warning( $notification->message ,'warning');
        }
        return redirect()->back();

    }
    public function media()
    {
        $media                        = DB::table('affiliate_media')->get();
        return view('backend.affiliate.media',compact('media'));
    }
    public function show_media()
    {
        $media                        = DB::table('affiliate_media')->where('status',1)->get();
        return view('backend.affiliate.show_media',compact('media'));
    }
    public function view_media($id)
    {
        $media                        = AffiliateMedia::where('id',$id)->with('getMediaFiles')->first();
        return view('backend.affiliate.view_media',compact('media'));
    }
    public function save_media(Request $request)
    {
        $input                      = $request->all();
        if ($input['type']=="text")
        {
            DB::table('affiliate_media_files')->insert([
            'parent_media' => $input['parent_media'],
            'name'    => $input['name'],
            'type'    => $input['type'],
            'source'  => $input['promotional_text']
        ]);
        }
        else{
            if($request->file('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $name = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.'. $file->getClientOriginalName();
                    $destinationPath = base_path('/backend/affiliate/media/');
                    $destination = $file->move($destinationPath, $name);
                    DB::table('affiliate_media_files')->insert([
                        'parent_media' => $input['parent_media'],
                        'name'    => $input['name'],
                        'type'    => $input['type'],
                        'source'  => $name
                    ]);
                }

            }
        }
        Toastr::success('Files uploaded successfully','Success');
        return redirect()->back();
    }
    public function add_template()
    {
        return view('backend.affiliate.addTemplate');
    }
    public function save_template(Request $request)
    {
        $input                    = $request->all();
        DB::table('affiliate_media')->insert([
            'name'    => $input['name'],
            'type'    => $input['template_type'],
            'status'  => '1'
        ]);
        $last_entry               = DB::table('affiliate_media')->orderBy('id','desc')->first();
        if ($input['file_type']=="text")
        {
            DB::table('affiliate_media_files')->insert([
                'parent_media' => $last_entry->id,
                'name'    => $input['name'],
                'type'    => $input['file_type'],
                'source'  => $input['promotional_text']
            ]);
        }
        else
        {
            if($request->file('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {


                    $name = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.'. $file->getClientOriginalName();
                    $destinationPath = base_path('/backend/affiliate/media/');
                    $destination = $file->move($destinationPath, $name);
                    DB::table('affiliate_media_files')->insert([
                        'parent_media' => $last_entry->id,
                        'name'    => $input['name'],
                        'type'    => $input['file_type'],
                        'source'  => $name
                    ]);
                }

            }
        }
        Toastr::success('Affiliate Media Template added successfully','Success!');
        return redirect('dash-panel/affiliate-media');
    }
    public function delete_media($id)
    {
        $files                      = DB::table('affiliate_media_files')->where('parent_media',$id);
        $files->delete();
        $media                      = DB::table('affiliate_media')->where('id',$id);
        $media->delete();
        Toastr::success('Media files deleted successfully','Success!');
        return redirect()->back();
    }
    public function delete_media_icon($id)
    {
        $files                      = DB::table('affiliate_media_files')->where('id',$id);
        $files->delete();
        Toastr::success('Media file deleted successfully');
        return redirect()->back();
    }
    public function edit_media_icon($id)
    {
        $media                      = DB::table('affiliate_media_files')->where('id',$id)->first();
        return view('backend.affiliate.edit_media',compact('media'));
    }
    public function update_media(Request $request)
    {
        $input                      = $request->all();

        if ($input['type']=="text")
        {
            DB::table('affiliate_media_files')->where('id',$input['fileId'])->update([
                'name'    => $input['name'],
                'type'    => $input['type'],
                'source'  => $input['promotional_text']
            ]);
        }
        else
        {
            if($request->has('file')) {
                  $name = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.'. $request->file->getClientOriginalName();
                    $destinationPath = base_path('/backend/affiliate/media/');
                    $destination = $request->file->move($destinationPath, $name);
                    DB::table('affiliate_media_files')->where('id',$input['fileId'])->update([
                        'name'    => $input['name'],
                        'type'    => $input['type'],
                        'source'  => $name
                    ]);


            }
        }
        Toastr::success('Media file updated successfully');
        return redirect()->back();
    }
    public function change_media_status(Request $request)
    {
        $input                          = $request->all();
        DB::table('affiliate_media')->where('id',$input['media_id'])->update([
            'status'   => $input['status']==1?0:1
        ]);
        return redirect()->back();
    }
    public function download_image($id)
    {
        $media                 = DB::table('affiliate_media_files')->where('id',$id)->first();
        $filepath = base_path('/backend/affiliate/media/'.$media->source);
        return Response::download($filepath);
    }
}
