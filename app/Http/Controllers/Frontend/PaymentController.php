<?php

namespace App\Http\Controllers\Frontend;
use App\CurrencyBaseRate;
use App\Http\Controllers\backend\affiliate\AffiliateAppController;
use App\Models\System\Session;
use Validator;
use Auth;
use App\User;
use App\Bonus;
use App\Account;
use App\Deposit;
use App\BuyToken;
use App\Withdraw;
use Carbon\Carbon;
use CoinGate\CoinGate;
use Stripe\Charge;
use Stripe\Stripe;
use App\Transaction;
use App\ProsixWallet;
use App\TokenCurrency;
use App\UserDocuments;
use App\PropersixBonus;
use App\ProsixUserWallet;
use App\ProsixWalletType;
use App\TransactionType;
use App\ProsixTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PaymentController extends Controller
{
    function paymentDeposit(Request $r){
        $r->validate([
            'email' => 'required',
            'amount' => 'required|integer|min:1',
        ]);
//        $this->update_pro_session(Auth::user()->id,$r);
        $check = DB::table('general_settings')->latest()->first();
        if($check->min_deposit>$r->amount)
        {
//            Toastr::error("Something went wrong",'error');
//            return redirect()->back()->with('deposit_error',"Deposit amount must be shouldn't less than ".$check->min_deposit);
            return response()->json([
                'type' => 'error',
                'message' => "Deposit amount should not be less than 1 ".$check->min_deposit
            ]);
        }
        DB::beginTransaction();
//       try {
        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
/*        $earn = DB::table('game_earnings')->where('user_id', Auth::id())->sum('token');*/
            if (@$r->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('status',1)->first();
                if (@$bonus->users) {
                    if (@UserCheck($r->bonus_code) <= 0) {
                        return response()->json([
                            'type' => 'error',
                            'message' => "You are not eligible for a bonus."
                        ]);
                    }
                }
                if (!is_null(@$bonus)) {
                    if ($bonus->wagering_req != 0 || $bonus->wagering_req != '')
                    {
                        if ($bonus->specific_day) {
                            $bonusdateforchecking = date('Y-m-d' , strtotime($bonus->specific_day));
                            $userspending = DB::table('game_session_childs')
                                ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                                ->where('user_id',Auth::id())
                                ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                                ->where('spin_type','paid')
                                ->groupBy('game_id')
                                ->first();
                            $bnousDate = date('Y-m-d' , strtotime($bonus->specific_day));
                            $currentDate = date('Y-m-d',time());
                            if($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount){

                            }
                            else{
                                return response()->json([
                                    'type' => 'error',
                                    'message' => "Your current wagered amount '.$userspending->wageredamount.' has to be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for 24 hours"
                                ]);
                            }
                        }
                        if ($bonus->till) {
                            $bonusdateforcheckingfrom = date('Y-m-d 00:00:00' , strtotime($bonus->from));
                            $bonusdateforcheckingtill = date('Y-m-d 23:59:59',strtotime($bonus->till) );
                            $userspending = DB::table('game_session_childs')
                                ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                                ->where('user_id',Auth::id())
                                ->where(DB::raw('date(created_at)'),'>=',$bonusdateforcheckingfrom)
                                ->where(DB::raw('date(created_at)'),'<=',$bonusdateforcheckingtill)
                                ->where('spin_type','paid')
                                ->groupBy('game_id')
                                ->first();
                            $bnousfrom = strtotime($bonus->from);
                            $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($bonus->till) ) );
                            $currentDate = time();
                            if($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $bonus->wagering_req <= $userspending->wageredamount){

                            }
                            else{
//
                                return response()->json([
                                    'type' => 'error',
                                    'message' => 'Your current wagered amount '.$userspending->wageredamount.' has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )
                                ]);
                             }
                        }
                    }
                    if (@$bonus->ex_country || true) {
                        $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('ex_country','like', '%'.Auth::user()->profile->country.'%')->get();
                        if (@$data->count() > 0) {
                            return response()->json([
                                'type' => 'error',
                                'message' => 'Your country is not eligible for a bonus.'
                            ]);
                        }
                        else {
                            $b_c = Bonus::where('add_bonus_id',@$bonus->id)->where('user_id' , Auth::id() )->first();
                            if (!is_null($b_c)) {
//
                                return response()->json([
                                    'type' => 'error',
                                    'message' => 'Bonus code already availed'
                                ]);
                            }
                            if (@$bonus->specific_day) {
                                $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('specific_day','=',Carbon::today()->toDateString())->first();
                                if (isset($data)) {
                                    if (@$data->bonus_amount) {
                                        $bonus_amount = $data->bonus_amount;
                                     }
                                    else if (@$data->max_amount > $r->amount) {
                                        return response()->json([
                                            'type' => 'error',
                                            'message' => 'You need to deposit more than '.$data->max_amount
                                        ]);
                                    }
                                    else {
                                        $bonus_amount =$tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                        if ($bonus_amount<=10000)
                                        {
                                            $bonus_amount=$bonus_amount;
                                        }
                                        else
                                        {
                                            $bonus_amount=10000;
                                        }
                                    }

//                                    try {
//                                        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
//                                        $charge = \Stripe\Charge::create(array(
//                                            'description' => " - Amount: ".$r->amount,
//                                            'source' => $r->stripeToken,
//                                            'amount' => (int)($r->amount * 100),
//                                            'currency' => 'USD',
//                                        ));
//                                    }
//                                    catch (\Exception $e) {
//
//                                        Toastr::error('There is a problem with your payment.Try later!','Error');
//                                        return redirect()->back();
//                                    }

                                    //code to save data of deposit in deposits table
                                $deposit = new Deposit();
                                $deposit->user_id = Auth::user()->id;
                                $deposit->amount = $r->amount;
                                $deposit->charge_id = $r->client_secret;
                                $deposit->from = Auth::user()->user_name;
                                $deposit->to = 'casino';
                                $deposit->type = $data->type;
                                $deposit->save();
                                transactionWallet($deposit->amount,$deposit->type,$deposit->from,$deposit->to);

                                $user_id  = Auth::id();
                                $logModel = $deposit;
                                $request = $deposit;
                                $log =  $deposit->type;
                                logCreatedActivity($user_id,$logModel,$request,$log);

                                //work arround to update user profile and handdle form submission
                                $user_pr=User::findOrFail(Auth::user()->id);
                                $user=$user_pr->profile;
                                $user->first_name = $r->first_name;
                                $user->last_name = $r->last_name;
                                $user->country = $r->country;
                                $user->state = $r->state;
                                $user->zipcode = $r->zipcode;
                                $user->address = $r->Address;
                                $user->save();

                                //saving data into bonuses table and checking if user has already availed the bonus
                                $bonus=new \App\Bonus;
                                $bonus->user_id =  Auth::id();
                                $bonus->add_bonus_id =  $data->id;
                                $bonus->amount= $bonus_amount;
                                $bonus->spin = @$data->free_spin;
                                $bonus->betsize = @$data->bet_size;
                                $bonus->line = @$data->lines;
                                $bonus->type = 'bonus_code';
                                $bonus->from='casino';
                                $bonus->to= Auth::user()->user_name;
                                $bonus->save();

                                // notification
                                $notification=new \App\Notification;
                                $notification->user_id = Auth::id();
                                $notification->message='You got '.$data->bonus_amount.' token and '.$data->free_spin.' spin bonus';
                                $notification->save();

                                $bonus_type = 'bonus_token';

                                $wal = ProsixWalletType::where('type',$bonus_type)->first();
                                if (is_null($wal)) {
                                    $wallet_type= new ProsixWalletType();
                                } else {
                                    $wallet_type = $wal;
                                }
                                $wallet_type->type=$bonus_type;
                                $wallet_type->save();

                                //saving record of bonus data in prosix_wallets table
                                $wallet =new ProsixWallet();
                                $wallet->user_id = Auth::user()->id;
                                if ($data->percent_amount != '')
                                {
                                    $wallet->amount = $tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                    if ($wallet->amount<=10000)
                                    {
                                        $wallet->amount=$wallet->amount;
                                    }
                                    else
                                    {
                                        $wallet->amount=10000;
                                    }
                                }
                                else
                                {
                                    $wallet->amount = $data->bonus_amount;
                                }
                                $wallet->type_id =  $wallet_type->id;
                                $wallet->created_by=Auth::id();
                                $wallet->bonus_id=$data->id;
                                $wallet->save();
                                // updating prosix_user_wallet table lobby main table for user wallet
                                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>Auth::id()]);
                                $userWallet->free_token+= $wallet->amount;
                                $userWallet->free_spin+= $data->free_spin;
                                $userWallet->usd+= (float)@$r->amount;
                                $userWallet->token = $userWallet->token + ($r->amount * $tok->pley6_token) ;
                                $userWallet->type_id=$wallet_type->id;
                                $userWallet->save();
                                    //saving data in prosix_user_wallets for admin wallet functionalitiy
                                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                                $AdminWallet->free_token= $AdminWallet->free_token + (floatval(@$data->bonus_amount));
                                $AdminWallet->free_spin= $AdminWallet->free_spin + (floatval(@$data->free_spin));
                                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                                $userWallet->token = $userWallet->token + ($r->amount * $tok->pley6_token) ;
                                $AdminWallet->type_id=$wallet_type->id;
                                $AdminWallet->save();*/

                                $user_id  = Auth::id();
                                $logModel = $bonus;
                                $request = $bonus;
                                $log =  $bonus->type;
                                logCreatedActivity($user_id,$logModel,$request,$log);

                                $notification=new \App\Notification;
                                $notification->user_id=Auth::user()->id;
                                $notification->message='You have deposited $'.$r->amount.' in your account. '.'You have received '.$userWallet->free_token.' free tokens';
                                $notification->save();
                                //saving data in transactions table with usd amount of deposit
                                    $transaction =new Transaction();
                                    $transaction->user_id = $user_id;
                                    $transaction->transaction_id = $deposit->id;
                                    $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                                    $transaction->amount = $r->amount;
                                    $transaction->from = Auth::user()->user_name;
                                    $transaction->to ='casino';
                                    $transaction->type = 'deposit';
                                    $transaction->usd = $r->amount;
                                    $transaction->currency = 'usd';
                                    $transaction->save();
                                    if ($r->submit_status==1)
                                    {
                                        DB::commit();
                                    }


//                                Toastr::success('Succsesfully deposit');
//                                return redirect()->back();
                                    return response()->json([
                                        'type' => 'success',
                                        'message' => 'Successfully deposit'
                                    ]);
                                }else {
//                                    Toastr::error('Bonus code expired','Error');
//                                    return redirect()->back();
                                    return response()->json([
                                        'type' => 'error',
                                        'message' => 'Bonus code expired'
                                    ]);
                                }
                            }
                            elseif (@$bonus->till) {
                                $data = PropersixBonus::where('type','deposit')
                                                    ->where('bonus_code',$r->bonus_code)
                                                    ->where('status','1')
                                                    ->where('from', '<=', Carbon::today()->toDateString())
                                                    ->where('till', '>=', Carbon::today()->toDateString())
                                                    ->first();

                                if ($data->count() > 0) {
                                     if (@$data->bonus_amount) {
                                        $bonus_amount = $data->bonus_amount;
                                     }
                                    else if (@$data->max_amount > $r->amount) {
//                                         Toastr::error('You need to deposit more than '.$data->max_amount,'Error');
//                                         return redirect()->back();
                                        return response()->json([
                                            'type' => 'You need to deposit more than '.$data->max_amount,
                                            'message' => 'Bonus code expired'
                                        ]);
                                    }
                                    else {
                                        $bonus_amount = $tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                        if ($bonus_amount<=10000)
                                        {
                                            $bonus_amount=$bonus_amount;
                                        }
                                        else
                                        {
                                            $bonus_amount=10000;
                                        }
                                    }
//                                    try {
//                                        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
//                                        $charge = \Stripe\Charge::create(array(
//                                            'description' => " - Amount: ".$r->amount,
//                                            'source' => $r->stripeToken,
//                                            'amount' => (int)($r->amount * 100),
//                                            'currency' => 'USD',
//                                        ));
//                                    }
//                                    catch (\Exception $e) {
//
//                                        Toastr::error('There is a problem with your payment.Try later!','Error');
//                                        return redirect()->back();
//                                    }

                                    //code to save data of deposit in deposits table
                                    $deposit = new Deposit();
                                    $deposit->user_id = Auth::user()->id;
                                    $deposit->amount = $r->amount;
                                    $deposit->charge_id = $r->client_secret;
                                    $deposit->charge_id = '1';
                                    $deposit->from = Auth::user()->user_name;
                                    $deposit->to = 'casino';
                                    $deposit->type = $data->type;
                                    $deposit->save();
                                    transactionWallet($deposit->amount,$deposit->type,$deposit->from,$deposit->to);

                                    $user_id  = Auth::id();
                                    $logModel = $deposit;
                                    $request = $deposit;
                                    $log =  $deposit->type;
                                    logCreatedActivity($user_id,$logModel,$request,$log);

                                    //work arround to update user profile and handdle form submission
                                    $user_pr=User::findOrFail(Auth::user()->id);
                                    $user=$user_pr->profile;
                                    $user->first_name = $r->first_name;
                                    $user->last_name = $r->last_name;
                                    $user->country = $r->country;
                                    $user->state = $r->state;
                                    $user->zipcode = $r->zipcode;
                                    $user->address = $r->Address;
                                    $user->save();

                                    //saving data into bonuses table and checking if user has already availed the bonus
                                    $bonus=new \App\Bonus;
                                    $bonus->user_id =  Auth::id();
                                    $bonus->add_bonus_id =  $data->id;
                                    $bonus->amount= $bonus_amount;
                                    $bonus->spin = @$data->free_spin;
                                    $bonus->betsize = @$data->bet_size;
                                    $bonus->line = @$data->lines;
                                    $bonus->type = 'bonus_code';
                                    $bonus->from='casino';
                                    $bonus->to= Auth::user()->user_name;
                                    $bonus->save();

                                    // notification
                                    $notification=new \App\Notification;
                                    $notification->user_id = Auth::id();
                                    $notification->message='You got '.$data->bonus_amount.' token and '.$data->free_spin.' spin bonus';
                                    $notification->save();

                                    $bonus_type = 'bonus_token';

                                    $wal = ProsixWalletType::where('type',$bonus_type)->first();
                                    if (is_null($wal)) {
                                        $wallet_type= new ProsixWalletType();
                                    } else {
                                        $wallet_type = $wal;
                                    }
                                    $wallet_type->type=$bonus_type;
                                    $wallet_type->save();

                                    //saving record of bonus data in prosix_wallets table
                                    $wallet =new ProsixWallet();
                                    $wallet->user_id = Auth::user()->id;
                                    if ($data->percent_amount != '')
                                    {
                                        $wallet->amount = $tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                        if ($wallet->amount<=10000)
                                        {
                                            $wallet->amount=$wallet->amount;
                                        }
                                        else
                                        {
                                            $wallet->amount=10000;
                                        }
                                    }
                                    else
                                    {
                                        $wallet->amount = $data->bonus_amount;
                                    }
                                    $wallet->type_id =  $wallet_type->id;
                                    $wallet->created_by=Auth::id();
                                    $wallet->bonus_id=$data->id;
                                    $wallet->save();
                                    // updating prosix_user_wallet table lobby main table for user wallet
                                    $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>Auth::id()]);
                                    $userWallet->free_token+= $wallet->amount;
                                    $userWallet->free_spin+= $data->free_spin;
                                    $userWallet->usd+= (float)@$r->amount;
                                    $userWallet->token = $userWallet->token + ($r->amount * $tok->pley6_token) ;
                                    $userWallet->type_id=$wallet_type->id;
                                    $userWallet->save();
                                    //saving data in prosix_user_wallets for admin wallet functionalitiy
                                    /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                                    $AdminWallet->free_token= $AdminWallet->free_token + (floatval(@$data->bonus_amount));
                                    $AdminWallet->free_spin= $AdminWallet->free_spin + (floatval(@$data->free_spin));
                                    $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                                    $userWallet->token = $userWallet->token + ($r->amount * $tok->pley6_token) ;
                                    $AdminWallet->type_id=$wallet_type->id;
                                    $AdminWallet->save();*/

                                    $user_id  = Auth::id();
                                    $logModel = $bonus;
                                    $request = $bonus;
                                    $log =  $bonus->type;
                                    logCreatedActivity($user_id,$logModel,$request,$log);

                                    $notification=new \App\Notification;
                                    $notification->user_id=Auth::user()->id;
                                    $notification->message='You have deposited $'.$r->amount.' in your account. '.'You have received '.$userWallet->free_token.' free tokens';
                                    $notification->save();
                                    //saving data in transactions table with usd amount of deposit
                                    $transaction =new Transaction();
                                    $transaction->user_id = $user_id;
                                    $transaction->transaction_id = $deposit->id;
                                    $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                                    $transaction->amount = $r->amount;
                                    $transaction->from = Auth::user()->user_name;
                                    $transaction->to ='casino';
                                    $transaction->type = 'deposit';
                                    $transaction->usd = $r->amount;
                                    $transaction->currency = 'usd';
                                    $transaction->save();
                                    if ($r->submit_status==1)
                                    {
                                        DB::commit();
                                    }
//                                    Toastr::success('Successfully deposit');
//                                    return redirect()->back();
                                    return response()->json([
                                        'type' => 'success',
                                        'message' => 'Successfully deposit'
                                    ]);
                                }else {
//                                    Toastr::error('Bonus code expired','Error');
//                                    return redirect()->back();
                                    return response()->json([
                                        'type' => 'error',
                                        'message' => 'Bonus code expired'
                                    ]);
                                }

                            }
                        }

                    } else {
//                        Toastr::error('Your country is not eligible for a bonus.','Error');
//                        return redirect()->back();
                        return response()->json([
                            'type' => 'error',
                            'message' => 'Your country is not eligible for a bonus.'
                        ]);
                    }

                }else {
//                    Toastr::error('Invalid bonus code.','Error');
//                    return redirect()->back();
                    return response()->json([
                        'type' => 'error',
                        'message' => 'Invalid bonus code.'
                    ]);
                }
            }
            else
            {
//                try {
                    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
//                $stripe = new \Stripe\StripeClient(
//                    config('services.stripe.secret')
//                );
//
//                $customer = $stripe->customers->create([
//                    'name'        => Auth::user()->name,
//                    'email'       => Auth::user()->email,
//                ]);
//
//                    $charge = \Stripe\Charge::create(array(
//                        'description' => " - Amount: ".$r->amount,
//                        'source' => $r->stripeToken,
//                        'amount' => (int)($r->amount * 100),
//                        'currency' => 'USD',
////                        'customer' => $customer->id
//                    ));
//                $intent = \Stripe\PaymentIntent::create([
//                    'amount' => 1099,
//                    'currency' => 'USD',
//                    // Verify your integration in this guide by including this parameter
//                    'metadata' => ['integration_check' => 'accept_a_payment'],
//                ]);
//
//                 return response()->json($intent->client_secret);
//                }
//                catch (\Exception $e) {
//
//                    Toastr::error('There is a problem with your payment.Try later!','Error');
//                    return redirect()->back();
//                }
                $deposit = new Deposit();

                $deposit->user_id = Auth::user()->id;
                $deposit->amount = $r->amount;
                $deposit->charge_id = $r->client_secret;
                $deposit->to = 'casino';
                $deposit->type = 'deposit';
                $deposit->from = Auth::user()->user_name;
                $deposit->save();
                transactionWallet($deposit->amount,$deposit->type,$deposit->from,$deposit->to);
                $user_pr=User::findOrFail(Auth::user()->id);
                $user=$user_pr->profile;
                $user->first_name = $r->first_name;
                $user->last_name = $r->last_name;
                $user->country = $r->country;
                $user->state = $r->state;
                $user->zipcode = $r->zipcode;
                $user->address = $r->Address;
                $user->save();
                $user_id  = Auth::id();
                $logModel = $deposit;
                $request = $deposit;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>Auth::id()]);
                $userWallet->usd +=  (float)@$r->amount;
                $userWallet->token = $userWallet->token + ($r->amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=Auth::user()->id;
                $notification->message=getTranslated('deposit_success').$r->amount;
                $notification->save();


                $transaction =new Transaction();
                $transaction->user_id = $user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $r->amount*$tok->pley6_token;
                $transaction->from = Auth::user()->user_name;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $r->amount;
                $transaction->currency = 'usd';
                $transaction->save();
                if ($r->submit_status==1)
                {
                    DB::commit();
                }
//                Toastr::success('You have successfully deposited $'.$r->amount);
//                return redirect()->back();
                return response()->json([
                    'type' => 'success',
                    'message' => getTranslated('deposit_success').$r->amount
                ]);
            }

//        } catch (\Exception $e) {
//            Toastr::error('Something went wrong try again!','Error');
//            return redirect()->back();
//        }
    }
    function paymentDeposit_coingateharoon(Request $r)
    {

        CoinGate::config(array(
            'environment'               => 'sandbox', // sandbox OR live
            'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
            'curlopt_ssl_verifypeer'    => TRUE // default is false
        ));
//        $this->update_pro_session(Auth::user()->id,$r);
        $check = DB::table('general_settings')->latest()->first();
        if($check->min_deposit>$r->amount)
        {
            Toastr::error("Something went wrong",'error');
            return redirect()->back()->with('deposit_error',"Deposit amount must be shouldn't less than ".$check->min_deposit);
        }
        $post_params = array(
            'order_id'          => '',
            'price_amount'      => $r->amount,
            'price_currency'    => 'USD',
            'receive_currency'  => 'BTC',
            'callback_url'      => 'https://propersix.casino/coin_callback',
            'cancel_url'        => 'https://propersix.casino',
            'success_url'       => 'https://propersix.casino/user/dashboard',
            'title'             =>  $r->first_name.''.$r->last_name,
//            'token'           => "mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx",
            'description'       => "",
            //"Address: ".$r->address.', '.$r->zipcode.','.$r->state,
        );
        $order                   = \CoinGate\Merchant\Order::create($post_params);
        if ($order) {

            $s_order                     = new \App\CoinGate();
            $s_order->id                 = $order->id;
            $s_order->user_id            = Auth::user()->id;
            $s_order->currency           = $order->price_currency;
            $s_order->receive_currency   = $order->receive_currency;
            $s_order->deposit_amount     = $order->receive_amount;
            $s_order->deposit_usd        = $r->amount;
            $s_order->play6_token        = $r->PlaySix_token1;
            $s_order->bonus_code         = $r->bonus_code;
            $s_order->processable_token  = $order->token;
            $s_order->status             = $order->status;
//            $dtime                       = DateTime::createFromFormat("d/m G:i", "13/10 15:00");
//            $timestamp = $dtime->getTimestamp();
//            $s_order->created_at         = $order->created_at;
            $s_order->save();
            return redirect($order->payment_url);
        } else {
            return redirect()->back()->with('message','Something Went Wrong');
        }
    }
    function paymentDeposit_coingate(Request $r)
    {
//        $this->update_pro_session(Auth::user()->id,$r);
        if (@$r->bonus_code) {
            $checkifbonuscodeused = \App\CoinGate::where('bonus_code',$r->bonus_code)->where('user_id',Auth::id())->where('status','paid')
                ->first();
            if ($checkifbonuscodeused)
            {
                Toastr::error('This Bonus code has already been used.','Error');
                return redirect()->back();
            }
            $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('status',1)->first();
            if (@$bonus->users) {
                if (@UserCheck($r->bonus_code) <= 0) {
                    Toastr::error('You are not eligible for a bonus.','Error');
                    return redirect()->back();
                }
            }
            if (!is_null(@$bonus)) {
                if ($bonus->wagering_req != 0 || $bonus->wagering_req != '')
                {
                    if ($bonus->specific_day) {
                        $bonusdateforchecking = date('Y-m-d' , strtotime($bonus->specific_day));
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id',Auth::id())
                            ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                            ->where('spin_type','paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousDate = date('Y-m-d' , strtotime($bonus->specific_day));
                        $currentDate = date('Y-m-d',time());
                        if($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount)
                        {

                        }
                        else{
                            Toastr::error('Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for 24 hours','Error');
                            // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.' has to be be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for 24 hours'], 200);
                            return redirect()->back();
                        }
                    }
                    if ($bonus->till) {
                        $bonusdateforcheckingfrom = date('Y-m-d 00:00:00' , strtotime($bonus->from));
                        $bonusdateforcheckingtill = date('Y-m-d 23:59:59',strtotime($bonus->till) );
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id',Auth::id())
                            ->where(DB::raw('date(created_at)'),'>=',$bonusdateforcheckingfrom)
                            ->where(DB::raw('date(created_at)'),'<=',$bonusdateforcheckingtill)
                            ->where('spin_type','paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousfrom = strtotime($bonus->from);
                        $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($bonus->till) ) );
                        $currentDate = time();
                        if($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $bonus->wagering_req <= $userspending->wageredamount){

                        }
                        else{
                            Toastr::error('Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) ),'Error');
                            // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )], 200);
                            return redirect()->back();
                        }
                    }
                }
                if (@$bonus->ex_country || true)
                {
                    $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('ex_country','like', '%'.Auth::user()->profile->country.'%')->get();
                    if (@$data->count() > 0) {
                        return response()->json(['error'=>'Your country is not eligible for a bonus.'], 200);
                        Toastr::error('Your country is not eligible for a bonus.','Error');
                        return redirect()->back();
                    }
                    else {
                        $b_c = Bonus::where('add_bonus_id',@$bonus->id)->where('user_id' , Auth::id() )->first();
                        if (!is_null($b_c)) {
                            Toastr::error('Invalid bonus code.','Error');
                            return redirect()->back();
                        }
                        if (@$bonus->specific_day) {
                            $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('specific_day','=',Carbon::today()->toDateString())->first();
                            if (isset($data)) {
                                if (@$data->max_amount > $r->deposit_usd) {
                                    Toastr::error('You need to deposit more than '.$data->max_amount,'Error');
                                    return redirect()->back();
                                }
                                //code for coingate order
                                CoinGate::config(array(
                                    'environment'               => 'sandbox', // sandbox OR live
                                    'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
                                    'curlopt_ssl_verifypeer'    => TRUE // default is false
                                ));
                                $check = DB::table('general_settings')->latest()->first();
                                if($check->min_deposit>$r->amount)
                                {
                                    Toastr::error("Something went wrong",'error');
                                    return redirect()->back()->with('deposit_error',"Deposit amount can’t be less than ".$check->min_deposit);
                                }
                                $post_params = array(
                                    'order_id'          => '',
                                    'price_amount'      => $r->amount,
                                    'price_currency'    => 'USD',
                                    'receive_currency'  => 'BTC',
                                    'callback_url'      => 'https://newdomain.casino/coin_callback',
                                    'cancel_url'        => 'https://newdomain.casino',
                                    'success_url'       => 'https://newdomain.casino/user/dashboard#deposit',
                                    'title'             =>  $r->first_name.''.$r->last_name,
                        //            'token'           => "mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx",
                                    'description'       => "",
                                    //"Address: ".$r->address.', '.$r->zipcode.','.$r->state,
                                );
                                $order                   = \CoinGate\Merchant\Order::create($post_params);
                                if ($order) {

                                $s_order                     = new \App\CoinGate();
                                $s_order->id                 = $order->id;
                                $s_order->user_id            = Auth::user()->id;
                                $s_order->currency           = $order->price_currency;
                                $s_order->receive_currency   = $order->receive_currency;
                                $s_order->deposit_amount     = $order->receive_amount;
                                $s_order->deposit_usd        = $r->amount;
                                $s_order->play6_token        = $r->PlaySix_token1;
                                $s_order->bonus_code         = $r->bonus_code;
                                $s_order->processable_token  = $order->token;
                                $s_order->status             = $order->status;
//            $dtime                       = DateTime::createFromFormat("d/m G:i", "13/10 15:00");
//            $timestamp = $dtime->getTimestamp();
//            $s_order->created_at         = $order->created_at;
                                $s_order->save();
                                  return redirect($order->payment_url);
                              } else {
                                  return redirect()->back()->with('message','Something Went Wrong');
                              }
                                //code for coing gate order
                            }else {
                                Toastr::error('Bonus code expired','Error');
                                return redirect()->back();
                            }
                        }
                        elseif (@$bonus->till) {
                            $data = PropersixBonus::where('type','deposit')
                                ->where('bonus_code',$r->bonus_code)
                                ->where('status','1')
                                ->where('from', '<=', Carbon::today()->toDateString())
                                ->where('till', '>=', Carbon::today()->toDateString())
                                ->first();

                            if ($data->count() > 0) {
                                if (@$data->max_amount > $r->amount) {
                                    Toastr::error('You need to deposit more than '.$data->max_amount,'Error');
                                    return redirect()->back();
                                }
                                //code for coingate order
                                CoinGate::config(array(
                                    'environment'               => 'sandbox', // sandbox OR live
                                    'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
                                    'curlopt_ssl_verifypeer'    => TRUE // default is false
                                ));
                                $check = DB::table('general_settings')->latest()->first();
                                if($check->min_deposit>$r->amount)
                                {
                                    Toastr::error("Something went wrong",'error');
                                    return redirect()->back()->with('deposit_error',"Deposit amount can’t be less than ".$check->min_deposit);
                                }
                                $post_params = array(
                                    'order_id'          => '',
                                    'price_amount'      => $r->amount,
                                    'price_currency'    => 'USD',
                                    'receive_currency'  => 'BTC',
                                    'callback_url'      => 'https://propersix.casino/coin_callback',
                                    'cancel_url'        => 'https://propersix.casino',
                                    'success_url'       => 'https://propersix.casino/user/dashboard#deposit',
                                    'title'             =>  $r->first_name.''.$r->last_name,
                        //            'token'           => "mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx",
                                    'description'       => "",
                                    //"Address: ".$r->address.', '.$r->zipcode.','.$r->state,
                                );
                                $order                   = \CoinGate\Merchant\Order::create($post_params);
                                if ($order) {

                                $s_order                     = new \App\CoinGate();
                                $s_order->id                 = $order->id;
                                $s_order->user_id            = Auth::user()->id;
                                $s_order->currency           = $order->price_currency;
                                $s_order->receive_currency   = $order->receive_currency;
                                $s_order->deposit_amount     = $order->receive_amount;
                                $s_order->deposit_usd        = $r->amount;
                                $s_order->play6_token        = $r->PlaySix_token1;
                                $s_order->bonus_code         = $r->bonus_code;
                                $s_order->processable_token  = $order->token;
                                $s_order->status             = $order->status;
//            $dtime                       = DateTime::createFromFormat("d/m G:i", "13/10 15:00");
//            $timestamp = $dtime->getTimestamp();
//            $s_order->created_at         = $order->created_at;
                                $s_order->save();
                                  return redirect($order->payment_url);
                              } else {
                                  return redirect()->back()->with('message','Something Went Wrong');
                              }
//code for coing gate order
                            }else {
                                Toastr::error('Bonus code expired','Error');
                                return redirect()->back();
                            }

                        }
                    }

                }
                else {
                    Toastr::error('Your country is not eligible for a bonus.','Error');
                    return redirect()->back();
                }

            }else {
                Toastr::error('Invalid bonus code.','Error');
                return redirect()->back();
            }
        }
        else
        {
            //code for coingate order
            CoinGate::config(array(
                'environment'               => 'sandbox', // sandbox OR live
                'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
                'curlopt_ssl_verifypeer'    => TRUE // default is false
            ));
            $check = DB::table('general_settings')->latest()->first();
            if($check->min_deposit>$r->amount)
            {
                Toastr::error("Something went wrong",'error');
                return redirect()->back()->with('deposit_error',"Deposit amount  shouldn't less than ".$check->min_deposit);
            }
            $post_params = array(
                'order_id'          => '',
                'price_amount'      => $r->amount,
                'price_currency'    => 'USD',
                'receive_currency'  => 'BTC',
                'callback_url'      => 'https://propersix.casino/coin_callback',
                'cancel_url'        => 'https://propersix.casino',
                'success_url'       => 'https://propersix.casino/user/dashboard#deposit',
                'title'             =>  $r->first_name.''.$r->last_name,
    //            'token'           => "mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx",
                'description'       => "",
                //"Address: ".$r->address.', '.$r->zipcode.','.$r->state,
            );
            $order                   = \CoinGate\Merchant\Order::create($post_params);
            if ($order) {
            $s_order                     = new \App\CoinGate();
            $s_order->id                 = $order->id;
            $s_order->user_id            = Auth::user()->id;
            $s_order->currency           = $order->price_currency;
            $s_order->receive_currency   = $order->receive_currency;
            $s_order->deposit_amount     = $order->receive_amount;
            $s_order->deposit_usd        = $r->amount;
            $s_order->play6_token        = $r->PlaySix_token1;
            $s_order->processable_token  = $order->token;
            $s_order->status             = $order->status;
//            $dtime                       = DateTime::createFromFormat("d/m G:i", "13/10 15:00");
//            $timestamp = $dtime->getTimestamp();
//            $s_order->created_at         = $order->created_at;
            $s_order->save();
              return redirect($order->payment_url);
          } else {
              return redirect()->back()->with('message','Something Went Wrong');
          }
//code for coing gate order
        }
    }
    function paymentDeposit_ethereum(Request $r)
    {
       $validator           = Validator::make($r->all(), [
           'amount' =>'required|numeric|min:1',
       ]);
       if ($validator->fails())
       {
           Toastr::error("Enter valid amount");
           return redirect()->back()->with('banking_tab','deposit_coin');
       }
       try {
        if ($r->coin_currency=="eth")
            $endpoint = "http://54.84.164.243:12500/api/generateAddress";
        else if ($r->coin_currency=="btc")
            $endpoint = "http://54.84.164.243:12500/api/generateAddress";
        else if ($r->coin_currency=="usdt")
            // for testing
            //$endpoint = "http://3.236.170.179:12500/api/generateAddress";
            $endpoint = "http://54.84.164.243:12500/api/generateAddress";
        else if ($r->coin_currency=="lby")
        $endpoint = "http://54.84.164.243:12501/api/generateAddress";
        else if ($r->coin_currency=="psix")
        $endpoint = "http://54.84.164.243:12501/api/generateAddress";
           $client = new \GuzzleHttp\Client();
           if (@$r->bonus_code) {
               $checkifbonuscodeused = \App\CoinGate::where('bonus_code', $r->bonus_code)->where('user_id', Auth::id())->where('status', 'paid')
                   ->first();
               if ($checkifbonuscodeused) {
                   Toastr::error('This Bonus code has already been used.', 'Error');
                   return redirect()->back()->with('banking_tab','deposit_coin');
               }
               $bonus = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('status', 1)->first();
               if (@$bonus->users) {
                   if (@UserCheck($r->bonus_code) <= 0) {
                       Toastr::error('You are not eligible for a bonus.', 'Error');
                       return redirect()->back()->with('banking_tab','deposit_coin');
                   }
               }
               if (!is_null(@$bonus)) {
                   if ($bonus->wagering_req != 0 || $bonus->wagering_req != '') {
                       if ($bonus->specific_day) {
                           $bonusdateforchecking = date('Y-m-d', strtotime($bonus->specific_day));
                           $userspending = DB::table('game_session_childs')
                               ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                               ->where('user_id', Auth::id())
                               ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                               ->where('spin_type', 'paid')
                               ->groupBy('game_id')
                               ->first();
                           $bnousDate = date('Y-m-d', strtotime($bonus->specific_day));
                           $currentDate = date('Y-m-d', time());
                           if ($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount) {

                           } else {
                               Toastr::error('Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this Bonus.This code is Valid for only 24 hours', 'Error');
                               // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for only 24 hours'], 200);
                               return redirect()->back()->with('banking_tab','deposit_coin');
                           }
                       }
                       if ($bonus->till) {
                           $bonusdateforcheckingfrom = date('Y-m-d 00:00:00', strtotime($bonus->from));
                           $bonusdateforcheckingtill = date('Y-m-d 23:59:59', strtotime($bonus->till));
                           $userspending = DB::table('game_session_childs')
                               ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                               ->where('user_id', Auth::id())
                               ->where(DB::raw('date(created_at)'), '>=', $bonusdateforcheckingfrom)
                               ->where(DB::raw('date(created_at)'), '<=', $bonusdateforcheckingtill)
                               ->where('spin_type', 'paid')
                               ->groupBy('game_id')
                               ->first();
                           $bnousfrom = strtotime($bonus->from);
                           $bnoustill = strtotime(date('Y-m-d 23:59:59', strtotime($bonus->till)));
                           $currentDate = time();
                           if ($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $bonus->wagering_req <= $userspending->wageredamount) {

                           } else {
                               Toastr::error('Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this bonus.This code is valid between ' . $bonus->from . ' and ' . date('Y-m-d 23:59:59', strtotime($bonus->till)), 'Error');
                               // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )], 200);
                               return redirect()->back()->with('banking_tab','deposit_coin');
                           }
                       }
                   }
                   if (@$bonus->ex_country || true) {
                       $data = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('ex_country', 'like', '%' . Auth::user()->profile->country . '%')->get();
                       if (@$data->count() > 0) {
                           return response()->json(['error' => 'Your country is not eligible for a bonus.'], 200);
                           Toastr::error('Your country is not eligible for a bonus.', 'Error');
                           return redirect()->back()->with('banking_tab','deposit_coin');
                       } else {
                           $b_c = Bonus::where('add_bonus_id', @$bonus->id)->where('user_id', Auth::id())->first();
                           if (!is_null($b_c)) {
                               Toastr::error('Invalid bonus code.', 'Error');
                               return redirect()->back()->with('banking_tab','deposit_coin');
                           }
                           if (@$bonus->specific_day) {
                               $data = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('specific_day', '=', Carbon::today()->toDateString())->first();
                               if (isset($data)) {
                                   if (@$data->max_amount > $r->deposit_usd) {
                                       Toastr::error('You need to deposit more than ' . $data->max_amount, 'Error');
                                       return redirect()->back()->with('banking_tab','deposit_coin');
                                   }
                                   //code for coingate order
//                                CoinGate::config(array(
//                                    'environment'               => 'sandbox', // sandbox OR live
//                                    'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
//                                    'curlopt_ssl_verifypeer'    => TRUE // default is false
//                                ));
                                   $check = DB::table('general_settings')->latest()->first();
                                   if ($check->min_deposit > strip_tags($r->amount)) {
                                       Toastr::error("Deposit amount can’t be less than " . $check->min_deposit, 'error');
                                       return redirect()->back()->with([
                                           'deposit_error' => "Deposit amount can’t be less than " . $check->min_deposit,
                                           'banking_tab'   => 'deposit_coin'
                                       ]);
                                   }
                                   $response = $client->request('GET', $endpoint, ['query' => [
                                       'symbol' => $r->coin_currency,
                                        'firstName' => Auth::user()->firstname,
                                       'lastName' => Auth::user()->lastName,
                                       'email' => Auth::user()->email,
                                       'usdAmount' => strip_tags($r->amount),
                                       'usdMin' => $check->min_deposit
                                   ]]);
                                   $statusCode = $response->getStatusCode();
                                   $content = $response->getBody();
                                   $depsoit_coin = 0;
                                   switch($r->coin_currency)
                                   {
                                       case 'eth':
                                        $depsoit_coin = json_decode($content)->data->eth;
                                       break;
                                       case 'btc':
                                        $depsoit_coin = json_decode($content)->data->btc;
                                       break;
                                       case 'usdt':
                                        $depsoit_coin = json_decode($content)->data->TUSD;
                                       break;
                                       case 'lby':
                                       $depsoit_coin = json_decode($content)->data->LBY;
                                       break;
                                       case 'psix':
                                       $depsoit_coin = json_decode($content)->data->PSIX;
                                       break;
                                   }
                                   if ($statusCode == 200) {
                                       $post_params = array(
                                           'user_id' => Auth::user()->id,
                                           'bonus_code' => $r->bonus_code,
                                           'token' => $this->generateReferenceKey(),
                                           'orderID' => json_decode($content)->data->orderID,
                                           'walletAddress' => json_decode($content)->data->walletAddress,
                                           'memo' => ($r->coin_currency=="lby" || $r->coin_currency=="psix") ? json_decode($content)->data->memo:null,
                                           'coin_currency'  => $r->coin_currency,
                                           'currentUSDPrice' => json_decode($content)->data->currentUSDPrice,
                                           'deposit_usd' => strip_tags($r->amount),
                                           'deposit_coin' => $depsoit_coin,
                                           'play6_token' => $r->PlaySix_token2,
                                           'status' => 0,
                                       );
                                       DB::table('coin_payment')->insert($post_params);
                                       return redirect()->back()->with([
                                           'currency_type'         => $r->coin_currency,
                                           'coin_payment' => json_decode($content)->data,
                                           'banking_tab'  => 'deposit_coin'
                                       ]);
                                   }

                               } else {
                                   Toastr::error('Bonus code expired', 'Error');
                                   return redirect()->back()->with('banking_tab','deposit_coin');
                               }
                           } elseif (@$bonus->till) {
                               $data = PropersixBonus::where('type', 'deposit')
                                   ->where('bonus_code', $r->bonus_code)
                                   ->where('status', '1')
                                   ->where('from', '<=', Carbon::today()->toDateString())
                                   ->where('till', '>=', Carbon::today()->toDateString())
                                   ->first();

                               if ($data->count() > 0) {
                                   if (@$data->max_amount > strip_tags($r->amount)) {
                                       Toastr::error('You need to deposit more than ' . $data->max_amount, 'Error');
                                       return redirect()->back()->with('banking_tab','deposit_coin');
                                   }

                                   $check = DB::table('general_settings')->latest()->first();
                                   if ($check->min_deposit > strip_tags($r->amount)) {
                                       Toastr::error("Something went wrong", 'error');
                                       return redirect()->back()->with([
                                           'deposit_error' => "Deposit amount can’t be less than " . $check->min_deposit,
                                           'banking_tab'   => 'deposit_coin'
                                       ]);
                                   }
                                   $response = $client->request('GET', $endpoint, ['query' => [
                                       'symbol' => $r->coin_currency,
                                       'firstName' => Auth::user()->firstname,
                                       'lastName' => Auth::user()->lastName,
                                       'email' => Auth::user()->email,
                                       'usdAmount' => strip_tags($r->amount),
                                       'usdMin' => $check->min_deposit
                                   ]]);
                                   $statusCode = $response->getStatusCode();
                                   $content = $response->getBody();
                                   $depsoit_coin = 0;
                                   switch($r->coin_currency)
                                   {
                                       case 'eth':
                                        $depsoit_coin = json_decode($content)->data->eth;
                                       break;
                                       case 'btc':
                                        $depsoit_coin = json_decode($content)->data->btc;
                                       break;
                                       case 'usdt':
                                        $depsoit_coin = json_decode($content)->data->TUSD;
                                       break;
                                       case 'lby':
                                        $depsoit_coin = json_decode($content)->data->LBY;
                                       break;
                                       case 'psix':
                                       $depsoit_coin = json_decode($content)->data->PSIX;
                                       break;
                                   }
                                   if ($statusCode == 200) {
                                       $post_params = array(
                                           'user_id' => Auth::user()->id,
                                           'bonus_code' => $r->bonus_code,
                                           'token' => $this->generateReferenceKey(),
                                           'orderID' => json_decode($content)->data->orderID,
                                           'walletAddress' => json_decode($content)->data->walletAddress,
                                           'memo' => ($r->coin_currency=="lby" || $r->coin_currency=="psix") ? json_decode($content)->data->memo:null,
                                           'coin_currency'  => $r->coin_currency,
                                           'currentUSDPrice' => json_decode($content)->data->currentUSDPrice,
                                           'deposit_usd' => strip_tags($r->amount),
                                           'deposit_coin' => $depsoit_coin,
                                           'play6_token' => $r->PlaySix_token2,
                                           'status' => 0,
                                       );
                                       DB::table('coin_payment')->insert($post_params);
                                       return redirect()->back()->with([
                                           'currency_type' => $r->coin_currency,
                                           'coin_payment' => json_decode($content)->data,
                                          'banking_tab'   => 'deposit_coin'
                                       ]);
                                   } else {
                                       return redirect()->back()->with([
                                           'message' => 'Something Went Wrong',
                                            'banking_tab' => 'deposit_coin'
                                       ]);
                                   }
//code for coing gate order
                               } else {
                                   Toastr::error('Bonus code expired', 'Error');
                                   return redirect()->back()->with('banking_tab','deposit_coin');
                               }

                           }
                       }

                   } else {
                       Toastr::error('Your country is not eligible for a bonus.', 'Error');
                       return redirect()->back()->with('banking_tab','deposit_coin');
                   }

               } else {
                   Toastr::error('Invalid bonus code.', 'Error');
                   return redirect()->back()->with('banking_tab','deposit_coin');
               }
           }
           else {
               $check = DB::table('general_settings')->latest()->first();
               $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
               if ($check->min_deposit > strip_tags($r->amount) && (($check->min_deposit)*($tok->pley6_token))>($r->PlaySix_token2)) {

                   Toastr::error("Something went wrong", 'error');
                   return redirect()->back()->with([
                       'deposit_error' => "Deposit amount  shouldn't less than " . $check->min_deposit,
                        'banking_tab'  => 'deposit_coin'
                   ]);
               }
               $response = $client->request('GET', $endpoint, ['query' => [
                   'symbol' => $r->coin_currency,
                   'firstName' => Auth::user()->firstname,
                   'lastName' => Auth::user()->lastName,
                   'email' => Auth::user()->email,
                   'usdAmount' => strip_tags($r->amount),
                   'usdMin' => $check->min_deposit
               ]]);
               $statusCode = $response->getStatusCode();
               $content = $response->getBody();
               $depsoit_coin = 0;
               switch($r->coin_currency)
               {
                   case 'eth':
                    $depsoit_coin = json_decode($content)->data->eth;
                   break;
                   case 'btc':
                    $depsoit_coin = json_decode($content)->data->btc;
                   break;
                   case 'usdt':
                    $depsoit_coin = json_decode($content)->data->TUSD;
                   break;
                   case 'lby':
                    $depsoit_coin = json_decode($content)->data->LBY;
                   break;
                   case 'psix':
                 $depsoit_coin = json_decode($content)->data->PSIX;
                   break;
               }
               if ($statusCode == 200) {
                   $post_params = array(
                       'user_id' => Auth::user()->id,
                       'bonus_code' => $r->bonus_code,
                       'token' => $this->generateReferenceKey(),
                       'orderID' => json_decode($content)->data->orderID,
                       'walletAddress' => json_decode($content)->data->walletAddress,
                       'memo' => ($r->coin_currency=="lby" || $r->coin_currency=="psix") ? json_decode($content)->data->memo:null,
                       'coin_currency'  => $r->coin_currency,
                       'currentUSDPrice' => json_decode($content)->data->currentUSDPrice,
                       'deposit_usd' => strip_tags($r->amount),
                       'deposit_coin' =>  $depsoit_coin,
                       'play6_token' => $r->PlaySix_token2,
                       'status' => 0,
                   );
                   DB::table('coin_payment')->insert($post_params);
                   return redirect()->back()->with([
                       'currency_type' => $r->coin_currency,
                       'coin_payment' => json_decode($content)->data,
                      'banking_tab'   => 'deposit_coin'
                   ]);
               } else {
                   return redirect()->back()->with([
                       'message' => 'Something Went Wrong',
                       'banking_tab' => 'deposit_coin'
                   ]);
               }

           }
       } catch (\Exception $e) {
        Toastr::warning('Payment service provider not responding. Please try again later ', 'Warning');
        return redirect()->back()->with('banking_tab','deposit_coin');
        }
    }
    function paymentDeposit_axcess(Request $r)
    {

        $validator           = Validator::make($r->all(), [
            'axcess_usd' =>'required|numeric|min:1',
        ]);

        if ($validator->fails())
        {
            Toastr::error("Enter valid amount");
            return redirect()->back()->with('banking_tab','deposit_axcess');
        }
        if ($r->axcess_currency=="USD")
        {
            $merchantID            = '131582';
            $currencyCode          = '840';
        }
        else if ($r->axcess_currency=="EUR")
        {
            $merchantID            = '131581';
            $currencyCode          = '978';
        }
        try {
        if (@$r->bonus_code) {
            $checkifbonuscodeused = \App\CoinGate::where('bonus_code', $r->bonus_code)->where('user_id', Auth::id())->where('status', 'paid')
                ->first();
            if ($checkifbonuscodeused) {
                Toastr::error('This Bonus code has already been used.', 'Error');
                return redirect()->back()->with('banking_tab','deposit_axcess');
            }
            $bonus = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('status', 1)->first();
            if (@$bonus->users) {
                if (@UserCheck($r->bonus_code) <= 0) {
                    Toastr::error('You are not eligible for a bonus.', 'Error');
                    return redirect()->back()->with('banking_tab','deposit_axcess');
                }
            }
            if (!is_null(@$bonus)) {
                if ($bonus->wagering_req != 0 || $bonus->wagering_req != '') {
                    if ($bonus->specific_day) {
                        $bonusdateforchecking = date('Y-m-d', strtotime($bonus->specific_day));
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id', Auth::id())
                            ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                            ->where('spin_type', 'paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousDate = date('Y-m-d', strtotime($bonus->specific_day));
                        $currentDate = date('Y-m-d', time());
                        if ($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount) {

                        } else {
                            Toastr::error('Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this Bonus.This code is Valid for only 24 hours', 'Error');
                            // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for only 24 hours'], 200);
                            return redirect()->back()->with('banking_tab','deposit_axcess');
                        }
                    }
                    if ($bonus->till) {
                        $bonusdateforcheckingfrom = date('Y-m-d 00:00:00', strtotime($bonus->from));
                        $bonusdateforcheckingtill = date('Y-m-d 23:59:59', strtotime($bonus->till));
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id', Auth::id())
                            ->where(DB::raw('date(created_at)'), '>=', $bonusdateforcheckingfrom)
                            ->where(DB::raw('date(created_at)'), '<=', $bonusdateforcheckingtill)
                            ->where('spin_type', 'paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousfrom = strtotime($bonus->from);
                        $bnoustill = strtotime(date('Y-m-d 23:59:59', strtotime($bonus->till)));
                        $currentDate = time();
                        if ($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $bonus->wagering_req <= $userspending->wageredamount) {

                        } else {
                            Toastr::error('Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this bonus.This code is valid between ' . $bonus->from . ' and ' . date('Y-m-d 23:59:59', strtotime($bonus->till)), 'Error');
                            // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )], 200);
                            return redirect()->back()->with('banking_tab','deposit_axcess');
                        }
                    }
                }
                if (@$bonus->ex_country || true) {
                    $data = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('ex_country', 'like', '%' . Auth::user()->profile->country . '%')->get();
                    if (@$data->count() > 0) {
                        return response()->json(['error' => 'Your country is not eligible for a bonus.'], 200);
                        Toastr::error('Your country is not eligible for a bonus.', 'Error');
                        return redirect()->back()->with('banking_tab','deposit_axcess');
                    } else {
                        $b_c = Bonus::where('add_bonus_id', @$bonus->id)->where('user_id', Auth::id())->first();
                        if (!is_null($b_c)) {
                            Toastr::error('Invalid bonus code.', 'Error');
                            return redirect()->back()->with('banking_tab','deposit_axcess');
                        }
                        if (@$bonus->specific_day) {
                            $data = PropersixBonus::where('type', 'deposit')->where('bonus_code', $r->bonus_code)->where('specific_day', '=', Carbon::today()->toDateString())->first();
                            if (isset($data)) {
                                if (@$data->max_amount > $r->deposit_usd) {
                                    Toastr::error('You need to deposit more than ' . $data->max_amount, 'Error');
                                    return redirect()->back()->with('banking_tab','deposit_axcess');
                                }
                                //code for coingate order
//                                CoinGate::config(array(
//                                    'environment'               => 'sandbox', // sandbox OR live
//                                    'auth_token'                => 'mQen7L9TzjfxpEPj2HP3buZeRA32NZ1YasGzRkMx',
//                                    'curlopt_ssl_verifypeer'    => TRUE // default is false
//                                ));
                                $check = DB::table('general_settings')->latest()->first();
                                if ($check->min_deposit > strip_tags($r->axcess_usd)) {
                                    Toastr::error("Deposit amount can’t be less than " . $check->min_deposit, 'error');
                                    return redirect()->back()->with([
                                        'deposit_error' => "Deposit amount can’t be less than " . $check->min_deposit,
                                        'banking_tab'  => 'deposit_axcess'
                                        ]);
                                }
                                $post_params = array(
                                    'user_id' => Auth::user()->id,
                                    'bonus_code' => $r->bonus_code,
                                    'token' => $this->generateReferenceKey('axcess_payment'),
                                    'currency'  => $r->axcess_currency,
                                    'deposit_amount' => strip_tags($r->axcess_usd),
                                    'play6_token' => round($r->axcess_playsix),
                                    'status' => 0,
                                );
                                DB::table('axcess_payment')->insert($post_params);
                                $axcess_payment           = \App\AxcessPayment::orderBy('id','desc')->first();
                                if ($r->axcess_currency!="USD")
                                {
                                    $base_rate             = CurrencyBaseRate::where('user_id',Auth::user()->id)
                                                                             ->where('status',0)
                                                                             ->orderBy('id','desc')->first();
                                    $base_rate->ref_key    = $axcess_payment->token;
                                    $base_rate->status     = 1;
                                    $base_rate->save();
                                }
                                return view('frontend.casino_user.axcess_payment',[
                                    'axcessPaymentModal' => 'gh',
                                    'merchant_id'        => $merchantID,
                                    'currency_code'      => $currencyCode,
                                    'axcessRefkey'       => $axcess_payment->token,
                                    'axcessAmount'       => $axcess_payment->deposit_amount
                                ]);
//                                return redirect()->back()->with([
//                                    'axcessPaymentModal' => 'gh',
//                                    'merchant_id'        => $merchantID,
//                                    'currency_code'      => $currencyCode,
//                                    'axcessRefkey'       => $axcess_payment->token,
//                                    'axcessAmount'       => $axcess_payment->deposit_amount
//                                ]);
                            } else {
                                Toastr::error('Bonus code expired', 'Error');
                                return redirect()->back()->with('banking_tab','deposit_axcess');
                            }
                        } elseif (@$bonus->till) {
                            $data = PropersixBonus::where('type', 'deposit')
                                ->where('bonus_code', $r->bonus_code)
                                ->where('status', '1')
                                ->where('from', '<=', Carbon::today()->toDateString())
                                ->where('till', '>=', Carbon::today()->toDateString())
                                ->first();

                            if ($data->count() > 0) {
                                if (@$data->max_amount > strip_tags($r->axcess_usd)) {
                                    Toastr::error('You need to deposit more than ' . $data->max_amount, 'Error');
                                    return redirect()->back()->with('banking_tab','deposit_axcess');
                                }

                                $check = DB::table('general_settings')->latest()->first();
                                if ($check->min_deposit > strip_tags($r->axcess_usd)) {
                                    Toastr::error("Something went wrong", 'error');
                                    return redirect()->back()->with([
                                        'deposit_error' => "Deposit amount can’t be less than " . $check->min_deposit,
                                        'banking_tab'   => 'deposit_axcess'
                                        ]);
                                }
                                $post_params = array(
                                    'user_id' => Auth::user()->id,
                                    'bonus_code' => $r->bonus_code,
                                    'token' => $this->generateReferenceKey('axcess_payment'),
                                    'currency'  => $r->axcess_currency,
                                    'deposit_amount' => strip_tags($r->axcess_usd),
                                    'play6_token' => round($r->axcess_playsix),
                                    'status' => 0,
                                );
                                DB::table('axcess_payment')->insert($post_params);
                                $axcess_payment           = \App\AxcessPayment::orderBy('id','desc')->first();
                                if ($r->axcess_currency!="USD")
                                {
                                    $base_rate             = CurrencyBaseRate::where('user_id',Auth::user()->id)
                                                                              ->where('status',0)
                                                                              ->orderBy('id','desc')->first();
                                    $base_rate->ref_key    = $axcess_payment->token;
                                    $base_rate->status     = 1;
                                    $base_rate->save();
                                }
                                return view('frontend.casino_user.axcess_payment',[
                                    'axcessPaymentModal' => 'gh',
                                    'merchant_id'        => $merchantID,
                                    'currency_code'      => $currencyCode,
                                    'axcessRefkey'       => $axcess_payment->token,
                                    'axcessAmount'       => $axcess_payment->deposit_amount
                                ]);
//                                return redirect()->back()->with([
//                                    'axcessPaymentModal' => 'gh',
//                                    'merchant_id'        => $merchantID,
//                                    'currency_code'      => $currencyCode,
//                                    'axcessRefkey'       => $axcess_payment->token,
//                                    'axcessAmount'       => $axcess_payment->deposit_amount
//                                ]);
//code for coing gate order
                            } else {
                                Toastr::error('Bonus code expired', 'Error');
                                return redirect()->back()->with('banking_tab','deposit_axcess');
                            }

                        }
                    }

                } else {
                    Toastr::error('Your country is not eligible for a bonus.', 'Error');
                    return redirect()->back()->with('banking_tab','deposit_axcess');
                }

            } else {
                Toastr::error('Invalid bonus code.', 'Error');
                return redirect()->back()->with('banking_tab','deposit_axcess');
            }
        }
        else {

            $check = DB::table('general_settings')->latest()->first();
            $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
            if ($check->min_deposit > strip_tags($r->axcess_usd) && (($check->min_deposit)*($tok->pley6_token))>($r->PlaySix_token2)) {

                Toastr::error("Something went wrong", 'error');
                return redirect()->back()->with([
                    'deposit_error' => "Deposit amount  shouldn't less than " . $check->min_deposit,
                    'banking_tab' => 'deposit_axcess'
                    ]);
            }
            $post_params = array(
                'user_id' => Auth::user()->id,
                'bonus_code' => $r->bonus_code,
                'token' => $this->generateReferenceKey('axcess_payment'),
                'currency'  => $r->axcess_currency,
                'deposit_amount' => strip_tags($r->axcess_usd),
                'play6_token' => round($r->axcess_playsix),
                'status' => 0,
            );
            DB::table('axcess_payment')->insert($post_params);
            $axcess_payment           = \App\AxcessPayment::orderBy('id','desc')->first();
            if ($r->axcess_currency!="USD")
            {
                $base_rate             = CurrencyBaseRate::where('user_id',Auth::user()->id)
                                                        ->orderBy('id','desc')->first();
                $base_rate->ref_key    = $axcess_payment->token;
                $base_rate->status     = 1;
                $base_rate->save();
            }
            return view('frontend.casino_user.axcess_payment',[
                'axcessPaymentModal' => 'gh',
                'merchant_id'        => $merchantID,
                'currency_code'      => $currencyCode,
                'axcessRefkey'       => $axcess_payment->token,
                'axcessAmount'       => $axcess_payment->deposit_amount
            ]);
//            return redirect()->back()->with([
//                'axcessPaymentModal' => 'gh',
//                'merchant_id'        => $merchantID,
//                'currency_code'      => $currencyCode,
//                'axcessRefkey'       => $axcess_payment->token,
//                'axcessAmount'       => $axcess_payment->deposit_amount
//            ]);

//code for axcess payment gateway
        }
        } catch (\Exception $e) {
            Toastr::warning('Payment service provider not responding. Please try again later ', 'Warning');
            return redirect()->back()->with('banking_tab','deposit_axcess');
        }
    }
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
        return DB::table('coin_payment')->where('token',$number)->exists();
    }
  function paymentWithdraw(Request $r){
//      $this->update_pro_session(Auth::user()->id,$r);

      $validator           = Validator::make($r->all(), [
          'amount' =>'required|numeric|min:1',
      ]);
      if ($validator->fails())
      {
          Toastr::error("Enter valid amount");
          if ($r->payment_mathod_type==1)
          return redirect()->back()->with('banking_tab','withdraw_crypto');
          else
              return redirect()->back()->with('banking_tab','withdraw_bank');
      }
      if (Auth::user()->verified==1)
      {
          if (strip_tags($r->popup_status)==1)
          {
              //bonus code wager check
              $user_codebonus = DB::table('bonuses')
                  ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
                  ->select('amount','add_bonus_id','status','bonuses.created_at as creationdate')
                  ->where('user_id',Auth::user()->id)
                  ->where('bonuses.type','code')
                  ->orderBy('bonuses.created_at','desc')
                  ->first();
              if ($user_codebonus)
              {
                  $totalwageredamount = DB::table('game_session_childs')
                      ->select( DB::raw('SUM(bet_size*payline) as wageredamount'))
                      ->where('user_id',Auth::user()->id)
                      ->where('spin_type','paid')
                      ->where('created_at','>=',$user_codebonus->creationdate)
                      ->first();
                  if ($totalwageredamount->wageredamount < ($user_codebonus->amount*35))
                  {
                      Toastr::warning("You have not completed 35x (".($user_codebonus->amount*35)." tokens)  wagering requirement set for the applied Bonus code.");
                      if ($r->payment_mathod_type==1)
                          return redirect()->back()->with('banking_tab','withdraw_crypto');
                      else
                          return redirect()->back()->with('banking_tab','withdraw_bank');
                  }
              }

              //boonus code wager check
              $checkreg=$this->checkifusergotregbonus();
              if($checkreg==1)
              {
                  $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
                  $totaltokenwon = DB::table('game_session_childs')
                      ->select( DB::raw('SUM(amount_won) as amount_won'))
                      ->where('user_id',Auth::user()->id)
                      ->where('status','won')
                      ->first();
                  if ($totaltokenwon->amount_won>0)
                  {
                      $totaltokenwon=$totaltokenwon->amount_won;
                      $usdwon=$totaltokenwon/$tok->pley6_token;
                  }
                  else
                  {
                      $totaltokenwon=0;
                      $usdwon=0;
                  }
                  $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
                  $userWallet->free_token=0;
                  $userWallet->free_spin=0;
                  $userWallet->token=$userWallet->token-$totaltokenwon;
                  $userWallet->usd=$userWallet->usd-$usdwon;
                  $userWallet->save();
              }
          }
          DB::beginTransaction();
          if ($r->payment_mathod_type==1) {
              $validator           = Validator::make($r->all(), [
                  'wallet_address' => 'required'
              ]);
              if ($validator->fails())
              {
                  Toastr::error("Enter wallet address");
                      return redirect()->back()->with('banking_tab','withdraw_crypto');
              }
          }
          try {
              $deposit = Deposit::where('user_id',Auth::user()->id)->latest('created_at')->first();
              if ($deposit!=null) {
                  $gameSessionChild = \App\GameSessionChild::where('user_id', Auth::user()->id)->latest('created_at')->first();
                  if ($gameSessionChild) {
                      $sessionTime = strtotime($gameSessionChild->created_at);
                      $curTime = time();
                      if (($curTime - $sessionTime) <= (60 * 5)) {
                          Toastr::warning('You can not withdraw while playing a game. To withdraw, close the game and wait 5 minutes.');
                          if ($r->payment_mathod_type==1)
                              return redirect()->back()->with('banking_tab','withdraw_crypto');
                          else
                              return redirect()->back()->with('banking_tab','withdraw_bank');
                      }
                  }
                  $doc = UserDocuments::where('user_id', Auth::user()->id)->where('status', 2)->first();
                  if ($doc) {
                      $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
                      if ($userWallet->token < strip_tags($r->amount)) {
                          Toastr::warning('Can’t withdraw due to insufficient funds.');
                          if ($r->payment_mathod_type==1)
                              return redirect()->back()->with('banking_tab','withdraw_crypto');
                          else
                              return redirect()->back()->with('banking_tab','withdraw_bank');
                      }
                      $data = new Withdraw();
                      $data->user_id = Auth::user()->id;
                      $data->first_name = strip_tags($r->first_name);
                      $data->last_name = strip_tags($r->last_name);
                      $data->w_country = strip_tags($r->w_country);
                      $data->w_state = strip_tags($r->w_state);
                      $data->zipcode = strip_tags($r->zipcode);
                      $data->Address = strip_tags($r->Address);
                      $data->w_currency = strip_tags($r->withdraw_currency);
                      $data->amount = strip_tags($r->amount);
                      $data->payment_mathod_type = strip_tags($r->payment_mathod_type);
                      $data->w_bank_name = strip_tags($r->w_bank_name);

//                      $data->w_account_number = strip_tags($r->w_account_number);

                      if (strip_tags($r->swift)) {
                          $data->SWIFT = strip_tags($r->swift);
                      }
                      if ($r->ibpn) {
                          $data->IBAN = strip_tags($r->ibpn);
                      }
                      $data->wallet_address   = strip_tags($r->wallet_address);
                      $data->save();

                      $tran_Type = new TransactionType();
                      $tran_Type->type = 'withdraw';
                      $tran_Type->created_by = Auth::id();
                      $tran_Type->save();

                      $transaction = new ProsixTransaction();
                      $transaction->user_id = Auth::user()->id;
                      $transaction->amount = strip_tags($r->amount);
                      $transaction->currency = 'pley6_token';
                      $transaction->from = 'casino';
                      $transaction->type = $tran_Type->id;
                      $transaction->to = Auth::user()->user_name;
                      $transaction->created_by = Auth::id();
                      $transaction->save();

                      $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();

                      $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => Auth::id()]);
                      $userWallet->token = $userWallet->token - strip_tags($r->amount);
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
                      if ($r->payment_mathod_type==1)
                          return redirect()->back()->with('banking_tab','withdraw_crypto');
                      else
                          return redirect()->back()->with('banking_tab','withdraw_bank');

                  }
                  else
                  {
                      Toastr::warning('Your document is not verified yet.');
                      if ($r->payment_mathod_type==1)
                          return redirect()->back()->with('banking_tab','withdraw_crypto');
                      else                          return redirect()->back()->with('banking_tab','withdraw_bank');
                  }
              }
              else{
                  Toastr::warning('You did not deposit any amount yet!');
                  if ($r->payment_mathod_type==1)
                      return redirect()->back()->with('banking_tab','withdraw_crypto');
                  else
                      return redirect()->back()->with('banking_tab','withdraw_bank');
              }
          } catch (\Exception $e) {

              Toastr::error($e->getMessage(),'Error');
              if ($r->payment_mathod_type==1)
                  return redirect()->back()->with('banking_tab','withdraw_crypto');
              else
                  return redirect()->back()->with('banking_tab','withdraw_bank');
          }
      }
      else
      {
          app(VerificationController::class)->email_verification();
          Toastr::error('Email not verified please check your mail box to verify your email');
          if ($r->payment_mathod_type==1)
              return redirect()->back()->with('banking_tab','withdraw_crypto');
          else
              return redirect()->back()->with('banking_tab','withdraw_bank');
      }

    }

    public function checkifusergotregbonus()
    {
        $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
        $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
        $userDeposites = DB::table('deposits')->where('user_id', Auth::user()->id)->sum('amount');
        $usertokens=$userWallet->token;
        $userdeposit_tokens=$userDeposites*$tok->pley6_token;

        //checking for bonus code wager requirement
        $user_codebonus = DB::table('bonuses')
            ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
            ->select('amount','add_bonus_id','status','bonuses.created_at as creationdate')
            ->where('user_id',Auth::user()->id)
            ->where('bonuses.type','code')
            ->orderBy('bonuses.created_at','desc')
            ->first();

        if ($user_codebonus)
        {
            $totalwageredamount = DB::table('game_session_childs')
                ->select( DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id',Auth::user()->id)
                ->where('spin_type','paid')
                ->where('created_at','>=',$user_codebonus->creationdate)
                ->first();
            if ($totalwageredamount->wageredamount < ($user_codebonus->amount*35))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
        //bonus code wager req check end

        //checking wagering requirement for registration bonus on withdrawl
        $user_registrationbonus = DB::table('bonuses')
            ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
            ->select('bonuses.amount','bonuses.add_bonus_id','propersix_bonuses.status')
            ->where('bonuses.user_id',Auth::user()->id)
            ->where('bonuses.type','registration_bonus')
            ->first();
        if ($user_registrationbonus)
        {
            if ($user_registrationbonus->status=='1')
            {
            if ($usertokens<$userdeposit_tokens)
            {
                return 0;
            }
            $totalwageredamount = DB::table('game_session_childs')
                ->select( DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id',Auth::user()->id)
                ->where('spin_type','paid')
                ->first();
            if ($totalwageredamount)
            {
                if ($totalwageredamount->wageredamount < ($user_registrationbonus->amount*35))
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
        //reg bonus checking end
    }
    function update_pro_session($userId,$request)
    {

        $data                   = ProsixWallet::where('user_id',$userId)
            ->latest()
            ->first();
        $request->session()->put('proSix_walletData',$data);
    }
    public function key($amount)
    {
        $check = DB::table('general_settings')->latest()->first();
        if($check->min_deposit>$amount)
        {
            return response()->json([
                'type' => 'error',
                'message' => "Deposit amount should not be less than ".$check->min_deposit
            ]);
        }
        else{
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount*100,
                'currency' => 'USD',
                // Verify your integration in this guide by including this parameter
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
            return response()->json([
                'type'      => 'success',
                'message'   => $intent
            ]);
    }

    }
    public function payment_settings(Request $r)
    {
        $tok      = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $check    = DB::table('general_settings')->latest()->first();
        if($check->min_deposit>((strip_tags($r->tokens))/$tok->pley6_token))
        {
       return response()->json([
                'type' => 'error',
                'message' => "Tokens should not be less than ".($check->min_deposit)*($tok->pley6_token)
            ]);
        }

        if (strip_tags(@$r->bonus_code)) {
            $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',strip_tags($r->bonus_code))->where('status',1)->first();
            if (@$bonus->users) {
                if (@UserCheck($r->bonus_code) <= 0) {
                    return response()->json([
                        'type' => 'error',
                        'message' => "You are not eligible for a bonus."
                    ]);
                }
            }
            if (!is_null(@$bonus)) {
                if ($bonus->wagering_req != 0 || $bonus->wagering_req != '')
                {
                    if ($bonus->specific_day) {
                        $bonusdateforchecking = date('Y-m-d' , strtotime($bonus->specific_day));
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id',Auth::id())
                            ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                            ->where('spin_type','paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousDate = date('Y-m-d' , strtotime($bonus->specific_day));
                        $currentDate = date('Y-m-d',time());
                        if($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount){

                        }
                        else{
                            return response()->json([
                                'type' => 'error',
                                'message' => "Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this Bonus.This code is Valid for only 24 hours"
                            ]);
                        }
                    }
                    if ($bonus->till) {
                        $bonusdateforcheckingfrom = date('Y-m-d 00:00:00' , strtotime($bonus->from));
                        $bonusdateforcheckingtill = date('Y-m-d 23:59:59',strtotime($bonus->till) );
                        $userspending = DB::table('game_session_childs')
                            ->select(DB::raw('date(created_at)'),DB::raw('date(created_at)'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                            ->where('user_id',Auth::id())
                            ->where(DB::raw('date(created_at)'),'>=',$bonusdateforcheckingfrom)
                            ->where(DB::raw('date(created_at)'),'<=',$bonusdateforcheckingtill)
                            ->where('spin_type','paid')
                            ->groupBy('game_id')
                            ->first();
                        $bnousfrom = strtotime($bonus->from);
                        $bnoustill = strtotime( date('Y-m-d 23:59:59',strtotime($bonus->till) ) );
                        $currentDate = time();
                        if($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $bonus->wagering_req <= $userspending->wageredamount){

                        }
                        else{
//                                Toastr::error('Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) ),'Error');
//                                // return response()->json(['error'=>'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )], 200);
//                                return redirect()->back();
                            return response()->json([
                                'type' => 'error',
                                'message' => 'Your current wagered amount '.$userspending->wageredamount.'  has to be greater than '.$bonus->wagering_req.' tokens to get this bonus.This code is valid between '.$bonus->from.' and '.date('Y-m-d 23:59:59',strtotime($bonus->till) )
                            ]);
                        }
                    }
                }
                if (@$bonus->ex_country || true) {
                    $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('ex_country','like', '%'.Auth::user()->profile->country.'%')->get();
                    if (@$data->count() > 0) {
                        return response()->json([
                            'type' => 'error',
                            'message' => 'Your country is not eligible for a bonus.'
                        ]);
                    }
                    else {
                        $b_c = Bonus::where('add_bonus_id',@$bonus->id)->where('user_id' , Auth::id() )->first();
                        if (!is_null($b_c)) {
                            return response()->json([
                                'type' => 'error',
                                'message' => 'Invalid bonus code.'
                            ]);
                        }
                        if (@$bonus->specific_day) {
                            $data = PropersixBonus::where('type','deposit')->where('bonus_code',$r->bonus_code)->where('specific_day','=',Carbon::today()->toDateString())->first();
                            if (isset($data)) {
                                if (@$data->bonus_amount) {
                                    $bonus_amount = $data->bonus_amount;
                                }
                                else if (@$data->max_amount > $r->amount) {
                                    return response()->json([
                                        'type' => 'error',
                                        'message' => 'You need to deposit more than '.$data->max_amount
                                    ]);
                                }
                                else {
                                    $bonus_amount =$tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                    if ($bonus_amount<=10000)
                                    {
                                        $bonus_amount=$bonus_amount;
                                    }
                                    else
                                    {
                                        $bonus_amount=10000;
                                    }
                                }

                            }
                            else {
                                return response()->json([
                                    'type' => 'error',
                                    'message' => 'Bonus code expired'
                                ]);
                            }
                        }
                        elseif (@$bonus->till)
                        {
                            $data = PropersixBonus::where('type','deposit')
                                ->where('bonus_code',$r->bonus_code)
                                ->where('status','1')
                                ->where('from', '<=', Carbon::today()->toDateString())
                                ->where('till', '>=', Carbon::today()->toDateString())
                                ->first();

                            if ($data->count() > 0) {
                                if (@$data->bonus_amount) {
                                    $bonus_amount = $data->bonus_amount;
                                }
                                else if (@$data->max_amount > $r->amount) {
                                    return response()->json([
                                        'type' => 'You need to deposit more than '.$data->max_amount,
                                        'message' => 'Bonus code expired'
                                    ]);
                                }
                                else {
                                    $bonus_amount = $tok->pley6_token * ($r->amount * ($data->percent_amount/100));
                                    if ($bonus_amount<=10000)
                                    {
                                        $bonus_amount=$bonus_amount;
                                    }
                                    else
                                    {
                                        $bonus_amount=10000;
                                    }
                                }

                            }
                            else {
                                return response()->json([
                                    'type' => 'error',
                                    'message' => 'Bonus code expired'
                                ]);
                            }

                        }
                    }

                }
                else {
                    return response()->json([
                        'type' => 'error',
                        'message' => 'Your country is not eligible for a bonus.'
                    ]);
                }

            }
            else {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Invalid bonus code.'
                ]);
            }
        }
        else{
            $bonus_amount = 0;
        }
        $rows                = DB::table('stripe_payment_settings')->insert([
           'user_id'         => Auth::user()->id,
           'payment_key'     => $this->generatePaymentKey(),
            'bonus_code'     => strip_tags($r->bonus_code),
            'bonus_amount'   => strip_tags($bonus_amount)
        ]);
        if ($rows)
        {
            return response()->json([
                'type' => 'success',
                'message' => DB::table('stripe_payment_settings')
                                 ->where('user_id',Auth::user()->id)
                                 ->latest()->first()
            ]);
        }
        else
        {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps!! someting went wrong'
            ]);
        }
    }
    // generating unique payment key
    function generatePaymentKey() {
        $number = str_random(10); // better than rand()

        // call the same function if the barcode exists already
        if ($this->keyExists($number)) {
            return $this->generatePaymentKey();
        }

        // otherwise, it's valid and can be used
        return $number;
    }
    function keyExists($number) {
        return DB::table('stripe_payment_settings')->where('payment_key',$number)->exists();
    }
}
