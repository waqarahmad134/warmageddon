<?php

namespace App\Http\Controllers\Backend\customer;
use App\LeaveNote;
use App\ListAffiliate;
use App\TokenCurrency;
use App\Withdraw;
use DB;
use Auth;
use App\User;
use App\BuyToken;
use App\Deposit;
use Carbon\Carbon;
use App\LoggedinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    function OnlinecustomerInfo(){
        try {
            //$data = LoggedinUser::latest()->get();
            $time =  time() - (config('session.lifetime')*60);
            //dd(date("H",$time));
            $data = LoggedinUser::where('updated_at','>=', $time)->distinct('user_id')->get();
            $tok  = TokenCurrency::where('doller',1)->where('status',1)->first();
            return view('backend.customer.online_customer',compact('data','tok'));

        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    function Online_customer_view($id){

        try {
            $user             = User::find($id);
            $aff_users        = ListAffiliate::where('aff_id',$id)->with('user')->get();
            $last_payment     =\App\Deposit::where('user_id',$user->id)->orderBy('id','desc')->first();
            $first_payment    =\App\Deposit::where('user_id',$user->id)->orderBy('id','asc')->first();
            // view variables
            $_total                          = isset($user->payment) ? $user->payment->count() : 0;
            $tok                             = TokenCurrency::where('doller',1)->where('status',1)->first();
            $userWallet                      = \App\ProsixUserWallet::where('user_id',$user->id)->first();
            $userDeposites                   = Deposit::where('user_id', $user->id)->sum('amount');
            $totalUserDepCount               = Deposit::where('user_id', $user->id)->count();
            $userWithdraws                   = Withdraw::where('status','1')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsRejectedAmount     = Withdraw::where('status','2')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsRejectedCount      = Withdraw::where('status','2')->where('user_id', $user->id)->count();
            $userWithdrawsCanceledAmount     = Withdraw::where('status','3')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsCanceledCount      = Withdraw::where('status','3')->where('user_id', $user->id)->count();
            $totalUserWithdrawsCount         = Withdraw::where('user_id', $user->id)->count();
            $userWithdrawsPending            = Withdraw::where('user_id', $user->id)->where('status', 0 )->sum('amount');
            $userWithdrawsLast               = Withdraw::where('user_id', $user->id)->where('status', 1 )->orderBy('id','desc')->first();
            $userWithdrawslist1              = Withdraw::where('user_id', $user->id)->orderBy('created_at','desc')->get();
            $userdepositslist                = Deposit::where('user_id', $user->id)->orderBy('created_at','desc')->get();
            $lastWithAmount                  = 0;
            $t                               = DB::table('favorite_games')->where('user_id',$user->id)->select('game_id')
                ->selectRaw('COUNT(*) AS count')
                ->groupBy('game_id')
                ->orderByDesc('count')
                ->limit(4)
                ->get();
            $t1                               = DB::table('game_session_childs')
                ->select('game_id', DB::raw('SUM(bet_size*payline) as betsize'))
                ->where('user_id',$user->id)
                ->groupBy('game_id')
                ->get();
            if($userWithdrawsLast){
                $lastWithAmount              = $userWithdrawsLast->amount;
            }
            $loyalty_amount                  = $userWallet->earn_loyalty + $userWallet->used_loyalty;
            $loyalty_badge                  = DB::table('loyalities')->where('from_range','<=',$loyalty_amount)->where('to_range','>=',$loyalty_amount)->orderBy('id','desc')->first();

            if (@$user) {
                $last_payment=\App\Deposit::where('user_id',$user->id)->orderBy('id','desc')->first();
                $first_payment=\App\Deposit::where('user_id',$user->id)->orderBy('id','asc')->first();
                return view('backend.customer.customer_view',compact('user','aff_users','last_payment','first_payment','tok','userWallet','userDeposites','totalUserDepCount','userWithdraws','userWithdrawsRejectedAmount','userWithdrawsRejectedCount','userWithdrawsCanceledAmount','userWithdrawsCanceledCount','totalUserWithdrawsCount','userWithdrawsPending','userWithdrawsLast','lastWithAmount','loyalty_badge','userWithdrawslist1','userdepositslist','t','t1'));
            }else {

                return redirect()->back();
            }

        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    function Online_customer_logout($id){
        try {
            $userToLogout = User::find($id);
            if(isset($userToLogout->logged_id)){
                $log = $userToLogout->logged_id->s_id;
                \Session::getHandler()->destroy($log);
                $userToLogout->logged_id->delete();
            }
            Toastr::success('User logged out successfully');
            return redirect()->back();

        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    function customerInfo(){
        try {
            $user  =  User::role('User')->with('withdraw')->get();
            $tok   =   TokenCurrency::where('doller',1)->where('status',1)->first();
            return view('backend.customer.customer_info',compact('user','tok'));

        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }

    function customerView($id){
        try {
            $user             = User::find($id);
            $aff_users        = ListAffiliate::where('aff_id',$id)->with('user')->get();
            $last_payment     =\App\Deposit::where('user_id',$user->id)->orderBy('id','desc')->first();
            $first_payment    =\App\Deposit::where('user_id',$user->id)->orderBy('id','asc')->first();
            // view variables
            $_total                          = isset($user->payment) ? $user->payment->count() : 0;
            $tok                             = TokenCurrency::where('doller',1)->where('status',1)->first();
            $userWallet                      = \App\ProsixUserWallet::where('user_id',$user->id)->first();
            $userDeposites                   = Deposit::where('user_id', $user->id)->sum('amount');
            $totalUserDepCount               = Deposit::where('user_id', $user->id)->count();
            $userWithdraws                   = Withdraw::where('status','1')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsRejectedAmount     = Withdraw::where('status','2')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsRejectedCount      = Withdraw::where('status','2')->where('user_id', $user->id)->count();
            $userWithdrawsCanceledAmount     = Withdraw::where('status','3')->where('user_id', $user->id)->sum('amount');
            $userWithdrawsCanceledCount      = Withdraw::where('status','3')->where('user_id', $user->id)->count();
            $totalUserWithdrawsCount         = Withdraw::where('user_id', $user->id)->count();
            $userWithdrawsPending            = Withdraw::where('user_id', $user->id)->where('status', 0 )->sum('amount');
            $userWithdrawsLast               = Withdraw::where('user_id', $user->id)->where('status', 1 )->orderBy('id','desc')->first();
            $userWithdrawslist1              = Withdraw::where('user_id', $user->id)->orderBy('created_at','desc')->get();
//            $userdepositslist             = Deposit::where('user_id', $user->id)->orderBy('created_at','desc')->get();
            $userdepositslist                = \Illuminate\Support\Facades\DB::table('deposits')
              ->leftJoin('coin_payment', 'coin_payment.orderID', '=', 'deposits.charge_id')
              ->leftJoin('axcess_payment', 'axcess_payment.orderID', '=', 'deposits.charge_id')
              ->leftJoin('users', 'users.id', '=', 'deposits.user_id')
              ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'deposits.user_id')
              ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
              ->select('deposits.id as depositsid','deposits.created_at as deposit_created','users.*','deposits.*','user_profiles.*','coin_payment.*','axcess_payment.currency as axcess_currency')
              ->orderBy('deposit_created','desc')
              ->where('deposits.user_id',$user->id)
                ->get();
            $lastWithAmount                  = 0;
            $t                               = DB::table('favorite_games')->where('user_id',$user->id)->select('game_id')
                                                    ->selectRaw('COUNT(*) AS count')
                                                    ->groupBy('game_id')
                                                    ->orderByDesc('count')
                                                    ->limit(4)
                                                    ->get();
            $t1                               = DB::table('game_session_childs')
                                                    ->select('game_id', DB::raw('SUM(bet_size*payline) as betsize'))
                                                    ->where('user_id',$user->id)
                                                    ->groupBy('game_id')
                                                    ->get();
            if($userWithdrawsLast){
                $lastWithAmount              = $userWithdrawsLast->amount;
            }
            $loyalty_amount                  = $userWallet->earn_loyalty + $userWallet->used_loyalty;
            $loyalty_badge                  = DB::table('loyalities')->where('from_range','<=',$loyalty_amount)->where('to_range','>=',$loyalty_amount)->orderBy('id','desc')->first();
            return view('backend.customer.customer_view',compact('user','aff_users','last_payment','first_payment','tok','userWallet','userDeposites','totalUserDepCount','userWithdraws','userWithdrawsRejectedAmount','userWithdrawsRejectedCount','userWithdrawsCanceledAmount','userWithdrawsCanceledCount','totalUserWithdrawsCount','userWithdrawsPending','userWithdrawsLast','lastWithAmount','loyalty_badge','userWithdrawslist1','userdepositslist','t','t1'));

        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }

    function customer(){
        try {
            return view('backend.customer.search_customer');
        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    function customerSearch(Request $r){
        try {
            $user = User::where(['status'=>1,'access_status'=>1])->where('user_name', 'like', '%'.$r->data.'%')->orWhere('email', 'like', '%'.$r->data.'%')->role('User')->get();
            return view('backend.customer.search_customer',compact('user'));
        }  catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }
    }
    function UsaerLeaveMessageindex(Request $request,$id){
        $commentsList = LeaveNote::where('user_id' , $id)->orderBy('created_at','desc')->get();
        $user = User::find($id);
        return view('backend.customer.customer-comments', compact('commentsList' , 'user'));
    }
    function UsaerLeaveMessage(Request $request,$id){
        $request->validate([
            'body' => 'required|',
        ]);
        DB::beginTransaction();
        try {
            $data = new LeaveNote();
            $data->user_id = $id;
            $data->body = $request->body;
            $data->save();

            DB::commit();
            Toastr::success('Message Sent Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
}
