<?php

namespace App\Http\Controllers\api;

use App\AxcessPayment;
use App\CoinPayment;
use App\CurrencyBaseRate;
use App\Deposit;
use App\PropersixBonus;
use App\ProsixUserWallet;
use App\ProsixWallet;
use App\ProsixWalletType;
use App\PushNotifications;
use App\TokenCurrency;
use App\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentCallbackController extends Controller
{   public function test(Request $request)
    {
        $result              = $request;
        if (isset($result->amount)) {
            DB::table('coin_payment')
                ->where('orderID', $result->orderID)
                ->update([
                    //'response'     => \Opis\Closure\serialize($result),
                    'coin_amount'  => $result->amount,
                    'dollar_amount' => $result->depositUSD,
                    'status'        => 1
                ]);
            \Log::info("LBY callback url done");
            \Log::info("LBY record saving start");
            $order =  CoinPayment::where('orderID',$result->orderID)->first();
            $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                    if ($bonus_amount<=10000)
                    {
                        $bonus_amount=$bonus_amount;
                    }
                    else
                    {
                        $bonus_amount=10000;
                    }
                }
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'LBY';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request  = $order;
                $log      =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                //saving data into bonuses table and checking if user has already availed the bonus
                $bonusadd=new \App\Bonus;
                $bonusadd->user_id =  $order->user_id;
                $bonusadd->add_bonus_id =  $bonus->id;
                $bonusadd->amount= $bonus_amount;
                $bonusadd->spin = $bonus->free_spin;
                $bonusadd->betsize = $bonus->bet_size;
                $bonusadd->line = $bonus->lines;
                $bonusadd->type = 'bonus_code';
                $bonusadd->from='casino';
                $bonusadd->to= $profile->username;
                $bonusadd->save();

                // notification
                $notification=new \App\Notification;
                $notification->user_id = $order->user_id;
                $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                $wallet->user_id = $order->user_id;
                if ($bonus->percent_amount != '')
                {
                    $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                    $wallet->amount = $bonus->bonus_amount;
                }
                $wallet->type_id =  $wallet_type->id;
                $wallet->created_by=$order->user_id;
                $wallet->bonus_id=$bonus->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->free_token+= $wallet->amount;
                $userWallet->free_spin+= $bonus->free_spin;
                $userWallet->usd+= (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'LBY';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            \Log::info("LBY record saving end");
            $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' USDT ('.$order->dollar_amount.'$) has been completed successfully');
            // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
            return "done";
        }
    }
    public function ethereum_callback(Request $request)
    {

        \Log::info("callback url start");
        $secret_key                   =  "0x8d68be3308013a75925398918ca4c2cc2fc69c46d56b185607eb17a2c33f6c74";
        $aes_key                      = "0x21c3fcc8a1144ef051dcddc90dc400cc31dee5e33972fbfbe3d6f9cbd47efe56";
        $header_token                 =  $request->header('Authorization');
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$aes_key));
        DB::table('coin_payment')
            ->where('orderID', $result->orderID)
            ->update([
                'response'     => \Opis\Closure\serialize($result),
                'coin_amount'  => $result->amount,
                'dollar_amount' => $result->depositUSD,
                'status'        => 1
            ]);
        \Log::info("callback url done");
        \Log::info("record saving start");
        $order =  CoinPayment::where('orderID',$result->orderID)->first();
        $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        if (@$order->bonus_code) {
            $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
            if (@$bonus->bonus_amount) {
                $bonus_amount = $bonus->bonus_amount;
            }
            else {
                $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                if ($bonus_amount<=10000)
                {
                    $bonus_amount=$bonus_amount;
                }
                else
                {
                    $bonus_amount=10000;
                }
            }
            $deposit = new Deposit();
            $deposit->user_id = $order->user_id;
            $deposit->amount = $order->dollar_amount;
            $deposit->charge_id = $order->orderID;
            $deposit->to = 'casino';
            $deposit->type = 'ETH';
            $deposit->from = $profile->username;
            $deposit->save();

            transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

            $user_id  = $order->user_id;
            $logModel = $deposit;
            $request  = $order;
            $log      =  $deposit->type;
            logCreatedActivity($user_id,$logModel,$request,$log);

            $notification=new \App\Notification;
            $notification->user_id=$order->user_id;
            $notification->message=getTranslated('deposit_success').$order->dollar_amount;
            $notification->save();

            //saving data into bonuses table and checking if user has already availed the bonus
            $bonusadd=new \App\Bonus;
            $bonusadd->user_id =  $order->user_id;
            $bonusadd->add_bonus_id =  $bonus->id;
            $bonusadd->amount= $bonus_amount;
            $bonusadd->spin = $bonus->free_spin;
            $bonusadd->betsize = $bonus->bet_size;
            $bonusadd->line = $bonus->lines;
            $bonusadd->type = 'bonus_code';
            $bonusadd->from='casino';
            $bonusadd->to= $profile->username;
            $bonusadd->save();

            // notification
            $notification=new \App\Notification;
            $notification->user_id = $order->user_id;
            $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
            $wallet->user_id = $order->user_id;
            if ($bonus->percent_amount != '')
            {
                $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                $wallet->amount = $bonus->bonus_amount;
            }
            $wallet->type_id =  $wallet_type->id;
            $wallet->created_by=$order->user_id;
            $wallet->bonus_id=$bonus->id;
            $wallet->save();
            // updating prosix_user_wallet table lobby main table for user wallet
            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
            $userWallet->free_token+= $wallet->amount;
            $userWallet->free_spin+= $bonus->free_spin;
            $userWallet->usd+= (float)@$order->dollar_amount;
            $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
            $userWallet->type_id=$wallet_type->id;
            $userWallet->save();

            $transaction =new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->transaction_id = $deposit->id;
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            $transaction->amount = $order->dollar_amount*$tok->pley6_token;
            $transaction->from = $profile->username;
            $transaction->to ='casino';
            $transaction->type = 'deposit';
            $transaction->usd = $order->dollar_amount;
            $transaction->currency = 'usd';
            $transaction->save();

        }
        else
        {
            $deposit = new Deposit();
            $deposit->user_id = $order->user_id;
            $deposit->amount = $order->dollar_amount;
            $deposit->charge_id = $order->orderID;
            $deposit->to = 'casino';
            $deposit->type = 'ETH';
            $deposit->from = $profile->username;
            $deposit->save();

            transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

            $user_id  = $order->user_id;
            $logModel = $deposit;
            $request = $order;
            $log =  $deposit->type;
            logCreatedActivity($user_id,$logModel,$request,$log);

            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
            $userWallet->usd +=  (float)@$order->dollar_amount;
            $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
            $userWallet->save();

            /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
            $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
            $AdminWallet->save();*/

            $notification=new \App\Notification;
            $notification->user_id=$order->user_id;
            $notification->message=getTranslated('deposit_success').$order->dollar_amount;
            $notification->save();

            $transaction =new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->transaction_id = $deposit->id;
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            $transaction->amount = $order->dollar_amount*$tok->pley6_token;
            $transaction->from = $profile->username;
            $transaction->to ='casino';
            $transaction->type = 'deposit';
            $transaction->usd = $order->dollar_amount;
            $transaction->currency = 'usd';
            $transaction->save();

        }
        \Log::info("record saving end");
        $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' ETH ('.$order->dollar_amount.'$) has been completed successfully');
        // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
        return "done";
    }
    public function btc_callback(Request $request)
    {

        \Log::info("callback url start with updated code");
        $secret_key                   = "0x8d68be3308013a75925398918ca4c2cc2fc69c46d56b185607eb17a2c33f6c74";
        $aes_key                      = "0x21c3fcc8a1144ef051dcddc90dc400cc31dee5e33972fbfbe3d6f9cbd47efe56";
        $header_token                 =  $request->header('Authorization');
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$aes_key));
        if (isset($result->amount)) {
            DB::table('coin_payment')
                ->where('orderID', $result->orderID)
                ->update([
                    'response'     => \Opis\Closure\serialize($result),
                    'coin_amount'  => $result->amount,
                    'dollar_amount' => $result->depositUSD,
                    'status'        => 1
                ]);
            \Log::info("callback url done");
            \Log::info("record saving start");
            $order =  CoinPayment::where('orderID',$result->orderID)->first();
            $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                    if ($bonus_amount<=10000)
                    {
                        $bonus_amount=$bonus_amount;
                    }
                    else
                    {
                        $bonus_amount=10000;
                    }
                }
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'BTC';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request  = $order;
                $log      =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                //saving data into bonuses table and checking if user has already availed the bonus
                $bonusadd=new \App\Bonus;
                $bonusadd->user_id =  $order->user_id;
                $bonusadd->add_bonus_id =  $bonus->id;
                $bonusadd->amount= $bonus_amount;
                $bonusadd->spin = $bonus->free_spin;
                $bonusadd->betsize = $bonus->bet_size;
                $bonusadd->line = $bonus->lines;
                $bonusadd->type = 'bonus_code';
                $bonusadd->from='casino';
                $bonusadd->to= $profile->username;
                $bonusadd->save();

                // notification
                $notification=new \App\Notification;
                $notification->user_id = $order->user_id;
                $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                $wallet->user_id = $order->user_id;
                if ($bonus->percent_amount != '')
                {
                    $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                    $wallet->amount = $bonus->bonus_amount;
                }
                $wallet->type_id =  $wallet_type->id;
                $wallet->created_by=$order->user_id;
                $wallet->bonus_id=$bonus->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->free_token+= $wallet->amount;
                $userWallet->free_spin+= $bonus->free_spin;
                $userWallet->usd+= (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'BTC';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            \Log::info("record saving end");
            $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' BTC ('.$order->dollar_amount.'$) has been completed successfully');
            // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
            return "done";
        }

    }
    public function usdt_callback(Request $request)
    {
        \Log::info("USDT callback url start with updated code");
        $secret_key                   = "0x8d68be3308013a75925398918ca4c2cc2fc69c46d56b185607eb17a2c33f6c74";
        $aes_key                      = "0x21c3fcc8a1144ef051dcddc90dc400cc31dee5e33972fbfbe3d6f9cbd47efe56";
        $header_token                 =  $request->header('Authorization');
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$aes_key));
        if (isset($result->amount)) {
            DB::table('coin_payment')
                ->where('orderID', $result->orderID)
                ->update([
                    'response'     => \Opis\Closure\serialize($result),
                    'coin_amount'  => $result->amount,
                    'dollar_amount' => $result->depositUSD,
                    'status'        => 1
                ]);
            \Log::info("usdt callback url done");
            \Log::info("usdt record saving start");
            $order =  CoinPayment::where('orderID',$result->orderID)->first();
            $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                    if ($bonus_amount<=10000)
                    {
                        $bonus_amount=$bonus_amount;
                    }
                    else
                    {
                        $bonus_amount=10000;
                    }
                }
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'USDT';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request  = $order;
                $log      =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                //saving data into bonuses table and checking if user has already availed the bonus
                $bonusadd=new \App\Bonus;
                $bonusadd->user_id =  $order->user_id;
                $bonusadd->add_bonus_id =  $bonus->id;
                $bonusadd->amount= $bonus_amount;
                $bonusadd->spin = $bonus->free_spin;
                $bonusadd->betsize = $bonus->bet_size;
                $bonusadd->line = $bonus->lines;
                $bonusadd->type = 'bonus_code';
                $bonusadd->from='casino';
                $bonusadd->to= $profile->username;
                $bonusadd->save();

                // notification
                $notification=new \App\Notification;
                $notification->user_id = $order->user_id;
                $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                $wallet->user_id = $order->user_id;
                if ($bonus->percent_amount != '')
                {
                    $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                    $wallet->amount = $bonus->bonus_amount;
                }
                $wallet->type_id =  $wallet_type->id;
                $wallet->created_by=$order->user_id;
                $wallet->bonus_id=$bonus->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->free_token+= $wallet->amount;
                $userWallet->free_spin+= $bonus->free_spin;
                $userWallet->usd+= (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'USDT';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            \Log::info("record saving end");
            $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' USDT ('.$order->dollar_amount.'$) has been completed successfully');
            // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
            return "done";
        }

    }
    public function lby_callback(Request $request)
    {
        \Log::info("LBY callback url start with updated code");
        $secret_key                   = "0x63c2ba7d75babb351493f04d7429950676f35dd7fa7aff54a8319b4b46063f73";
        $aes_key                      = "0x8643c2aa244942d255bad418a13062e53f79ac902120d480b0ac444eab1723a6";
        $header_token                 =  $request->header('Authorization');
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$aes_key));
        if (isset($result->amount)) {
            DB::table('coin_payment')
                ->where('orderID', $result->orderID)
                ->update([
                    'response'     => \Opis\Closure\serialize($result),
                    'coin_amount'  => $result->amount,
                    'dollar_amount' => $result->depositUSD,
                    'status'        => 1
                ]);
            \Log::info("LBY callback url done");
            \Log::info("LBY record saving start");
            $order =  CoinPayment::where('orderID',$result->orderID)->first();
            $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                    if ($bonus_amount<=10000)
                    {
                        $bonus_amount=$bonus_amount;
                    }
                    else
                    {
                        $bonus_amount=10000;
                    }
                }
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'LBY';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request  = $order;
                $log      =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                //saving data into bonuses table and checking if user has already availed the bonus
                $bonusadd=new \App\Bonus;
                $bonusadd->user_id =  $order->user_id;
                $bonusadd->add_bonus_id =  $bonus->id;
                $bonusadd->amount= $bonus_amount;
                $bonusadd->spin = $bonus->free_spin;
                $bonusadd->betsize = $bonus->bet_size;
                $bonusadd->line = $bonus->lines;
                $bonusadd->type = 'bonus_code';
                $bonusadd->from='casino';
                $bonusadd->to= $profile->username;
                $bonusadd->save();

                // notification
                $notification=new \App\Notification;
                $notification->user_id = $order->user_id;
                $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                $wallet->user_id = $order->user_id;
                if ($bonus->percent_amount != '')
                {
                    $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                    $wallet->amount = $bonus->bonus_amount;
                }
                $wallet->type_id =  $wallet_type->id;
                $wallet->created_by=$order->user_id;
                $wallet->bonus_id=$bonus->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->free_token+= $wallet->amount;
                $userWallet->free_spin+= $bonus->free_spin;
                $userWallet->usd+= (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'LBY';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            \Log::info("LBY record saving end");
            $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' LBY ('.$order->dollar_amount.'$) has been completed successfully');
            // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
            return "done";
        }

    }
    public function psix_callback(Request $request)
    {
        \Log::info("PSIX callback url start with updated code");
        $secret_key                   = "0x63c2ba7d75babb351493f04d7429950676f35dd7fa7aff54a8319b4b46063f73";
        $aes_key                      = "0x8643c2aa244942d255bad418a13062e53f79ac902120d480b0ac444eab1723a6";
        $header_token                 =  $request->header('Authorization');
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$aes_key));
        if (isset($result->amount)) {
            DB::table('coin_payment')
                ->where('orderID', $result->orderID)
                ->update([
                    'response'     => \Opis\Closure\serialize($result),
                    'coin_amount'  => $result->amount,
                    'dollar_amount' => $result->depositUSD,
                    'status'        => 1
                ]);
            \Log::info("PSIX callback url done");
            \Log::info("PSIX record saving start");
            $order =  CoinPayment::where('orderID',$result->orderID)->first();
            $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
                    if ($bonus_amount<=10000)
                    {
                        $bonus_amount=$bonus_amount;
                    }
                    else
                    {
                        $bonus_amount=10000;
                    }
                }
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'PSIX';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request  = $order;
                $log      =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                //saving data into bonuses table and checking if user has already availed the bonus
                $bonusadd=new \App\Bonus;
                $bonusadd->user_id =  $order->user_id;
                $bonusadd->add_bonus_id =  $bonus->id;
                $bonusadd->amount= $bonus_amount;
                $bonusadd->spin = $bonus->free_spin;
                $bonusadd->betsize = $bonus->bet_size;
                $bonusadd->line = $bonus->lines;
                $bonusadd->type = 'bonus_code';
                $bonusadd->from='casino';
                $bonusadd->to= $profile->username;
                $bonusadd->save();

                // notification
                $notification=new \App\Notification;
                $notification->user_id = $order->user_id;
                $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                $wallet->user_id = $order->user_id;
                if ($bonus->percent_amount != '')
                {
                    $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
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
                    $wallet->amount = $bonus->bonus_amount;
                }
                $wallet->type_id =  $wallet_type->id;
                $wallet->created_by=$order->user_id;
                $wallet->bonus_id=$bonus->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->free_token+= $wallet->amount;
                $userWallet->free_spin+= $bonus->free_spin;
                $userWallet->usd+= (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->dollar_amount;
                $deposit->charge_id = $order->orderID;
                $deposit->to = 'casino';
                $deposit->type = 'PSIX';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->dollar_amount;
                $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->dollar_amount;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->dollar_amount*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->dollar_amount;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            \Log::info("PSIX record saving end");
            $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' PSIX ('.$order->dollar_amount.'$) has been completed successfully');
            // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
            return "done";
        }

    }
    public function axcess_payment($id)
    {

        $user                     = User::where('id',$id)->first();
        $check                    = AxcessPayment::where('user_id',$id)->orderBy('id','desc')->first();
        if ($check->response==null && $check->status==0)
        {

            $message = "your payment is under process we'll notify you when payment is done.";
        }
        else
        {
            $message = "00";
        }
        // stores notification record in table
        $push                    = new PushNotifications();
        $push->title             = 'success';
        $push->body              = $message;
        $push->user_id           = $id;
        $push->type              = 'Axcess Payment';
        if (Auth::check() && Auth::user()->id==$id)
        {
            $push->user_status   = 1;
        }
        else
        {
            $push->user_status   = 0;
        }
        $push->status            = 1;
        $push->save();
        $result = generatePush('AxcessPayment','receiver.'.$user->id,$message);
        $notification=new \App\Notification;
        $notification->user_id = $check->user_id;
        $notification->message='Your transaction #'.$check->token." is under process, we'll notify you when payment is done";
        $notification->save();
        Toastr::warning("Your payment is under process we'll notify you when payment is done");
        return redirect('user/deposit');
        //return view('frontend.axcess_payment');
    }
    public function axcess_callback(Request $request)
    {
        \Log::info("callback url start with axcess payment");
        $result                       = $request->all();
        // just for testing
        /*$axcess                       = AxcessPayment::orderBy('id','asc')->first();
        $axcess->response             =  \Opis\Closure\serialize($result);
        $axcess->save();*/
        \Log::info("record saving start with axcess payment");
        if (array_key_exists('responseStatus',$result))
        {
            if ($result['responseStatus']==0)
            {
                if (array_key_exists('amountReceived',$result) && array_key_exists('transactionID',$result))
                {
                    DB::table('axcess_payment')
                        ->where('token', $result['orderRef'])
                        ->update([
                            'response'     => \Opis\Closure\serialize($result),
                            'received_amount' => $result['amountReceived']/100,
                            'orderID'         => $result['transactionID'],
                            'transactionUnique' => $result['transactionUnique'],
                            'status'          => $result['responseStatus']==0?1:$result['responseStatus']
                        ]);
                    $order =  AxcessPayment::where('token',$result['orderRef'])->first();
                    $profile =  DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
                    $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                    // update currency base rate table with orderID
                    if ($order->currency!=null && $order->currency!="usd" && $order->currency!="USD")
                    {
                        $base_rate             = CurrencyBaseRate::where('ref_key',$order->token)
                            ->where('user_id',$order->user_id)
                            ->orderBy('id','desc')->first();
                        if ($base_rate!=null && $base_rate->count()>0)
                        {
                            $base_rate->orderID    = $order->orderID;
                            $base_rate->status     = 2;
                            $base_rate->save();
                        }
                    }
                    if (@$order->bonus_code) {
                        $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                        if (@$bonus->bonus_amount) {
                            $bonus_amount = $bonus->bonus_amount;
                        }
                        else {
                            $bonus_amount = $tok->pley6_token * ($order->received_amount * ($bonus->percent_amount/100));
                            if ($bonus_amount<=10000)
                            {
                                $bonus_amount=$bonus_amount;
                            }
                            else
                            {
                                $bonus_amount=10000;
                            }
                        }
                        $deposit = new Deposit();
                        $deposit->user_id = $order->user_id;
                        $deposit->amount = $order->received_amount;
                        $deposit->charge_id = $order->orderID;
                        $deposit->to = 'casino';
                        $deposit->type = 'axcess';
                        $deposit->from = $profile->username;
                        $deposit->save();

                        transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                        $user_id  = $order->user_id;
                        $logModel = $deposit;
                        $request  = $order;
                        $log      =  $deposit->type;
                        logCreatedActivity($user_id,$logModel,$request,$log);

                        $notification=new \App\Notification;
                        $notification->user_id=$order->user_id;
                        $notification->message=getTranslated('deposit_success').$order->received_amount.' '.$order->currency;
                        $notification->save();

                        //saving data into bonuses table and checking if user has already availed the bonus
                        $bonusadd=new \App\Bonus;
                        $bonusadd->user_id =  $order->user_id;
                        $bonusadd->add_bonus_id =  $bonus->id;
                        $bonusadd->amount= $bonus_amount;
                        $bonusadd->spin = $bonus->free_spin;
                        $bonusadd->betsize = $bonus->bet_size;
                        $bonusadd->line = $bonus->lines;
                        $bonusadd->type = 'bonus_code';
                        $bonusadd->from='casino';
                        $bonusadd->to= $profile->username;
                        $bonusadd->save();

                        // notification
                        $notification=new \App\Notification;
                        $notification->user_id = $order->user_id;
                        $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
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
                        $wallet->user_id = $order->user_id;
                        if ($bonus->percent_amount != '')
                        {
                            $wallet->amount = $tok->pley6_token * ($order->received_amount * ($bonus->percent_amount/100));
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
                            $wallet->amount = $bonus->bonus_amount;
                        }
                        $wallet->type_id =  $wallet_type->id;
                        $wallet->created_by=$order->user_id;
                        $wallet->bonus_id=$bonus->id;
                        $wallet->save();
                        // updating prosix_user_wallet table lobby main table for user wallet
                        $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                        $userWallet->free_token+= $wallet->amount;
                        $userWallet->free_spin+= $bonus->free_spin;
                        $userWallet->usd+= (float)@$order->received_amount;
                        $userWallet->token = $userWallet->token + ($order->received_amount * $tok->pley6_token) ;
                        $userWallet->type_id=$wallet_type->id;
                        $userWallet->save();

                        $transaction =new Transaction();
                        $transaction->user_id = $order->user_id;
                        $transaction->transaction_id = $deposit->id;
                        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                        $transaction->amount = $order->received_amount*$tok->pley6_token;
                        $transaction->from = $profile->username;
                        $transaction->to ='casino';
                        $transaction->type = 'deposit';
                        $transaction->usd = $order->received_amount;
                        $transaction->currency = 'usd';
                        $transaction->save();

                    }
                    else
                    {
                        $deposit = new Deposit();
                        $deposit->user_id = $order->user_id;
                        $deposit->amount = $order->received_amount;
                        $deposit->charge_id = $order->orderID;
                        $deposit->to = 'casino';
                        $deposit->type = 'axcess';
                        $deposit->from = $profile->username;
                        $deposit->save();

                        transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                        $user_id  = $order->user_id;
                        $logModel = $deposit;
                        $request = $order;
                        $log =  $deposit->type;
                        logCreatedActivity($user_id,$logModel,$request,$log);

                        $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                        $userWallet->usd +=  (float)@$order->received_amount;
                        $userWallet->token = $userWallet->token + ($order->received_amount * $tok->pley6_token) ;
                        $userWallet->save();

                        /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                        $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                        $AdminWallet->save();*/

                        $notification=new \App\Notification;
                        $notification->user_id=$order->user_id;
                        $notification->message=getTranslated('deposit_success').$order->received_amount.' '.$order->currency;
                        $notification->save();

                        $transaction =new Transaction();
                        $transaction->user_id = $order->user_id;
                        $transaction->transaction_id = $deposit->id;
                        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                        $transaction->amount = $order->received_amount*$tok->pley6_token;
                        $transaction->from = $profile->username;
                        $transaction->to ='casino';
                        $transaction->type = 'deposit';
                        $transaction->usd = $order->received_amount;
                        $transaction->currency = 'usd';
                        $transaction->save();

                    }
                    \Log::info("record saving end");
                    $this->sendNotification1($order->user_id,$order->received_amount,"your transaction of ".$order->received_amount." ".$order->currency." is processed successfully");

                }
            }
            else{
                if (array_key_exists('amountReceived',$result) && array_key_exists('transactionID',$result))
                {
                    DB::table('axcess_payment')
                        ->where('token', $result['orderRef'])
                        ->update([
                            'response'     => \Opis\Closure\serialize($result),
                            'received_amount' => $result['amountReceived']/100,
                            'orderID'         => $result['transactionID'],
                            'transactionUnique' => $result['transactionUnique'],
                           // 'status'          => $result['responseStatus']==0?1:$result['responseStatus']
                            'status'              => 0
                        ]);
                }
                else
                {
                    DB::table('axcess_payment')
                        ->where('token', $result['orderRef'])
                        ->update([
                            'response'     => \Opis\Closure\serialize($result),
                            'orderID'         => $result['transactionID'],
                            'transactionUnique' => $result['transactionUnique'],
                           // 'status'          => $result['responseStatus']==0?1:$result['responseStatus']
                            'status'              => 0
                        ]);
                }

                $order =  AxcessPayment::where('token',$result['orderRef'])->first();
            if ($result['responseStatus']==2)
                {
                    $notification=new \App\Notification;
                    $notification->user_id=$order->user_id;
                    $notification->message="Your transaction #".$order->token." is declined";
                    $notification->save();
                $this->sendNotification1($order->user_id,0,"Status: Transaction Failed "."<br> Error Code: ".$result['responseCode']."<br> Response: ".$result['responseMessage']);
            }
            elseif ($result['responseStatus']==4)
                {

                    $notification=new \App\Notification;
                    $notification->user_id=$order->user_id;
                    $notification->message="Your transaction #".$order->token." is declined";
                    $notification->save();
                    $this->sendNotification1($order->user_id,0,"Status: Transaction Failed "."<br> Error Code: ".$result['responseCode']."<br> Response: ".$result['responseMessage']);
                 }
            elseif ($result['responseStatus']==5)
                {
                    $notification=new \App\Notification;
                    $notification->user_id=$order->user_id;
                    $notification->message="Your transaction #".$order->token." is declined";
                     $notification->save();
                    $this->sendNotification1($order->user_id,0,"Status: Transaction Failed "."<br> Error Code: ".$result['responseCode']."<br> Response: ".$result['responseMessage']);
                }
           }

        }

        \Log::info("callback url end with axcess payment");
        return "done";
    }
    function sendNotification($user_id,$amount,$dollar,$message)
    {
        $user                     = User::where('id',$user_id)->first();
        // stores notification record in table
        $push                    = new PushNotifications();
        $push->title             = 'success';
        $push->body              = $message;
        $push->user_id           = $user_id;
        $push->type              = 'Coin Payment Test url';
        if (Auth::check() && Auth::user()->id==$user_id)
        {
            $push->user_status   = 1;
        }
        else
        {
            $push->user_status   = 0;
        }
        $push->status            = 1;
        $push->save();
        if ($user->pusher_token!=null)
        {
            $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,$message);
        }
        else
        {
            $number              = str_random(10);
            if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
            {
                return $this->sendNotification($user_id,$amount,$dollar,$message);
            }
            else
            {
                $user->pusher_token = $number;
                $user->save();
                $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,$message);

            }
        }
    }
    function sendNotification1($user_id,$amount,$message)
    {
        $user                     = User::where('id',$user_id)->first();
        // stores notification record in table
        $push                    = new PushNotifications();
        $push->title             = 'success';
        $push->body              = $message;
        $push->user_id           = $user_id;
        $push->type              = 'Axcess Payment';
        if (Auth::check() && Auth::user()->id==$user_id)
        {
            $push->user_status   = 1;
        }
        else
        {
            $push->user_status   = 0;
        }
        $push->status            = 1;
        $push->save();
        if ($user->pusher_token!=null)
        {
            if ($amount>0)
            {
                $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,$message);
            }
            // for error response
            else
            {
                $result = generatePush('AxcessPaymentFailed','receiver.'.$user->pusher_token,$message);

            }
        }
        else
        {
            $number              = str_random(10);
            if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
            {
                return $this->sendNotification1($user_id,$amount,$message);
            }
            else
            {
                $user->pusher_token = $number;
                $user->save();
                // for success response
                if ($amount>0)
                {
                    $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,$message);
                }
                // for error response
                else
                {
                    $result = generatePush('AxcessPaymentFailed','receiver.'.$user->pusher_token,$message);

                }
            }
        }
    }
}
