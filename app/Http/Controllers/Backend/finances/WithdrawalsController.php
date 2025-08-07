<?php

namespace App\Http\Controllers\Backend\finances;
use App\Withdraw;
use App\Transaction;
use App\Account;
use App\ProsixUserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class WithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $withdrawal = Withdraw::latest()->with('user')->get();
        $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
        return view('backend.finances.withdrawals.index',compact('withdrawal','tok'));
    }
    public function Approve($id){
        DB::beginTransaction();
        try {
            $data = Withdraw::find($id);
            if ($data->status!='0')
            {
                Toastr::warning('Only pending status can be approved','Warning');
                return redirect()->back();
            }
            $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            $usd = $data->amount / $tok->pley6_token;
            $data->status = 1;
            $data->usd = $usd;
            $data->save();
            $notification=new \App\Notification;
            $notification->user_id=$data->user->id;
            $notification->message='Your withdraw  transaction for '.$data->usd.' approved!';
            $notification->save();
            $transaction =new Transaction();
            $transaction->user_id = @$data->user->id;
            $transaction->transaction_id = $data->id;
            $transaction->amount = @$data->amount;
            $transaction->from = 'casino';
            $transaction->type = 'withdraw';
            $transaction->usd = $usd;
            $transaction->to =@$data->user->user_name ;
            $transaction->currency = @$data->w_currency;
            $transaction->save();

            DB::commit();
            Toastr::success('User withdrawal for $' .$usd.' and '.$data->amount. 'tokens approved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again.','Error');
            return redirect()->back();
        }
    }
    public function Reject($id){
        try {
            $data = Withdraw::find($id);
            if ($data->status!='0')
            {
                Toastr::warning('Only pending requests can be rejected','Warning');
                return redirect()->back();
            }
            $data->status = 2;
            $data->save();
            $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            $user_id = $data->user->id;
            $ProsixUserWallet = ProsixUserWallet::where('user_id' , $user_id)->first();
            $usd = $data->amount / $tok->pley6_token;
            $ProsixUserWallet->usd = $ProsixUserWallet->usd + $usd;
            $ProsixUserWallet->token = $ProsixUserWallet->token+$data->amount;
            $ProsixUserWallet->save();
            $notification=new \App\Notification;
            $notification->user_id=$data->user->id;
            $notification->message='Your withdraw request for $'.$usd.' and '.$data->amount. 'tokens is rejected by Admin please try again';
            $notification->save();
            Toastr::success('User withdrawal request rejected successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function affiliate_withdraws(){

        $withdrawal = Withdraw::latest()->where('user_id','!=',null)->with('user')->get();
        $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
        return view('backend.finances.withdrawals.affiliate',compact('withdrawal','tok'));
    }
    public function View($id){
        try {
            $withdrawal = Withdraw::find($id);
            $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
            $child_sessions = DB::table('game_session_childs')
                ->join('add_games', 'game_session_childs.game_id', '=', 'add_games.id')
                ->select('*','game_session_childs.session_child_id as child_session_id','game_session_childs.status as child_session_status')
                ->where('user_id',$withdrawal->user_id)
                ->orderBy('child_session_id', 'DESC')
                ->get();
            return view('backend.finances.withdrawals.show',compact('withdrawal','tok','child_sessions'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function aff_View($id){
        try {
            $withdrawal = Withdraw::find($id);
            $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
            $child_sessions = DB::table('game_session_childs')
                ->join('add_games', 'game_session_childs.game_id', '=', 'add_games.id')
                ->select('*','game_session_childs.session_child_id as child_session_id','game_session_childs.status as child_session_status')
                ->where('user_id',$withdrawal->user_id)
                ->orderBy('child_session_id', 'DESC')
                ->get();
            return view('backend.finances.withdrawals.affiliate_show',compact('withdrawal','tok','child_sessions'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
}
