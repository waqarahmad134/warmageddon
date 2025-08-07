<?php

namespace App\Http\Controllers;

use App\AddGame;
use App\AffiliateApiHistory;
use App\AffiliateApiSetting;
use App\Bonus;
use App\CoinPayment;
use App\Deposit;
use App\Events\DepositEvent;
use App\GameSessionChild;
use App\Http\Controllers\backend\affiliate\AffiliateAppController;
use App\Notification;
use App\PushNotifications;
use App\SoftswissGames;
use App\StripePaymentSettings;
use App\User;
use GuzzleHttp\RequestOptions;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use MysqliDb;
use App\PropersixBonus;
use App\ProsixUserWallet;
use App\ProsixWallet;
use App\ProsixWalletType;
use App\TokenCurrency;
use App\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Newsletter;
use \Firebase\JWT\JWT;
use Spatie\DbDumper\Databases\MySql;
use Swap\Laravel\Facades\Swap;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test2(Request $request)
     {
                $winners                      = GameSessionChild::where('spin_type','paid')
           ->where('status','won')
           ->whereRaw('(select max(created_at) from game_session_childs)')
           ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (amount_won))')
           ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (user_id))')
           ->whereRaw('Date( game_session_childs.created_at )= CURDATE()')
           ->groupBy('user_id')
           ->with('useracc')
           ->orderBy('amount_won','desc')
           ->limit(5)
           ->select('user_id','game_session_childs.amount_won','game_session_childs.created_at')
           ->get()->makeVisible([
               'amount_own', 'created_at'
           ]);
           dd($winners);
         return "testing";
//        $row                                = CoinPayment::whereId(146)->first();
//        $myarray                              = [
//   "symbol" => "TUSD",
//    "amount" => 25,
//    "status" => "Deposit",
//    "orderID" => "6116357dec98707f9bf6680e",
//    "email" => "drrobertresearch@gmail.com",
//    "firstName" => "",
//    "lastName" => "",
//    "depositUSD" => 25,
//    "requiredUSD" => "25.01"
//     ];
//     $row->response                       = \Opis\Closure\serialize(json_decode(json_encode($myarray)));
//     $row->coin_amount                    = 25;
//     $row->dollar_amount                  = 25;
//     $row->status                         = 1;
//     $row->save();
//        $result   = \Opis\Closure\unserialize($row->response);
//        $order =  CoinPayment::where('orderID',$result->orderID)->first();
//        $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
//        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
//        if (@$order->bonus_code) {
//            $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
//            if (@$bonus->bonus_amount) {
//                $bonus_amount = $bonus->bonus_amount;
//            }
//            else {
//                $bonus_amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
//                if ($bonus_amount<=10000)
//                {
//                    $bonus_amount=$bonus_amount;
//                }
//                else
//                {
//                    $bonus_amount=10000;
//                }
//            }
//            $deposit = new Deposit();
//            $deposit->user_id = $order->user_id;
//            $deposit->amount = $order->dollar_amount;
//            $deposit->charge_id = $order->orderID;
//            $deposit->to = 'casino';
//            $deposit->type = 'USDT';
//            $deposit->from = $profile->username;
//            $deposit->save();
//
//            transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);
//
//            $user_id  = $order->user_id;
//            $logModel = $deposit;
//            $request  = $order;
//            $log      =  $deposit->type;
//            logCreatedActivity($user_id,$logModel,$request,$log);
//
//            $notification=new \App\Notification;
//            $notification->user_id=$order->user_id;
//            $notification->message=getTranslated('deposit_success').$order->dollar_amount;
//            $notification->save();
//
//            //saving data into bonuses table and checking if user has already availed the bonus
//            $bonusadd=new \App\Bonus;
//            $bonusadd->user_id =  $order->user_id;
//            $bonusadd->add_bonus_id =  $bonus->id;
//            $bonusadd->amount= $bonus_amount;
//            $bonusadd->spin = $bonus->free_spin;
//            $bonusadd->betsize = $bonus->bet_size;
//            $bonusadd->line = $bonus->lines;
//            $bonusadd->type = 'bonus_code';
//            $bonusadd->from='casino';
//            $bonusadd->to= $profile->username;
//            $bonusadd->save();
//
//            // notification
//            $notification=new \App\Notification;
//            $notification->user_id = $order->user_id;
//            $notification->message='You got '.$bonus->bonus_amount.' token and '.$bonus->free_spin.' spin bonus';
//            $notification->save();
//
//            $bonus_type = 'bonus_token';
//
//            $wal = ProsixWalletType::where('type',$bonus_type)->first();
//            if (is_null($wal)) {
//                $wallet_type= new ProsixWalletType();
//            } else {
//                $wallet_type = $wal;
//            }
//            $wallet_type->type=$bonus_type;
//            $wallet_type->save();
//
//            //saving record of bonus data in prosix_wallets table
//            $wallet =new ProsixWallet();
//            $wallet->user_id = $order->user_id;
//            if ($bonus->percent_amount != '')
//            {
//                $wallet->amount = $tok->pley6_token * ($order->dollar_amount * ($bonus->percent_amount/100));
//                if ($wallet->amount<=10000)
//                {
//                    $wallet->amount=$wallet->amount;
//                }
//                else
//                {
//                    $wallet->amount=10000;
//                }
//            }
//            else
//            {
//                $wallet->amount = $bonus->bonus_amount;
//            }
//            $wallet->type_id =  $wallet_type->id;
//            $wallet->created_by=$order->user_id;
//            $wallet->bonus_id=$bonus->id;
//            $wallet->save();
//            // updating prosix_user_wallet table lobby main table for user wallet
//            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
//            $userWallet->free_token+= $wallet->amount;
//            $userWallet->free_spin+= $bonus->free_spin;
//            $userWallet->usd+= (float)@$order->dollar_amount;
//            $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
//            $userWallet->type_id=$wallet_type->id;
//            $userWallet->save();
//
//            $transaction =new Transaction();
//            $transaction->user_id = $order->user_id;
//            $transaction->transaction_id = $deposit->id;
//            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
//            $transaction->amount = $order->dollar_amount*$tok->pley6_token;
//            $transaction->from = $profile->username;
//            $transaction->to ='casino';
//            $transaction->type = 'deposit';
//            $transaction->usd = $order->dollar_amount;
//            $transaction->currency = 'usd';
//            $transaction->save();
//
//        }
//        else
//        {
//            $deposit = new Deposit();
//            $deposit->user_id = $order->user_id;
//            $deposit->amount = $order->dollar_amount;
//            $deposit->charge_id = $order->orderID;
//            $deposit->to = 'casino';
//            $deposit->type = 'USDT';
//            $deposit->from = $profile->username;
//            $deposit->save();
//
//            transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);
//
//            $user_id  = $order->user_id;
//            $logModel = $deposit;
//            $request = $order;
//            $log =  $deposit->type;
//            logCreatedActivity($user_id,$logModel,$request,$log);
//
//            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
//            $userWallet->usd +=  (float)@$order->dollar_amount;
//            $userWallet->token = $userWallet->token + ($order->dollar_amount * $tok->pley6_token) ;
//            $userWallet->save();
//
//            /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
//            $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
//            $AdminWallet->save();*/
//
//            $notification=new \App\Notification;
//            $notification->user_id=$order->user_id;
//            $notification->message=getTranslated('deposit_success').$order->dollar_amount;
//            $notification->save();
//
//            $transaction =new Transaction();
//            $transaction->user_id = $order->user_id;
//            $transaction->transaction_id = $deposit->id;
//            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
//            $transaction->amount = $order->dollar_amount*$tok->pley6_token;
//            $transaction->from = $profile->username;
//            $transaction->to ='casino';
//            $transaction->type = 'deposit';
//            $transaction->usd = $order->dollar_amount;
//            $transaction->currency = 'usd';
//            $transaction->save();
//
//        }
//        \Log::info("record saving end");
//        $this->sendNotification($order->user_id,$order->coin_amount,$order->dollar_amount,'Your transaction of '.$order->coin_amount.' USDT ('.$order->dollar_amount.'$) has been completed successfully');
//        // broadcast(new \App\Events\DepositEvent($order->user_id,$order->coin_amount))->toOthers();
//        return "done";
     }
    function recordSaving1($orderid){
        \Log::info("record saving start");
        $order =  CoinPayment::where('orderID',$orderid)->first();

        $profile =  \Illuminate\Support\Facades\DB::table("user_profiles")->where('user_id' , $order->user_id)->first();

        try {
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
                $deposit->charge_id = $order->id;
                $deposit->to = 'casino';
                $deposit->type = 'depositcoingate';
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
                $deposit->charge_id = $order->id;
                $deposit->to = 'casino';
                $deposit->type = 'depositcoingate';
                $deposit->from = $profile->username;

                $deposit->save();
                dd('sdlkklfads');
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
        } catch (\Exception $e) {
            \Log::info("record saving exception");
        }
    }
    function sendNotification($user_id,$amount,$dollar,$message)
    {
        $user                     = User::where('id',$user_id)->first();
        // stores notification record in table
        $push                    = new PushNotifications();
        $push->title             = 'success';
        $push->body              = getTranslated('eth_transaction1').$amount.getTranslated('eth_transaction2');
        $push->user_id           = $user_id;
        $push->type              = 'Ethereum Payment Test url';
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
            $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,getTranslated('eth_transaction1').$amount.getTranslated('eth_transaction2'));
        }
        else
        {
            $number              = str_random(10);
            if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
            {
                return $this->sendNotification($user_id,$amount,$dollar,'');
            }
            else
            {
                $user->pusher_token = $number;
                $user->save();
                $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,getTranslated('eth_transaction1').$amount.getTranslated('eth_transaction2'));
            }
        }
    }
    public function testold($id,$amount,$dollar)
    {
         $this->sendNotification($id,$amount,$dollar,'');
         return "triggered";
//        broadcast(new DepositEvent(2,90))->toOthers();
//        return "event triggered";
      $result             = DB::table('coin_payment')->where('id',1)->first();
        $this->recordSaving1($result->orderID);
        echo "return to old location";
        exit();
        $secret_key       =  "0xe46377267ec9026a89d4cda24ebb6765347fa358db3ecef9c925b9accf8c9f95";
        $header_token     = \Opis\Closure\unserialize($result->response);
       //dd($header_token);
        $decoded                      = JWT::decode($header_token, $secret_key, array('HS256'))->data;
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$secret_key));
        dd($result);
        $secret_key                   =  "0xe46377267ec9026a89d4cda24ebb6765347fa358db3ecef9c925b9accf8c9f95";
        $decoded                      = "U2FsdGVkX1/NfEOYLusZmscKw3diMcrUn30TJwSxnsSFMQMl/6BS61kvjgndDo+0yVLmI04gQko8XauvhMUXm/ddsqfQTkRV+On2hAzCTpTXChQk7MEzNiJ5T7iX2on4vdoshjUhKmPpNGE7MaV+9kKxic09j4EbVDhPFchPCHKSxMGYiH0PHE7krM7iDikOnM/7GJYxvc4S0+kKpb5t4GgEL8ut3m3m7lDT8d7yuIqwTldBvRFcWMKYPX4c0OF2zxqWCZ7baiIM+HKA6r9aqA==";
        $result                       = json_decode(\Blocktrail\CryptoJSAES\CryptoJSAES::decrypt($decoded,$secret_key));
        dd($result);

//       $data        = collect([
//           'amount' =>'3450',
//           'currency'=>'usd',
//           'card_number'=>'4111111111111111',
//           'cvv'=>345,
//           'expiry_month'=>1,
//           'expiry_year'=>21,
//           'email'=>'haroon@gmail.com'
//       ]);
//        $encData = openssl_encrypt(json_decode($data,true), 'DES-EDE3', 'FLWSECK_TEST56fdced12a68', OPENSSL_RAW_DATA);
//
//        dd(json_decode($encData));
        return "no code for testing";
//        MySql::create()
//            ->setDbName('casino_db')
//            ->setUserName('casino_db')
//            ->setPassword('E9AU5aCz')
//            ->dumpToFile('public/dump.sql');
        //DB::unprepared(file_get_contents('public/database/backup1.sql'));
        //return "backup done";
//        $payment                = StripePaymentSettings::where('id',1)->first();
//        dd(\Opis\Closure\unserialize($payment->api_response));
//        echo 'hi';
//        Redis::set('user','haroon');
//        $result              = Redis::get('user');
//        dd($result)
//        return view('frontend.home.affiliate1');
        $pass = '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'; // not the key, but the token

//$url = 'https://api.sendgrid.com/';
////remove the user and password params - no longer needed
//$params = array(
//    'to'        => 'muhammadharoon527@yahoo.com',
//    'subject'   => 'sub',
//    'html'      => 'message',
//    'from'      => 'muhammadharoon526@gmail.com',
//);
//
//$request =  $url.'api/mail.send.json';
//$headr = array();
//// set authorization header
//$headr[] = 'Authorization: Bearer '.$pass;
//
//$session = curl_init($request);
//curl_setopt ($session, CURLOPT_POST, true);
//curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
//curl_setopt($session, CURLOPT_HEADER, false);
//curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//
//// add authorization header
//curl_setopt($session, CURLOPT_HTTPHEADER,$headr);
//
//$response = curl_exec($session);
//        dd($response);
//curl_close($session);
        $apiKey = getenv('SENDGRID_API_KEY');
//
//        $sg = new \SendGrid($pass);
//
//        try {
//            $response = $sg->client->suppression()->bounces()->get();
//            print $response->statusCode() . "\n";
//            print_r($response->headers());
//            print $response->body() . "\n";
//        } catch (Exception $e) {
//            echo 'Caught exception: '.  $e->getMessage(). "\n";
//        }
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("zawar@propersix.com", "SendGrid Mail");
        $email->setSubject("Sending this message with Twilio SendGrid is");
        $email->addTo("muhammadharoon526@gmail.com", "SendGrid Mail Testing");
//        $email->addContent("text/plain", "this is only for testing so discord this no issue");
//        $email->addContent(
//            "text/html", "<strong>this is for only for testing so discord this no issue</strong>"
//        );
        $email->setTemplateId("d-5f798cd5ab1e4c4d940b9c358835657c");


        $sendgrid = new \SendGrid($pass);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
    function test1($orderID)
    {
        $order =  CoinPayment::where('walletAddress',$orderID)->first();
        echo $order->orderID.'<br>';
        dd( \Opis\Closure\unserialize($order->response));
        //$country_code = $_SERVER["HTTP_CF_IPCOUNTRY"];
        dd($order);
        $backend  = DB::table('activated_bonuses')->latest()->first();
        dd($backend);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "{\"list_ids\":[\"b265bb55-9e98-45f1-9f37-f25a6a3aa747\"],\"contacts\":[{\"address_line_1\":\"string (optional)\",\"address_line_2\":\"string (optional)\",\"alternate_emails\":[\"haroon@gmail.com\"],\"city\":\"string (optional)\",\"country\":\"string (optional)\",\"email\":\"haroon@gmail.com\",\"first_name\":\"Haroon \",\"last_name\":\"string (optional)\",\"postal_code\":\"string (optional)\",\"kpk\":\"string (optional)\",\"custom_fields\":{}}]}",
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
        } else {
            echo $response;
        }
    }
    public function error($code)
    {
      return view('errors.'.$code);
    }
    function coin_callback(Request $request)
    {
        if (!Input::has('id'))
        {
            abort(401,"Not Found");
        }
        //ip restriction
        //ip restriction end
        $input                            = $request->all();
        $order                            = \App\CoinGate::where('id',$input['id'])
                                                        ->where('processable_token',$input['token'])
                                                        ->first();
        $order->status                    = $input['status'];
        $order->receive_currency          = $input['pay_currency'];
        $order->deposit_amount            = $input['pay_amount'];
//        $order->updated_at                = $input['created_at'];
        $order->save();
//        if (Auth::user()->id==$order->user_id)
//        {
//        Toastr::sucess("Payment Status : ".$input['status']);
//            return redirect('https://propersix.casino/user/dashboard#deposit');
//        }
        //for saving data in deposits table
        $orderid=$input['id'];
        if ($input['status']=='paid') {
            $this->recordSaving($orderid);
        }
        //end for saving data in deposits table
        Toastr::success("Payment Status : ".$input['status'],'Success');
        return redirect()->to('https://propersix.casino/user/dashboard#deposit');
    }
    public function payment_callback(Request $request)
    {
        Log::info('Stripe payment callback');
        $amount      = $request->total;
        $payment_history            = StripePaymentSettings::where('payment_key',$request->meta_data[0]['value'])->first();
        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $user = User::where('id',$payment_history->user_id)->first();

        $payment_history->api_response  = \Opis\Closure\serialize($request->all());
        $payment_history->save();
        $deposit = new Deposit();
        $deposit->user_id = $payment_history->user_id;
        $deposit->amount = $amount;
        $deposit->charge_id = $request->transaction_id;
        $deposit->to = 'casino';
        $deposit->type = 'deposit';
        $deposit->from = $user->user_name;
        $deposit->save();
        transactionWallet1($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$user);
        $user_pr=User::findOrFail($payment_history->user_id);
        $user1=$user_pr->profile;
        $user1->first_name = $user->first_name;
        $user1->last_name  = $user->last_name;
        $user1->country = $user->country;
        $user1->state = $user->state;
        $user1->zipcode = $user->zipcode;
        $user1->address = $user->Address;
        $user1->save();
        $user_id  = $payment_history->user_id;
        $logModel = $deposit;
        $request = $deposit;
        $log =  $deposit->type;
        logCreatedActivity($user_id,$logModel,$request,$log);

        if ($payment_history->bonus_amount>0) {
            $bonus = PropersixBonus::where('type', 'deposit')->where('bonus_code', $payment_history->bonus_code)->where('status', 1)->first();
            $b_c = Bonus::where('add_bonus_id', @$bonus->id)->where('user_id', $user->id)->first();
             if (is_null($b_c)) {

                //saving data into bonuses table and checking if user has already availed the bonus
                $data = PropersixBonus::where('type', 'deposit')->where('bonus_code', $payment_history->bonus_code)->first();

                $bonus = new Bonus();
                $bonus->user_id = $user->id;
                $bonus->add_bonus_id = $data->id;
                $bonus->amount = $payment_history->bonus_amount;
                $bonus->spin = @$data->free_spin;
                $bonus->betsize = @$data->bet_size;
                $bonus->line = @$data->lines;
                $bonus->type = 'bonus_code';
                $bonus->from = 'casino';
                $bonus->to = $user->user_name;
                $bonus->save();
                // bonus notification
                $notification = new Notification();
                $notification->user_id = $user->id;
                $notification->message = 'You got ' . $data->bonus_amount . ' token and ' . $data->free_spin . ' spin bonus';
                $notification->save();

                $bonus_type = 'bonus_token';

                $wal = ProsixWalletType::where('type', $bonus_type)->first();
                if (is_null($wal)) {
                    $wallet_type = new ProsixWalletType();
                } else {
                    $wallet_type = $wal;
                }
                $wallet_type->type = $bonus_type;
                $wallet_type->save();

                //saving record of bonus data in prosix_wallets table
                $wallet = new ProsixWallet();
                $wallet->user_id = $user->id;
                if ($data->percent_amount != '') {
                    $wallet->amount = $tok->pley6_token * ($amount * ($data->percent_amount / 100));
                    if ($wallet->amount <= 10000) {
                        $wallet->amount = $wallet->amount;
                    } else {
                        $wallet->amount = 10000;
                    }
                } else {
                    $wallet->amount = $data->bonus_amount;
                }
                $wallet->type_id = $wallet_type->id;
                $wallet->created_by = $user->id;
                $wallet->bonus_id = $data->id;
                $wallet->save();
                // updating prosix_user_wallet table lobby main table for user wallet
                $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => $user->id]);
                $userWallet->free_token += $wallet->amount;
                $userWallet->free_spin += $data->free_spin;
                $userWallet->usd += (float)@$amount;
                $userWallet->token = $userWallet->token + ($amount * $tok->pley6_token);
                $userWallet->type_id = $wallet_type->id;
                $userWallet->save();
            }
        }
        $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$payment_history->user_id]);
        $userWallet->usd +=  (float)@$amount;
        $userWallet->token = $userWallet->token + ($amount * $tok->pley6_token) ;
        $userWallet->save();

        /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
        $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
        $AdminWallet->save();*/

        $notification=new \App\Notification;
        $notification->user_id=$payment_history->user_id;
        $notification->message=getTranslated('deposit_success').$amount;
        $notification->save();


        $transaction =new Transaction();
        $transaction->user_id = $payment_history->user_id;
        $transaction->transaction_id = $deposit->id;
        $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $transaction->amount = $amount*$tok->pley6_token;
        $transaction->from = $user->user_name;
        $transaction->to ='casino';
        $transaction->type = 'deposit';
        $transaction->usd = $amount;
        $transaction->currency = 'usd';
        $transaction->save();

        // updating paymentsettings table
        $payment_history->amount = $amount;
        $payment_history->save();
        return response()->json([
            'type' => 'success',
            'message' => getTranslated('deposit_success').$amount
        ]);
    }
    function recordSaving($orderid){
        $order = \App\CoinGate::where('id',$orderid)
            ->first();
        $profile =  DB::table("user_profiles")->where('user_id' , $order->user_id)->first();
        try {
            $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
            if (@$order->bonus_code) {
                $bonus = PropersixBonus::where('type','deposit')->where('bonus_code',$order->bonus_code)->where('status',1)->first();
                if (@$bonus->bonus_amount) {
                    $bonus_amount = $bonus->bonus_amount;
                }
                else {
                    $bonus_amount = $tok->pley6_token * ($order->deposit_usd * ($bonus->percent_amount/100));
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
                $deposit->amount = $order->deposit_usd;
                $deposit->charge_id = $order->id;
                $deposit->to = 'casino';
                $deposit->type = 'depositcoingate';
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
                $notification->message=getTranslated('deposit_success').$order->deposit_usd;
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
                    $wallet->amount = $tok->pley6_token * ($order->deposit_usd * ($bonus->percent_amount/100));
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
                $userWallet->usd+= (float)@$order->deposit_usd;
                $userWallet->token = $userWallet->token + ($order->deposit_usd * $tok->pley6_token) ;
                $userWallet->type_id=$wallet_type->id;
                $userWallet->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->deposit_usd*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->deposit_usd;
                $transaction->currency = 'usd';
                $transaction->save();

            }
            else
            {
                $deposit = new Deposit();
                $deposit->user_id = $order->user_id;
                $deposit->amount = $order->deposit_usd;
                $deposit->charge_id = $order->id;
                $deposit->to = 'casino';
                $deposit->type = 'depositcoingate';
                $deposit->from = $profile->username;
                $deposit->save();

                transactionWalletcoingate($deposit->amount,$deposit->type,$deposit->from,$deposit->to,$order->user_id);

                $user_id  = $order->user_id;
                $logModel = $deposit;
                $request = $order;
                $log =  $deposit->type;
                logCreatedActivity($user_id,$logModel,$request,$log);

                $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$order->user_id]);
                $userWallet->usd +=  (float)@$order->deposit_usd;
                $userWallet->token = $userWallet->token + ($order->deposit_usd * $tok->pley6_token) ;
                $userWallet->save();

                /*$AdminWallet=ProsixUserWallet::where('user_id',1)->first();
                $AdminWallet->usd= $AdminWallet->usd + (floatval(@$r->amount));
                $AdminWallet->save();*/

                $notification=new \App\Notification;
                $notification->user_id=$order->user_id;
                $notification->message=getTranslated('deposit_success').$order->deposit_usd;
                $notification->save();

                $transaction =new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->transaction_id = $deposit->id;
                $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                $transaction->amount = $order->deposit_usd*$tok->pley6_token;
                $transaction->from = $profile->username;
                $transaction->to ='casino';
                $transaction->type = 'deposit';
                $transaction->usd = $order->deposit_usd;
                $transaction->currency = 'usd';
                $transaction->save();

            }

        } catch (\Exception $e) {

        }
    }
    public function games_winner()
    {

//        $winners                      = GameSessionChild::where('spin_type','paid')
//            ->where('status','won')
//            ->whereRaw('(select max(created_at) from game_session_childs)')
//            ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (amount_won))')
//            ->whereRaw('amount_won in (select max(amount_won) from game_session_childs group by (user_id))')
//            ->groupBy('user_id')
//            ->with('useracc')
//            ->orderBy('amount_won','desc')
//            ->limit(5)
//            ->select('user_id','game_session_childs.amount_won','game_session_childs.created_at')
//            ->get()->makeVisible([
//                'amount_own', 'created_at'
//            ]);
// ---------------- zawar query -------------------------
//         $query = "SELECT
// 	game_session_childs.user_id,
// 	MAX( game_session_childs.amount_won ) AS amount,
// 	game_session_childs.created_at,
// 	users.user_name
// FROM
// 	game_session_childs
// 	INNER JOIN users ON game_session_childs.user_id = users.id
// WHERE
// 	Date( game_session_childs.created_at )= CURDATE() AND game_session_childs.spin_type='paid' AND game_session_childs.`status`='won'
// GROUP BY
// 	game_session_childs.user_id
// ORDER BY
// 	amount DESC
// 	LIMIT 5
// ";
// -------------------- haroon query --------------------------------
$query = "SELECT
	game_session_childs.user_id,
	Sum( game_session_childs.amount_won ) AS amount,
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
        $result = DB::select(DB::raw($query));
        return response()->json($result);
    }

}
