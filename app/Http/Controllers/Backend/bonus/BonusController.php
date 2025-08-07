<?php

namespace App\Http\Controllers\Backend\bonus;

use App\AddGame;
use App\Bonus;
use App\BonusCode;
use App\Deposit;
use App\LeaveNote;
use App\TokenCurrency;
use App\User;
use DB;
use Session;
use App\Notification;
use App\PropersixBonus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    public function index()
    {
        $bonus_code=PropersixBonus::where('status','!=',2)->orderByDesc('created_at')->get();
        return view('backend.bonus.index',compact('bonus_code'));

    }
    public function create()
    {
        $countries               = DB::table('countries')->orderBy('name', 'asc')->get();
        $viplevel                = DB::table('loyalities')->orderBy('name', 'asc')->get();
        $user =  User::role('User')->get();
        $games =  AddGame::where('status','on')->orderBy('order','desc')->get();
        $deposit_bonus = PropersixBonus::where('type','deposit')->latest()->get();
        return view('backend.bonus.add',compact('countries','viplevel','user','games','deposit_bonus'));
    }
    public function destroy($id)
    {
        try{
            $user = PropersixBonus::find($id);
            $user->status = 2;
            $user->save();
            Toastr::success('Bonus deleted successfully','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    // bonus types
    function BonusTypeCheck(Request $request){
        try {
            Session::put('bonus_type',$request->type);
            return  redirect('dash-panel/add-bonus');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    function Registration_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'bonus_amount' => 'required|integer|min:0',
            'free_spin' => 'required|integer',
            'w_2' => 'required|string',
            'recurring' => 'required|string',
            'status' => 'required|string',
        ]);
        //dd($request->all());
        DB::beginTransaction();
      //  try {
            $data = new PropersixBonus();
            $data->type ='registration';
            $data->bonus_name = $request->bonus_name;
            $data->bonus_amount = $request->bonus_amount;
            $data->free_spin = $request->free_spin;
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->bet_size) {
                $data->bet_size = $request->bet_size;
            }
            if (@$request->lines) {
                $data->lines = $request->lines;
            }
            if (@$request->wagering_req) {
                $data->wagering_req = $request->wagering_req;
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            if (@$request->aff_source) {
                $data->aff_source = $request->aff_source;
            }
            $data->recurring = $request->recurring;
            $data->w_2 = $request->w_2;
            $data->status = $request->status;
            $data->save();
            $user_id  = Auth::id();
            $logModel = $data;
            $request = $request->all();
            $log = 'registration_bonus';
            logCreatedActivity($user_id,$logModel,$request,$log);

            DB::commit();
            Toastr::success('Registration bonus added successfully','Success');
            return redirect()->route('list-bonuses');
//        } catch (\Exception $e) {
//            Toastr::error('Something went wrong! please try again','Error');
//            return redirect()->back();
//        }
    }
    function login_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'bonus_amount' => 'required|integer|min:0',
            'free_spin' => 'required|integer',
            'w_2' => 'required|string',
            'recurring' => 'required|string',
            'status' => 'required|string',
        ]);
        //dd($request->all());
        DB::beginTransaction();
        try {
            $data = new PropersixBonus();
            $data->type ='login';
            $data->bonus_name = $request->bonus_name;
            $data->bonus_amount = $request->bonus_amount;
            $data->free_spin = $request->free_spin;
            /*  if (@$request->games) {
                 $data->game = implode(",", $request->games);
             } */
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->users) {
                $data->users = implode(",", $request->users);
            }
            if (@$request->vip_level) {
                $data->vip_level = implode(",", $request->vip_level);
            }
            if (@$request->bet_size) {
                $data->bet_size = $request->bet_size;
            }
            if (@$request->lines) {
                $data->lines = $request->lines;
            }
            if (@$request->wagering_req) {
                $data->wagering_req = $request->wagering_req;
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            if (@$request->aff_source) {
                $data->aff_source = $request->aff_source;
            }
            $data->recurring = $request->recurring;
            $data->w_2 = $request->w_2;
            $data->status = $request->status;
            $data->save();
            $user_id  = Auth::id();
            $logModel = $data;
            $request = $request->all();
            $log = 'registration_bonus';
            logCreatedActivity($user_id,$logModel,$request,$log);
            DB::commit();
            Toastr::success('Login bonus added successfully','Success');
            return redirect()->route('list-bonuses');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    function deposit_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'bonus_code' => 'required|string|unique:propersix_bonuses|min:6',
            'bonus_amount' => 'sometimes|nullable|integer|min:0',
            'free_spin' => 'required|integer',
            'w_2' => 'required|string',
            'recurring' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            $data = new PropersixBonus();
            $data->type ='deposit';
            $data->bonus_name = $request->bonus_name;
            $data->bonus_code = $request->bonus_code;
            $data->free_spin = $request->free_spin;
            /*  if (@$request->games) {
                 $data->game = implode(",", $request->games);
             } */
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->users) {
                $data->users = implode(",", $request->users);
            }
            if (@$request->chained) {
                $data->chained = implode(",", $request->chained);
            }
            if (@$request->vip_level) {
                $data->vip_level = implode(",", $request->vip_level);
            }
            if (@$request->percent_amount) {
                $data->percent_amount = $request->percent_amount;
            }
            if (@$request->max_amount) {
                $data->max_amount = $request->max_amount;
            }
            if (@$request->bonus_amount) {
                $data->bonus_amount = $request->bonus_amount;
            }
            if (@$request->bet_size) {
                $data->bet_size = $request->bet_size;
            }
            if (@$request->lines) {
                $data->lines = $request->lines;
            }
            if (@$request->wagering_req) {
                $data->wagering_req = $request->wagering_req;
            }
            if (@$request->ex_chain) {
                $data->ex_chain = date('y-m-d',strtotime($request->ex_chain));
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            if (@$request->aff_source) {
                $data->aff_source = $request->aff_source;
            }
            $data->recurring = $request->recurring;
            $data->w_2 = $request->w_2;
            $data->status = $request->status;
            $data->save();
            $user_id  = Auth::id();
            $logModel = $data;
            $request = $request->all();
            $log = 'deposit';
            logCreatedActivity($user_id,$logModel,$request,$log);

            Toastr::success('Deposit bonus  added successfully','Success');
            return redirect()->route('list-bonuses');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    function code_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'bonus_amount' => 'required|integer|min:0',
            'bonus_code' => 'required|unique:propersix_bonuses|string|min:6',
            'free_spin' => 'required|integer',
            'status' => 'required|string',
        ]);
        //dd($request->all());
        try {
            $data = new PropersixBonus();
            $data->type ='code';
            $data->bonus_name = $request->bonus_name;
            $data->bonus_amount = $request->bonus_amount;
            $data->bonus_code = $request->bonus_code;
            $data->free_spin = $request->free_spin;
            /*  if (@$request->games) {
                 $data->game = implode(",", $request->games);
             } */
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->bet_size) {
                $data->bet_size = $request->bet_size;
            }
            if (@$request->lines) {
                $data->lines = $request->lines;
            }
            if (@$request->wagering_req) {
                $data->wagering_req = $request->wagering_req;
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            $data->status = $request->status;
            $data->save();



            $user_id  = Auth::id();
            $logModel = $data;
            $request = $request->all();
            $log = 'bonuse_code';
            logCreatedActivity($user_id,$logModel,$request,$log);

            Toastr::success('Bonus code added successfully','Success');
            return redirect()->route('list-bonuses');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    function method_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'deposit_method' => 'required|string',
            'bonus_amount' => 'sometimes|nullable|integer|min:0',
            'free_spin' => 'required|integer',
            'w_2' => 'required|string',
            'recurring' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            $data = new PropersixBonus();
            $data->type ='method';
            $data->bonus_name = $request->bonus_name;
            $data->deposit_method = $request->deposit_method;
            $data->free_spin = $request->free_spin;
            if (@$request->games) {
                $data->game = implode(",", $request->games);
            }
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->users) {
                $data->users = implode(",", $request->users);
            }
            if (@$request->vip_level) {
                $data->vip_level = implode(",", $request->vip_level);
            }
            if (@$request->percent_amount) {
                $data->percent_amount = $request->percent_amount;
            }
            if (@$request->max_amount) {
                $data->max_amount = $request->max_amount;
            }
            if (@$request->bonus_amount) {
                $data->bonus_amount = $request->bonus_amount;
            }
            if (@$request->bet_size) {
                $data->bet_size = $request->bet_size;
            }
            if (@$request->lines) {
                $data->lines = $request->lines;
            }
            if (@$request->wagering_req) {
                $data->wagering_req = $request->wagering_req;
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            if (@$request->aff_source) {
                $data->aff_source = $request->aff_source;
            }
            $data->recurring = $request->recurring;
            $data->w_2 = $request->w_2;
            $data->status = $request->status;
            $data->save();
            Toastr::success('Payment method bonus  added successfully','Success');
            return redirect()->route('list-bonuses');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    function cashback_Bonus(Request $request){
        $request->validate([
            'bonus_name' => 'required|string',
            'min_loss' => 'required|string',
            'bonus_amount' => 'sometimes|nullable|integer|min:0',
            'w_2' => 'required|string',
            'recurring' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            $data = new PropersixBonus();
            $data->type ='cashback';
            $data->bonus_name = $request->bonus_name;
            $data->min_loss = $request->min_loss;
            if (@$request->ex_country) {
                $data->ex_country = implode(",", $request->ex_country);
            }
            if (@$request->users) {
                $data->users = implode(",", $request->users);
            }
            if (@$request->vip_level) {
                $data->vip_level = implode(",", $request->vip_level);
            }
            if (@$request->percent_amount) {
                $data->percent_amount = $request->percent_amount;
            }
            if (@$request->max_amount) {
                $data->max_amount = $request->max_amount;
            }
            if (@$request->bonus_amount) {
                $data->bonus_amount = $request->bonus_amount;
            }
            if (@$request->from) {
                $data->from = date('y-m-d',strtotime($request->from));
            }
            if (@$request->till) {
                $data->till = date('y-m-d',strtotime($request->till));
            }
            if (@$request->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($request->specific_day));
            }
            if (@$request->aff_source) {
                $data->aff_source = $request->aff_source;
            }
            $data->recurring = $request->recurring;
            $data->w_2 = $request->w_2;
            $data->status = $request->status;
            $data->save();
            Toastr::success('Cashback bonus  added successfully','Success');
            return redirect()->route('list-bonuses');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    public function status_change($id){
        $user = PropersixBonus::find($id);
        if($user->status== 1){
            $user->status = 0;
            $msg = 'Bonus deactivated successfully !';
        }else{
            $user->status = 1;
            $msg = 'Bonus activated successfully !';
        }
        $user->save();
        Toastr::success($msg,'Success');
        return redirect()->back();
    }
    function UsaerBonus(Request $request,$id){
        $request->validate([
            'bonus_code' => 'required|string|min:6',
            'bonus' => 'required|integer|min:1',
            'bonus_type' => 'required|',
            'valid_date' =>'required|after:today'
        ]);
        DB::beginTransaction();
        try {
            $data = new BonusCode();
            $data->bonus_code = $request->bonus_code;
            $data->user_id = $id;
            $data->bonus = $request->bonus;
            $data->bonus_type = $request->bonus_type;
            $data->valid_date = date('y-m-d',strtotime($request->valid_date));
            $data->save();
            if ($request->bonus_type == 1) {
                $promo = 'Bonus';
                $msg = "Apply this code \"$request->bonus_code\" now to get $request->bonus Bonus Tokens.";
            }else {
                $promo = 'Spin';
                $msg = "Apply this code \"$request->bonus_code\" now to get $request->bonus Free Spins.";
            }
            $not = new Notification();
            $not->user_id = $id;
            $not->message = 'You have got promo '. $promo.' code "'.$request->bonus_code.'"';
            $not->save();

            $notificatio = new LeaveNote();
            $notificatio->user_id = $id;
            $notificatio->body = $msg;
            $notificatio->save();
            DB::commit();
            Toastr::success('User bonus added Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    // propersix bonuses
    public function propersix_bonus()
    {
        $bonus_list            = Bonus::where('add_bonus_id','!=',null)->with('add_bonus','user')->get();
        return view('backend.bonus.propersix_bonus',compact('bonus_list'));
    }
    public function add_user_token(Request $request , $id){
        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $userWallet=\App\ProsixUserWallet::updateOrCreate(['user_id'=>$id]);
        $deposit = new Deposit();
        $user = User::find($id);
        $deposit->user_id = $id;
        $deposit->type = 'admin';
        $deposit->charge_id = 'ch_'. str_random(20);
        $deposit->amount = round($request->get('add_token')/$tok->pley6_token);
        $deposit->from = 'Casino';
        $deposit->to = $user->user_name;
        $deposit->save();
        $userWallet->usd=$userWallet->usd+($request->add_token/$tok->pley6_token);
        $userWallet->token= $userWallet->token + $request->add_token ;
        $userWallet->save();
        $tran_Type= new \App\TransactionType();
        $tran_Type->type='add_token';
        $tran_Type->created_by=Auth::id();
        $tran_Type->save();

        $transaction =new \App\ProsixTransaction();
        $transaction->user_id = $id;
        $transaction->amount = $request->add_token;
        $transaction->currency = 'pley6_token';
        $transaction->from = 'casino';
        $transaction->type =  $tran_Type->id;
        $transaction->to = $user->user_name;
        $transaction->created_by=Auth::id();
        $transaction->save();
        $data = new LeaveNote();
        $data->user_id = $id;
        $data->body = 'You received bonus of '.$request->add_token.' tokens from Casino';
        $data->status = 0;
        $data->save();
        Toastr::success('Tokens added successfully','success');
        return redirect()->back();
    }
}
