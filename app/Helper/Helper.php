<?php

use App\Transaction;
use App\UserMission;
use App\MissionBonus;
use App\TransactionType;
use App\ProsixTransaction;
use App\ProsixWalletType;
use App\ProsixWallet;
use App\Activity;
use carbon\carbon;
use \Firebase\JWT\JWT;
use App\User;
function ipDetail($value='')
{
  # code...
  dd('reached');
}
 // pusher
function generatePush($event,$channel,$message)
{
    $key = \config('broadcasting.connections.pusher.key');
    $secret = \config('broadcasting.connections.pusher.secret');
    $app_id = \config('broadcasting.connections.pusher.app_id');
    $body = new \stdClass();
    $body->name = $event;
    $body->channels = [$channel];
    $body->data = $message;
    $json_body = json_encode($body);
    $body_md5 = md5($json_body);
    $auth_timestamp = time();
    $auth_version = '1.0';

    function sign($string, $secret){
        return hash_hmac('sha256', $string, $secret);
    }

    $url = "http://api-us2.pusher.com/apps/".$app_id."/events?auth_key=".$key."&auth_timestamp=".$auth_timestamp."&auth_version=".$auth_version."&body_md5=".$body_md5."&auth_signature=".sign("POST\n"."/apps/".$app_id."/events\n"."auth_key=".$key."&auth_timestamp=".$auth_timestamp."&auth_version=".$auth_version."&body_md5=".$body_md5, $secret);

    $ch = curl_init();

    $headers = [
        'Content-Type: application/json;'
    ];

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $json_body);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

    // $context  = stream_context_create($options);
    $result = curl_exec($ch);
    return $result;
}
// language
function getTranslated($key)
{

    $lang                  = Session::get('locale')!=null?Session::get('locale'):'en';
    if ($lang=="en")
    {
        $row                   = \App\LanguageKey::where('key_name',$key)->with('getlang')->first();
        if ($row==null || $row->getlang==null)
            return '';
        else
        return $row->getlang->lang_original_text;
    }
    else
    {
        $row                   = \App\LanguageKey::whereHas(
                                    'getlang', function($q) use ($lang,$key){
                                    $q->where('lang',$lang);
                                })->where('key_name',$key)->with('getlang')->first();
        if ($row==null || $row->getlang==null)
            return '';
        else
        return $row->getlang->lang_translated_text;
    }

}
function getencryData($token)
{
    $secret_key =  "aMUtY.R7cn9K85w8)b;ynCxmTWqtZV?Y9XQTF8&,5XemNr5wwv?z/5[edhMyLGD&&m3jE5*pA:rQZY+,EZ`WwDk}YBY3yd2@~uJCH;rCsYx+}&sD;P]~PyW2m5Fc?&fX~aec@9%ym]...;P.L}R#LZw@2(/j@@xMce$-ygu>>X6v.C!B>}Sxc@v;:wQw/.t:}umJC3DTQ6=2Q6^fjTd7$94X5fp!nZqykLzBp#dmrhx_H=ZcxejVxw";
    $jwt = JWT::encode($token, $secret_key);
    return $jwt;
}
function decrypt11(string $jsonStr, string $passphrase)
{
    $json = json_decode($jsonStr, true);
    $salt = hex2bin($json["s"]);
    $iv = hex2bin($json["iv"]);
    $ct = base64_decode($json["ct"]);
    $concatedPassphrase = $passphrase . $salt;
    $md5 = [];
    $md5[0] = md5($concatedPassphrase, true);
    $result = $md5[0];
    for ($i = 1; $i < 3; $i++) {
        $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
        $result .= $md5[$i];
    }
    $key = substr($result, 0, 32);
    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    return json_decode($data, true);
}
function dcryptRequest($request)
{
    $secret_key =  "aMUtY.R7cn9K85w8)b;ynCxmTWqtZV?Y9XQTF8&,5XemNr5wwv?z/5[edhMyLGD&&m3jE5*pA:rQZY+,EZ`WwDk}YBY3yd2@~uJCH;rCsYx+}&sD;P]~PyW2m5Fc?&fX~aec@9%ym]...;P.L}R#LZw@2(/j@@xMce$-ygu>>X6v.C!B>}Sxc@v;:wQw/.t:}umJC3DTQ6=2Q6^fjTd7$94X5fp!nZqykLzBp#dmrhx_H=ZcxejVxw";
    $decoded = JWT::decode($request, $secret_key, array('HS256'));
    return $decoded;
}
function missionComplet($id){
    $com = UserMission::where(['mission_id'=>$id,'user_id'=>Auth::user()->id,'status'=> 1])->first();
    if (is_null($com)) {
        return 0;
    }
    $complt = $com->MissionBonus;
    $earn = DB::table('game_earnings')->where('user_id',Auth::user()->id)->sum('token');
    $spin = DB::table('game_earnings')->where('user_id',Auth::user()->id)->sum('spin');
    $circle = round(intval(@$earn)  * (1/100)) ;
    $spins = round(intval(@$spin)  * (1/100)) ;
    $tok = isset($complt->total_spin) ? $complt->total_spin : 0;
    if ($circle > $complt->amount && $spins > $tok ) {
      $data = 1;
    }else {
        $data = 0;
    }
    return $data;
}
function missionComplete($id){
    $complt = UserMission::where(['mission_id'=>$id,'user_id'=>Auth::user()->id,'status'=> 1])->first();
   return isset($complt)? $complt->status : 0;
}
function UserMissionData(){
    $earn = DB::table('game_earnings')->where('user_id',Auth::user()->id)->sum('token');
    $amount = @Auth::user()->missionStartCheck->MissionBonus->amount;
    //$dat = LoyalitySettings::
    $circle = round((intval(@$earn) / intval(isset($amount)? $amount :1)) * 100) ;
    return isset($circle)? $circle : 0;
}

function DocumentVerify($id){
    $data = DB::table("user_documents")->where(['user_id' => $id,'status'=>1])->count();
    return $data;
}
function TotalWithdraw($id){
    $data = DB::table("transactions")->where(['user_id' => $id,'type'=>'withdraw'])->get();
    return $data;
}
function lastWithdraw($id){
    $data = Transaction::where(['user_id' => $id,'type'=>'withdraw'])->orderBy('id','desc')->first();
    return $data;
}

function EligibleBonus($id){
    $profile =  DB::table("user_profiles")->where('user_id' , $id)->first();
    $t= DB::table("propersix_bonuses")
    ->select('propersix_bonuses.ex_country','propersix_bonuses.users','propersix_bonuses.status')
    ->where('status',1)
    ->where('users', 'like', '%' . $id . '%')
    ->where('ex_country', 'NOT like', '%' . $profile->country . '%')
    ->get();
    return $t;
}
function DepositBonus($id){
    $t= DB::table("propersix_bonuses")
    ->select('propersix_bonuses.ex_country','propersix_bonuses.users','propersix_bonuses.status')
    ->where('status',1)
    ->where('users', 'like', '%' . $id . '%')
    ->get();
    return $t;
}

function loyalty_badge($id){
    /*$earn = DB::table('game_earnings')->where('user_id', $id)->sum('token');*/
    /*$l_set = DB::table('loyality_settings')->first();
    if (!is_null($l_set)) {
        $percen = $l_set->rate;
    }else {
        $percen = 1;
    }*/
    /*$loyalty_amount = round(intval(@$earn)  * ($percen/100)) ;
    $spin = DB::table('game_earnings')->where('user_id', $id)->sum('spin');*/
    $userWallet = \App\ProsixUserWallet::where('user_id',$id)->first();
    $total_loyalty=$userWallet->total_loyalty;
    $loyalty_badge = DB::table('loyalities')->where('from_range','<=',$total_loyalty)->where('to_range','>=',$total_loyalty)->orderBy('id','desc')->first();
    return $loyalty_badge;
}
function transactionWallet($amount,$type,$from,$to){
// funtion to save data in prosix_transactions table
    $tr = TransactionType::where('type',$type)->first();
    if (is_null($tr)) {
        $tran_Type= new TransactionType();
    } else {
        $tran_Type = $tr;
    }

    $tran_Type->type=$type;
    $tran_Type->created_by=Auth::id();
    $tran_Type->save();
    $transaction =new ProsixTransaction();
    $transaction->user_id = Auth::user()->id;
    $transaction->amount = $amount;
    $transaction->currency = 'usd';
    $transaction->from = $from;
    $transaction->type =  $tran_Type->id;
    $transaction->to = $to;
    $transaction->created_by=Auth::id();
    $transaction->save();

}
// duplicate function for new stripe  payment via propersix.network
function transactionWallet1($amount,$type,$from,$to,$user){
// funtion to save data in prosix_transactions table
    $tr = TransactionType::where('type',$type)->first();
    if (is_null($tr)) {
        $tran_Type= new TransactionType();
    } else {
        $tran_Type = $tr;
    }

    $tran_Type->type=$type;
    $tran_Type->created_by=$user->id;
    $tran_Type->save();
    $transaction = new ProsixTransaction();
    $transaction->user_id = $user->id;
    $transaction->amount = $amount;
    $transaction->currency = 'usd';
    $transaction->from = $from;
    $transaction->type =  $tran_Type->id;
    $transaction->to = $to;
    $transaction->created_by=$user->id;
    $transaction->save();

}
function transactionWalletcoingate($amount,$type,$from,$to,$userid){
// funtion to save data in prosix_transactions table
    $profile =  DB::table("user_profiles")->where('user_id' , $userid)->first();
    $tr = TransactionType::where('type',$type)->first();
    if (is_null($tr)) {
        $tran_Type= new TransactionType();
    } else {
        $tran_Type = $tr;
    }

    $tran_Type->type=$type;
    $tran_Type->created_by=$profile->user_id;
    $tran_Type->save();
    $transaction =new ProsixTransaction();
    $transaction->user_id = $profile->user_id;
    $transaction->amount = $amount;
    $transaction->currency = 'usd';
    $transaction->from = $from;
    $transaction->type =  $tran_Type->id;
    $transaction->to = $to;
    $transaction->created_by=$profile->user_id;
    $transaction->save();


}

function Wallet($amount,$type,$from,$to){

    $wal = ProsixWalletType::where('type',$type)->first();
    if (is_null($wal)) {
        $wallet_type= new ProsixWalletType();
    } else {
        $wallet_type = $wal;
    }
    $wallet_type->type=$type;
    $wallet_type->save();
    $wallet =new ProsixWallet();
    $wallet->user_id = Auth::user()->id;
    $wallet->amount = $amount;
    $wallet->type_id =  $wallet_type->id;
    $wallet->created_by=Auth::id();
    $wallet->save();
   return true;

}
 function myWallet(){
    $data = DB::table('prosix_user_wallets')->where('user_id' , Auth::id())->first();
    return $data;
 }
 function myAccount(){
    $data = DB::table('prosix_user_wallets')->where('user_id' , Auth::id())->first();
    $data = @$data->token + @$data->free_token;
    return $data;
 }
function walletAmount($type){
    $wa_type = DB::table('prosix_wallet_types')->whereIn('type', $type)->get('id');
    $types=[];
    foreach ($wa_type as $key => $value) {
       array_push($types,$value->id);
    }
    $data = DB::table('prosix_wallets')->where('user_id' , Auth::id())->whereIn('type_id' , $types)->sum('amount');
    return $data;
}
function walletSpin(){
    $data = DB::table('accounts')->where('user_id', Auth::id())->sum('total_spin');
    return $data;
}


function logCreatedActivity($user_id = '',$logModel = '',$request = '',$log = '')
   {
       $activity = activity()
           ->causedBy($user_id)
           ->performedOn($logModel)
           ->withProperties(['key' => $request])
           ->log($log);
       $lastActivity = Activity::all()->last();

       return true;
   }

   function logUpdatedActivity($list,$before,$list_changes)
   {
       unset($list_changes['updated_at']);
       $old_keys = [];
       $old_value_array = [];
       if(empty($list_changes)){
           $changes = 'No attribute changed';
       }else{
           if(count($before)>0){

               foreach($before as $key=>$original){
                   if(array_key_exists($key,$list_changes)){

                       $old_keys[$key]=$original;
                   }
               }
           }
           $old_value_array = $old_keys;
           $changes = 'Updated with attributes '.implode(', ',array_keys($old_keys)).' with '.implode(', ',array_values($old_keys)).' to '.implode(', ',array_values($list_changes));
       }
       $properties = [
           'attributes'=>$list_changes,
           'old' =>$old_value_array
       ];

       $activity = activity()
           ->causedBy(\Auth::user())
           ->performedOn($list)
           ->withProperties($properties)
           ->log($changes.' made by '.\Auth::user()->name);

       return true;
   }
   function logDeletedActivity($list,$changeLogs)
   {
       $attributes = $this->unsetAttributes($list);
       $properties = [
           'attributes' => $attributes->toArray()
       ];

       $activity = activity()
           ->causedBy(\Auth::user())
           ->performedOn($list)
           ->withProperties($properties)
           ->log($changeLogs);

       return true;
   }

   function logLoginDetails($user)
   {
       $updated_at = Carbon::now()->format('d/m/Y H:i:s');
       $properties = [
           'attributes' =>['name'=>$user->username,'description'=>'Login into the system by '.$updated_at]
       ];

       $changes = 'User '.$user->username.' loged in into the system';
       $activity = activity()
           ->causedBy(\Auth::user())
           ->performedOn($user)
           ->withProperties($properties)
           ->log($changes);
       return true;
   }

   function UserCheck($bonus_code){
    $data = DB::table("propersix_bonuses")->select('propersix_bonuses.users','propersix_bonuses.status')
    ->where('status',1)
    ->where('bonus_code',$bonus_code)
    ->where('users', 'like', '%' . Auth::id() . '%')->count();

     return $data;
   }


   function checkIP($ip)
   {
     # code...
   }
