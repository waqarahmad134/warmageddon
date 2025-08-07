<?php

namespace App\Http\Controllers\api;
use App\CoinPayment;
use App\Deposit;
use App\PropersixBonus;
use App\PushNotifications;
use App\TokenCurrency;
use App\Transaction;
use Carbon\Carbon;
use DB;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\Types\Null_;
use Session;
use App\User;
use Validator;
use App\Account;
use App\Balance;
use App\GameEarning;
use App\Notification;
use App\ProsixWallet;
use App\ProsixUserWallet;
use App\ProsixWalletType;
use App\GameSession;
use App\GameSessionChild;
use App\UserBannedGame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pro_affiliate_transaction;
use function GuzzleHttp\Psr7\str;

class UserController extends Controller
{

    function sendNotification($user_id,$amount,$dollar,$message)
    {
        $user                     = User::where('id',$user_id)->first();
        // stores notification record in table
        $push                    = new PushNotifications();
        $push->title             = 'success';
        $push->body              = 'You lost '.$amount.' $ token';
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
           $result = generatePush('DepositSuccess','receiver.'.$user->pusher_token,'your transaction of '.$amount.' ETH ('.$dollar.'$) has been completed successfully');
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
    public function updateChildSession(Request $request)
    {
        //code...
          $gSessionChild = new \App\GameSessionChild;
        $start_time = Carbon::now();
        if (isset($request->Event_encoded_data))
        {
            $data = dcryptRequest($request->Event_encoded_data);
            $inputText = $data->payload;
            $inputKey = "propersix@#zyuf%12*yh456#12sdr";
            $blockSize = 128;
            $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
            $aes->setData($inputText);
            $dec=$aes->decrypt();
            $yoo=strstr($dec, '{"');
            $original_String=$yoo;
            $data = json_decode($original_String , true );
            DB::table('game_events')->insert([
                'user_id' => $data['user_id'],
                'game_id' => $data['game_id'],
                'session_id'=> $data['session_id'],
                'event_status'=> $data['event_status'],
                'player_betperline'=> $data['player_betperline'],
                'player_paylines'=> $data['player_paylines']
            ]);
            return response()->json(['success' => 'true', 'error' => 'okay'], 200);
        }
        $data = dcryptRequest($request->encoded_data);
        $inputText = $data->payload;
        $inputKey = "propersix@#zyuf%12*yh456#12sdr";
        $blockSize = 128;
        $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
        $aes->setData($inputText);
        $dec=$aes->decrypt();
        $yoo=strstr($dec, '{"');
        $original_String=$yoo;
        $data = json_decode($original_String , true );
            //here we are using auth user id
//        dd($request->user('api'));
       /* if (!Auth::guard('web')->check())
        {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 200);
        }
       else if (Auth::guard('web')->check())
        {
            if ($data['user_id']!=Auth::guard('web')->user()->id) {

             return response()->json(['success' => false, 'error' => 'Unauthorized.'], 200);
        }

        }*/
        $data['status']=strtolower($data['status']);
        if ($data['status'] == 'loss')
        {
            $data['status']='lost';
        }
        if ($data['status'] == 'win')
        {
            $data['status']='won';
        }
            $gamesession = \App\GameSession::where('user_id', $data['user_id'])->latest('created_at')->first();
            if ($gamesession) {
                if ($gamesession->session_id != $data['session_id']) {
                    return response()->json(['success' => false, 'error' => 'You are playing another game'], 200);
                }
            }
            //$game_id  = \Session::get('game_id');
            $game_id = session('game_id');
            //$timeStamp  = \Session::get('gametimestamp');
            $timeStamp = session('gametimestamp');
           /* $userWallet = \App\ProsixUserWallet::where('user_id', $data['user_id'])->first();
            if ($data['status'] == 'won') {
                if ($data['current_credit'] != ($userWallet->token + $userWallet->free_token + $data['amount'])) {
                    return response()->json(['success' => true, 'error' => 'Refresh your game after each Transaction on your Wallet.'], 200);
                }
            }
            if ($data['status'] == 'lost') {
                if ($data['current_credit'] != ($userWallet->token + $userWallet->free_token - $data['amount'])) {
                    return response()->json(['success' => true, 'error' => 'Refresh your game after each Transaction on your Wallet.'], 200);
                }
            }*/
            //check for credit end
            $gSessionChild->session_id = $data['session_id'];
            $gSessionChild->user_id = $data['user_id'];
            $gSessionChild->game_id = $data['game_id'];
            $gSessionChild->awardedspin_left = $data['awardedspin_left'];
            $gSessionChild->game_free_spins = $data['game_free_spins'];
            $gSessionChild->total_session_bet_amount = $data['total_session_bet_amount'];
            $gSessionChild->total_paid_spins = $data['total_paid_spins'];
            $gSessionChild->current_credit = $data['current_credit'];
            $gSessionChild->payline = $data['payline'];
            $gSessionChild->bet_size = $data['bet_size'];
            $gSessionChild->spin_type = $data['spin_type'];
            $gSessionChild->status = $data['status'];
            if ($data['status'] == 'won') {
                $gSessionChild->amount_won = $data['amount'];
                $gSessionChild->amount_loss = '0';
            } else {
                $gSessionChild->amount_won = '0';
                $gSessionChild->amount_loss = $data['amount'];
            }
            $gSessionChild->save();


            if ($gSessionChild->spin_type == 'paid' AND $gSessionChild->status == 'lost') {
                $this->update_paid_loss($gSessionChild->awardedspin_left,$gSessionChild->current_credit, $gSessionChild->amount_loss, $gSessionChild->user_id, $gSessionChild->session_child_id);
            }
            if ($gSessionChild->spin_type == 'paid' AND $gSessionChild->status == 'won') {
                $this->update_paid_win($gSessionChild->awardedspin_left,$gSessionChild->current_credit, $gSessionChild->amount_won, $gSessionChild->user_id, $gSessionChild->bet_size, $gSessionChild->payline, $gSessionChild->game_free_spins);
            }

            if ($gSessionChild->spin_type == 'bonus' AND $gSessionChild->status == 'lost') {
                $this->update_bonus_loss($gSessionChild->awardedspin_left, $gSessionChild->user_id);
            }

            if ($gSessionChild->spin_type == 'bonus' AND $gSessionChild->status == 'won') {
                $this->update_bonus_win($gSessionChild->awardedspin_left, $gSessionChild->user_id, $gSessionChild->current_credit, $gSessionChild->amount_won, $gSessionChild->awardedspin_left);
            }

            if ($data['spin_type'] == 'paid') {
                $this->calculateLP($data['bet_size'], $data['payline'], $data['user_id']);
                $this->checkSpinMission($data['user_id'], $data['bet_size'], $data['payline']);
            }
        $end_time = Carbon::now();
        $diff = $start_time->diffInMilliseconds($end_time);
            return response()->json(['success' => 'true', 'error' => 'okay','start time'=>"$start_time",'end time'=>"$end_time",'processing time'=>"$diff"], 200);

    }
    function update_paid_loss($awardedspin_left,$current_credit , $amount_loss , $userId,$session_child_id)
    {
        $user = DB::table('users')
            ->select('users.pro_child')
            ->where('users.id',$userId)
            ->first();
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        if($userWallet->free_token > 0)
        {
            if($amount_loss > $userWallet->free_token)
            {
                $amount_loss_after = $amount_loss - $userWallet->free_token;
                $userWallet->free_token = 0;
                $userWallet->token = $userWallet->token - $amount_loss_after;
                $usdLoss = $amount_loss_after * ( 1 / $tok->pley6_token );
                $userWallet->usd = $userWallet->usd - $usdLoss;
                $userWallet->free_spin = $awardedspin_left;
                $userWallet->save();
                if (!empty($user->pro_child)) {
                    //code to transfer lost percentage to pro_parrent which is hotel owner etc
                    $pro_affiliate_transaction = new pro_affiliate_transaction();
                    $pro_affiliate_transaction->user_id = $userId;
                    $pro_affiliate_transaction->child_session_id=$session_child_id;
                    $pro_affiliate_transaction->token_lost= $amount_loss_after;
                    $pro_affiliate_transaction->payout='0';
                    $pro_affiliate_transaction->save();
                }
                if($current_credit == $userWallet->token + $userWallet->free_token)
                {
                    $msg = 'updation successfull and verified';
                }
                else
                {
                    $msg = 'transaction successfull but not verified';
                }
            }

            else
            {
                $userWallet->free_token = $userWallet->free_token - $amount_loss;
                $userWallet->free_spin = $awardedspin_left;
                $userWallet->save();
                if($current_credit == $userWallet->token + $userWallet->free_token)
                {
                    $msg = 'updation successfull and verified';
                }
                else
                {
                    $msg = 'transaction successfull but not verified';
                }
            }

        }
        else
        {
            $userWallet->token = $userWallet->token - $amount_loss;
            $usdLoss = $amount_loss * ( 1 / $tok->pley6_token );
            $userWallet->usd = $userWallet->usd - $usdLoss;
            $userWallet->free_spin = $awardedspin_left;
            $userWallet->save();
            if (!empty($user->pro_child)) {
                $pro_affiliate_transaction = new pro_affiliate_transaction();
                $pro_affiliate_transaction->user_id = $userId;
                $pro_affiliate_transaction->child_session_id=$session_child_id;
                $pro_affiliate_transaction->token_lost= $amount_loss;
                $pro_affiliate_transaction->payout='0';
                $pro_affiliate_transaction->save();
            }
            if($current_credit == $userWallet->token + $userWallet->free_token)
            {
                $msg = 'updation successfull and verified';
            }
            else
            {
                $msg = 'transaction successfull but not verified';
            }
        }

        return response()->json($msg, 200);
    }
    function update_paid_win($awardedspin_left,$current_credit ,$amount_won , $userId , $bet_size , $payline ,$game_free_spins)
    {
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $userWallet->token = $userWallet->token + $amount_won;
        $amountWon = $amount_won * ( 1 / $tok->pley6_token );
        $userWallet->usd = $userWallet->usd + $amountWon;
        $userWallet->free_spin = $awardedspin_left;
        $userWallet->save();
    }
    function update_bonus_loss($awardedspin_left ,$userId)
    {
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $userWallet->free_spin = $awardedspin_left;
        $userWallet->save();
    }
    function update_bonus_win($awardedspin_left ,$userId , $current_credit ,$amount_won)
    {
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $userWallet->free_spin = $awardedspin_left;
        $userWallet->token = $userWallet->token + $amount_won;
        $amountWon = $amount_won * ( 1 / $tok->pley6_token );
        $userWallet->usd = $userWallet->usd + $amountWon;
        $userWallet->save();

    }
    protected function calculateLP($bet , $payLine,$userId)
    {
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $earn = $userWallet->total_loyalty;
        $loyalty_badge = \DB::table('loyalities')->where('from_range','<=',$earn)->where('to_range','>=',$earn)->orderBy('id','desc')->first();
        $wgAmount = $bet*$payLine;
        if (isset($loyalty_badge) && $loyalty_badge->loyalty_multiplier>0)
        {
            $loyaltymultiplier=$loyalty_badge->loyalty_multiplier;
        }
        else
        {
            $loyaltymultiplier=1;
        }
        $lp = 0.1 * $wgAmount * $loyaltymultiplier;
        $userWallet->earn_loyalty = $userWallet->earn_loyalty + $lp;
        $userWallet->total_loyalty = $userWallet->total_loyalty + $lp;
        $userWallet->save();
    }
    protected function checkSpinMission($userId,$betsize,$payline)
    {
        $curDate = date('Y-m-d');
        $userMissionsPending = \App\UserMission::where('user_id',$userId)->where('status', '0')->where('mission_date',$curDate)->get();
        foreach($userMissionsPending as $userMission){
            $mission = \App\MissionBonus::find($userMission->mission_id);
            $uMission = $userMission;
            if ($uMission->spending+1 <= $mission->total_spin) {
                $uMission->spending = $uMission->spending + 1;
            }
            else
            {
                $uMission->spending = $mission->total_spin;
            }
            if ($uMission->amount_spent+($betsize * $payline) <= $mission->wager_amount) {
                $uMission->amount_spent += ($betsize * $payline);
            }
            else
            {
                $uMission->amount_spent = $mission->wager_amount;
            }
            if(($mission->total_spin != '' || $mission->total_spin != 0) && ($mission->wager_amount == '' || $mission->wager_amount == 0)){
                if ($uMission->spending == $mission->total_spin)
                {
                    $uMission->status = 1;
                    $this->transferReward($mission->id , $userId);
                }

            }
            /*$userspending = DB::table('game_session_childs')
                ->select(DB::raw('date(created_at) as datecreated'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id',$userId)
                ->whereBetween('created_at', [new Carbon($userMission->created_at), Carbon::now()->endOfDay()])
                ->where('spin_type','paid')
                ->groupBy('game_id')
                ->first();*/
            $userspending = DB::table('game_session_childs')
                ->select(DB::raw('date(created_at) as datecreated'),DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id',$userId)
                ->whereBetween('created_at', [new Carbon($userMission->created_at), Carbon::now()->endOfDay()])
                ->where('spin_type','paid')
                ->groupBy('game_id')
                ->first();

            if(($mission->total_spin == 0 || $mission->total_spin == '') && ($mission->wager_amount != '' ||  $mission->wager_amount != 0)){
                if ($userspending->wageredamount >= $mission->wager_amount ) {
                    $uMission->status = 1;
                    $this->transferReward($mission->id, $userId);
                }
            }
            if(($mission->total_spin != '' || $mission->total_spin != 0) && ($mission->wager_amount != '' ||  $mission->wager_amount != 0)){
                if ($userspending->wageredamount >= $mission->wager_amount && $uMission->spending == $mission->total_spin ) {
                    $uMission->status = 1;
                    $this->transferReward($mission->id, $userId);
                }
            }

            $uMission->save();
        }
    }
    protected function transferReward($missionID , $userId)
    {
        $mission = \App\MissionBonus::find($missionID);
        $userWallet = \App\ProsixUserWallet::where('user_id' , $userId )->first();
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();

        # code...

        if ($mission->prize == 1)
        {
            DB::table('mission_winnings_to_transfer')->insert(
                ['mission_id' => $missionID,
                    'user_id' => $userId,
                    'usd' => ($mission->amount/$tok->pley6_token),
                    'token' => $mission->amount,
                    'status' => '0'
                ]);

/*            $userWallet->free_spin +=  $mission->amount;*/
        }
        if ($mission->prize == 2)
        {
            DB::table('mission_winnings_to_transfer')->insert(
                ['mission_id' => $missionID,
                    'user_id' => $userId,
                    'free_spin' => $mission->amount,
                    'status' => '0'
                ]);

/*            $userWallet->usd+=($mission->amount/$tok->pley6_token);
            $userWallet->token += $mission->amount;*/
        }
        if ($mission->prize == 3)
        {
            DB::table('mission_winnings_to_transfer')->insert(
                ['mission_id' => $missionID,
                    'user_id' => $userId,
                    'usd' => ($mission->amount/$tok->pley6_token),
                    'token' => $mission->amount,
                    'free_spin' => $mission->amount,
                    'status' => '0'
                ]);
           /* $userWallet->usd+=($mission->amount/$tok->pley6_token);
            $userWallet->free_spin +=  $mission->amount;
            $userWallet->token += $mission->amount;*/
        }
/*        $userWallet->save();*/
    }
    function customerProfile($id=null , Request $request){

        if (Auth::guard('web')->check()) {
            //$gameId = $request->session()->get('game_id');
            //$time_stamp = $request->session()->get('time_stamp');
            $gameId  = Redis::get('game_id');
            $time_stamp  = Redis::get('gametimestamp');
            $user = DB::table('users')
                /*->join('accounts', 'users.id', '=', 'accounts.user_id')*/
                ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                ->select('users.id as user_id','users.user_name as username', 'user_profiles.base_image as profile_pic')
                ->where('users.id',Auth::user()->id)
                ->first();
            $game_events=DB::table('game_events')->where('game_events.user_id',Auth::user()->id)->where('game_events.game_id',$gameId)->latest('id')->first();
            $paytable = DB::table('add_games')->where('id', $gameId)->first();
            //to get bet_size and payline of latest paind spin
            $game_free_spins=DB::table('game_session_childs')->where('game_session_childs.user_id',Auth::user()->id)->where('game_session_childs.game_id',$gameId)->where('game_session_childs.spin_type','paid')->latest('session_child_id')->first();
            //to get game_free_spins of latest row without restriction of paid
            $game_free_spins_latest=DB::table('game_session_childs')->where('game_session_childs.user_id',Auth::user()->id)->where('game_session_childs.game_id',$gameId)->latest('session_child_id')->first();
            if ($game_free_spins)
            {
                $player_betperline = $game_free_spins->bet_size;
                $player_paylines = $game_free_spins->payline;
                $bonus_spins=$game_free_spins_latest->game_free_spins;
            }
            else
            {
                $bonus_spins=0;
                $player_betperline = 1;
                $player_paylines = 25;
            }
            if ($game_events)
            {
                $event_status = $game_events->event_status;
            }
            else
            {
                $event_status = '';
            }
            $data = ProsixUserWallet::where('user_id',Auth::id())->first();

            $gSession = new \App\GameSession;
            $gSession->user_id = $data->user_id;
            $gSession->game_id = $gameId;
            $gSession->free_spin = $data->free_spin;
            $gSession->free_token = $data->free_token;
            $gSession->token = $data->token;
            $gSession->save();
            $userDetail=[
                'game_id'=>(string)$gameId,
                'AwardedSpins'=>(int)$data->free_spin,
                'user_id' =>(int)Auth::id(),
                'token' =>(int)$data->token + $data->free_token,
                'session_id' =>(int)$gSession->session_id,
                'gametimestamp' =>(string)$time_stamp,
                'in_activity_timer' =>(60*5),
                'nakha' => (float)$paytable->nakha,
                'nakha_bashe_kana' =>(bool)$paytable->nakha_bashe_kana,
                'bonus_spins' => (int)$bonus_spins,
                'event_status' =>$event_status,
                'player_betperline' =>(int)$player_betperline,
                'player_paylines' =>(int)$player_paylines,
                'pay_data'=>is_null($paytable->pay_data) || empty($paytable->pay_data) ? '500,100,45/250,80,40/200,70,35/100,60,30/80,50,25/60,45,20/50,40,15/40,30,10/30,25,10/150,100,50/18,12,7/64,10,5' : (string)$paytable->pay_data,
                'prob_data'=>is_null($paytable->prob_data) || empty($paytable->prob_data) ? '7,7,8,9,10,10,13,13,16,3,2,2' : (string)$paytable->prob_data,
                ];
        }else{

            $userDetail = [
                'AwardedSpins'=> 100,
                'user_id' => 'demo-440',
                'username' => 'demo-user',
                'token' => 999,
                'profile_pic' => 'user/profile/avatar.png',
                'session_id' => '1',
                'game_id'=>'1',
                'gametimestamp' => time(),
                'in_activity_timer' =>  (60*5),
                'nakha' => (float)96,
                'nakha_bashe_kana' => (bool)true,
                'bonus_spins' => (int)'',
                'event_status' => 'test',
                'player_betperline' => (int)10,
                'player_paylines' => (int)10,
            ];
        }
        /*$user = getencryData($userDetail);
        $inputText = $user;
        $inputKey = "propersix@#zyuf%12*yh456#12sdr";
        $blockSize = 128;
        $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
        $enc = $aes->encrypt();
        $aes->setData($enc);
        $dec=$aes->decrypt();*/
        //var_dump($userDetail);
        $inputText = json_encode($userDetail,JSON_UNESCAPED_SLASHES);
        $inputText = '1234567890123456'.$inputText;
        $inputKey = "propersix@#zyuf%12*yh456#12sdr";
        $blockSize = 128;
        $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
        $enc = $aes->encrypt();
        $payload = [
            'payload'=> $enc,
        ];
        $user = getencryData($payload);

        //dd($this->testDecryption($user));

        /*
        echo "After encryption: ".$enc."<br/>";
        echo "After decryption: ".$dec."<br/>";*/
        return response()->json($user ,  200,[],JSON_UNESCAPED_SLASHES);
    }

    private function testDecryption($key){
        $data = dcryptRequest($key);
        $inputText = $data->payload;
        $inputKey = "propersix@#zyuf%12*yh456#12sdr";
        $blockSize = 128;
        $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
        $aes->setData($inputText);
        $dec=$aes->decrypt();
        $yoo=strstr($dec, '{"');
        $original_String=$yoo;
        return  json_decode($original_String , true );
    }
    // unique reference key
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
        return User::whereRef_key($number)->exists();
    }
    // pusher token
    function generatePusherToken()
    {
        $number              = str_random(10);
        if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
        {
            return $this->generatePusherToken();
        }
        else
        {
           return $number;
        }
    }
    public function register(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'username'  => 'required', 'string', 'max:255','unique:user_profiles',
            'email'     => 'required|string|email',
            'password'  => 'required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $input                   = $request->all();
        $user                    = new User;
        $user->user_name         = strip_tags($input['username']);
        $user->email             = strip_tags($input['email']);
       // $user->dob               = strip_tags(date('Y-m-d', strtotime($data['dob'])));
       // $user->country=strip_tags($data['country']);
//        $user->country_code=+92;
       // $user->country_code=strip_tags($data['phoneField1_phoneCode']);
        $user->phone            = Ltrim($input['phone'],0);
        $user->password         = Hash::make(strip_tags($input['password']));
        //$user->ip_address       = \Request::ip();
        //$user->pro_child = strip_tags($data['pro_child']);
        $user->ref_key         = $this->generateReferenceKey();
        $user->pusher_token    = $this->generatePusherToken();
        $user->save();

        $user_profile            = new \App\UserProfile;
        $user_profile->user_id   = $user->id;
        //$user_profile->first_name=strip_tags($data['first_name']);
        //$user_profile->last_name=strip_tags($data['last_name']);
        $user_profile->username   = strip_tags($data['username']);
        //$user_profile->gender=strip_tags($data['gender']);
        $user_profile->base_image ='user/profile/avatar_new.png';
        // $user_profile->country = strip_tags($data['country']);
        // $user_profile->state = strip_tags($data['state']);
        // $user_profile->zipcode =strip_tags($data['zipcode']);
        // $user_profile->phone_number =strip_tags($data['phone']);
        // $user_profile->address =strip_tags($data['address']);
        // $user_profile->date_of_birth =date('Y-m-d', strtotime(strip_tags($data['dob'])));
        $user_profile->save();

        $earning_game = new \App\GameEarning;
        $earning_game->user_id=$user->id;
        $earning_game->save();

        $wallet = new \App\ProsixUserWallet;
        $wallet->user_id=$user->id;
        $wallet->spin=0;
        $wallet->free_spin=0;
        $wallet->save();

        $registerBounusDetail = \App\PropersixBonus::where('type','registration')->where('status',1)->first();
        if(!$registerBounusDetail){
            //account
            $role_r = Role::where('name', '=','User')->firstOrFail();
            $user->assignRole($role_r);
            $verifyUser = \App\VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);
        // Mail::to($user->email)->send(new VerifyMail($user));

             if(GeneralSetting::whereId(1)->first()->email_verification==1)
             {
                 Mail::send('mail.email_verify', [
                     'username'      => $user->user_name,
                     'user_token'    => $user->ref_key,
                     'verify_url'     => url('user/verify',$verifyUser->token),
                 ], function($message) use($data){
                     $message->subject('ProperSix email verification');
                     $message->to($data['email']);
                 });
             }


             return response()->json(['msg' => 'success','user' => $user], 200);
        }
//account
        $role_r = Role::where('name', '=','User')->firstOrFail();
        $user->assignRole($role_r);

        $verifyUser = \App\VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

       // Mail::to($user->email)->send(new VerifyMail($user));

        if(GeneralSetting::whereId(1)->first()->email_verification==1)
        {
            Mail::send('mail.email_verify', [
                'username'      => $user->user_name,
                'user_token'    => $user->ref_key,
                'verify_url'     => url('user/verify',$verifyUser->token),
            ], function($message) use($data){
                $message->subject('ProperSix email verification');
                $message->to($data['email']);
            });
        }
        return response()->json(['msg' => 'success','user' => $user], 200);
    }
    public function login(Request $request)
    {
        /* $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } */

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){

            return response()->json(['error' => 'Unauthorised'], 401);
        }
        $user = $request->user();

        $token =  $user->createToken('token')->accessToken;
        $data='success';
         return response()->json(['success' => true, 'token' => 'Bearer '.$token, 'user' => $data], 200);
    }


    //logout
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }


    }

    public function Bonus_Winnings(Request $request)
    {
        # code...
        /*$data = dcryptRequest($request->bonus_info);
        $data = json_decode( json_encode($data) , true );*/

        //$game_id  = \Session::get('game_id');
        $game_id = session('game_id');
        //$timeStamp  = \Session::get('gametimestamp');
        $timeStamp = session('gametimestamp');
        // if($game_id != $data['game_id'] || $timeStamp != $data['gametimestamp'] ){
        //     return response()->json(['success'=>false , 'error'=>'You are playing another game'] , 200);
        // }
      //  ->where('game_id', $data['game_id'])
        $data = dcryptRequest($request->bonus_info);
        $inputText = $data->payload;
        $inputKey = "propersix@#zyuf%12*yh456#12sdr";
        $blockSize = 128;
        $aes = new AES($inputText, $inputKey, $blockSize,'CBC');
        $aes->setData($inputText);
        $dec=$aes->decrypt();
        $yoo=strstr($dec, '{"');
        $original_String=$yoo;
        $data = json_decode($original_String , true );
        $gamesession = \App\GameSession::where('user_id' , $data['user_id'])->latest('created_at')->first();
        if($gamesession){
            if($gamesession->session_id != $data['session_id']){
                return response()->json(['success'=>false , 'error'=>'You are playing another game.'] , 200);
            }
        }
        //check for credit
        /*$userWallet = \App\ProsixUserWallet::where('user_id' , $data['user_id'] )->first();
            if ($data['current_credit'] != ($userWallet->token+$userWallet->free_token+$data['bonus_amount']))
            {
                return response()->json(['success'=>false , 'error'=>'Refresh your game after each Transaction on your Wallet.'] , 200);
            }*/

        //check for credit end
        $gSessionChild = new \App\GameSessionChild;
        $gSessionChild->session_id = $data['session_id'];
        $gSessionChild->user_id = $data['user_id'];
        $gSessionChild->game_id = $data['game_id'];
        $gSessionChild->current_credit = $data['current_credit'];
        $gSessionChild->status = 'won';
        $gSessionChild->amount_won = $data['bonus_amount'];
        $gSessionChild->save();
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $amountWon = $gSessionChild->amount_won * ( 1 / $tok->pley6_token );
		$userWallet = \App\ProsixUserWallet::where('user_id' , $data['user_id'] )->first();
		$userWallet->token = $userWallet->token + $gSessionChild->amount_won;
        $userWallet->usd = $userWallet->usd + $amountWon;
		$userWallet->save();
        return response()->json(['success'=>'true' , 'error'=>'Okay'],200);
    }

    public function BanUserGame(Request $request)
    {
        # code...
       /* for now we are using old ban process
       $userBannedGame = new \App\UserBannedGame;
        $userBannedGame->user_id = $request->user_id;
        $userBannedGame->game_id = $request->game_id;
        $userBannedGame->status = $request->status;
        $userBannedGame->save();
*/
        return response()->json(['success'=>'true' , 'error'=>'Okay']);
    }
    function tokenUpdate(Request $request){
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user=User::find($request->id)->account;
        $user->total=floatval($request->token);
        $user->save();
/*        $user=Account::where('user_id',$request->id)->select('user_id as id','total as token')->get();*/
        return response()->json($user, 200);
    }

    function spinUpdate(Request $request){
        $validator = \Validator::make($request->all(), [
            'SpinLeft' => 'required',
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user=User::find($request->id)->account;
        $user->total_spin=intval($request->SpinLeft);
        $user->save();
/*        $user=Account::where('user_id',$request->id)->select('user_id as id','total_spin as AwardedSpinsLeft')->get();*/
        return response()->json($user, 200);
    }

    /*function allToken(){
        $data['user'] = User::where(['phone_verification'=>1])->count();
        $data['all_token'] = Account::sum('total');
        return response()->json($data, 200);
    }*/
    function BuyToken(){
        try {
            $user = DB::table('users')
            ->join('accounts', 'users.id', '=', 'accounts.user_id')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->select('users.id as user_id','users.user_name as username', 'accounts.total as token', 'users.email as email')
            ->where('users.id',Auth::user()->id)
            ->first();
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'sorry not found'],201);
        }

    }

    function tokenProfit(Request $r){

        $validator = \Validator::make($r->all(), [
            'CasinoProfit' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {
           /*  $user=User::find($r->id);
            $acc=$user->account;
            $acc->total=$acc->total - floatval($r->CasinoProfit);
            $acc->save();
            $system_token = Account::where('user_id',1)->first();
            $system_token->total=$system_token->total + floatval($r->CasinoProfit);
            $system_token->save(); */

            $type = 'game_lost';
            $from = $r->id;
            $to ='casino';
            $amount = floatval($r->CasinoProfit);
           // Wallet($amount,$type,$from,$to);

            $notification=new Notification;
            $notification->user_id = $r->id;
            $notification->message= getTranslated('token_lost1'). $r->CasinoProfit . getTranslated('token_lost2');
            $notification->save();

            $wal = ProsixWalletType::where('type', $type)->first();
            if (is_null($wal)) {
                $wallet_type= new ProsixWalletType();
            } else {
                $wallet_type = $wal;
            }
            $wallet_type->type= $type;
            $wallet_type->save();

            $wallet =new ProsixWallet();
            $wallet->user_id = $r->id;
            $wallet->amount = $amount;
            $wallet->type_id =  $wallet_type->id;
            $wallet->created_by = $r->id;
            $wallet->save();

            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=> $r->id]);
            $userWallet->token= $userWallet->token - $amount;
            $userWallet->type_id=$wallet_type->id;
            $userWallet->save();

            $AdminWallet=ProsixUserWallet::where('user_id',1)->first();
            $AdminWallet->token= $AdminWallet->token + $amount;
            $AdminWallet->type_id=$wallet_type->id;
            $AdminWallet->save();

            $user_id  =  $r->id;
            $logModel = $userWallet;
            $request = $userWallet;
            $log =  $type;
            logCreatedActivity($user_id,$logModel,$request,$log);

            return response()->json(['sucess'=>' You loss $'.$r->CasinoProfit], 200);
       } catch (\Exception $e) {
            return response()->json(['error'=>'Please try again'],201);
        }

    }
    function tokenLoss(Request $r){

        $validator = \Validator::make($r->all(), [
            'CasinoLoss' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {


           /*  $user=User::find($r->id);
            $acc=$user->account;
            $acc->total=$acc->total+floatval($r->CasinoLoss);
            $acc->save();

            $system_token = Account::where('user_id',1)->first();
            $system_token->total=$system_token->total - floatval($r->CasinoLoss);
            $system_token->save(); */

            $notification=new Notification;
            $notification->user_id=$r->id;
            $notification->message='You won '. $r->CasinoLoss .'$ token';
            $notification->save();

            $type = 'game_won';
            $from = $r->id;
            $to ='casino';
            $amount = intval($r->CasinoLoss);
            $wal = ProsixWalletType::where('type', $type)->first();
            if (is_null($wal)) {
                $wallet_type= new ProsixWalletType();
            } else {
                $wallet_type = $wal;
            }
            $wallet_type->type= $type;
            $wallet_type->save();

            $wallet =new ProsixWallet();
            $wallet->user_id = $r->id;
            $wallet->amount = $amount;
            $wallet->type_id =  $wallet_type->id;
            $wallet->created_by = $r->id;
            $wallet->save();

            $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=> $r->id]);
            $userWallet->token= $userWallet->token + $amount;
            $userWallet->type_id=$wallet_type->id;
            $userWallet->save();

            $AdminWallet=ProsixUserWallet::where('user_id',1)->first();
            $AdminWallet->token= $AdminWallet->token - $amount;
            $AdminWallet->type_id=$wallet_type->id;
            $AdminWallet->save();
            $user_id  = $r->id;
            $logModel = $userWallet;
            $request = $userWallet;
            $log =  $type;
            logCreatedActivity($user_id,$logModel,$request,$log);

            return response()->json(['sucess'=>' You won $'.$r->CasinoLoss], 200);
       } catch (\Exception $e) {
        //return response()->json($r->all());
            return response()->json(['error'=>'Please try again'],201);
        }

    }

/*    function SystemToken(){
        try{
         $profit = Balance::where('amount_sign','l')->sum('balance');
         $loss = Balance::where('amount_sign','i')->sum('balance');
         $token = $profit - $loss;
         $alltoken = Account::where('user_id','!=',1)->sum('total');
         $system_token = Account::where('user_id',1)->first();
         if ($token < $system_token->admin_total) {
            $msg = [
                'CasinoProfitstate' => 'InProfit'
            ];
         }else{
            $msg = [
                'CasinoProfitstate' => 'InLoss'
            ];
         }

          $number = rand(0,1);

         if($number == 0) {
            $msg = [
                'CasinoProfitstate' => 'InProfit'
            ];
         }else{
            $msg = [
                'CasinoProfitstate' => 'InLoss'
            ];
         }
         return response()->json($msg, 200);
        } catch (\Exception $e) {
            //return response()->json($r->all());
                return response()->json(['error'=>'Please try again'],201);
            }
    }*/

    function userBan(Request $r){
        $validator = \Validator::make($r->all(), [
            'PlayerStatus' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try{
         $user = User::findOrFail($r->id);
          if(@$r->PlayerPlayStatus == 'PlayerBanned'){
              $user->status = 0;
              $user->save();
              $msg=[
                  'id' => $user->id,
                  'PlayerPlayStatus' => 'PlayerBanned'
              ];
          }
          else {
             if($user->status == 1){
                $msg=[
                    'id' => $user->id,
                    'PlayerPlayStatus' => 'PlayerCleared'
                ];
             }else{
                $msg=[
                    'id' => $user->id,
                    'PlayerPlayStatus' => 'PlayerBanned'
                ];
             }
          }

         return response()->json($msg, 200);

        } catch (\Exception $e) {
           // return response()->json($e);
                return response()->json(['error'=>'Please try again'],400);
            }
    }

    function GamePlayStatus(){
        //\Cache::get('PlayModeState')['id']
    return response()->json( Session::get('lol'), 200);
        try {

            $msg =[
                'PlayModeState' => Redis::get('PlayModeState')
            ];
            if (Redis::exists('PlayModeState')) {
                return response()->json($msg, 200);
            }
            else {
                $msg =[
                    'PlayModeState' => 'no mode'
                ];
                return response()->json($msg, 200);
            }
        } catch (\Exception $e) {
                 return response()->json(['error'=>'Please try again'],400);
             }
    }
    function GameId(){
        try {
            if (Session::get('game_id')) {
                $msg =[
                    'game_id' => Session::get('game_id')
                ];
                return response()->json($msg, 200);
            }
            else {
                $msg =[
                    'game_id' => 0
                ];
                return response()->json($msg, 200);
            }
        } catch (\Exception $e) {
                 return response()->json(['error'=>'Please try again'],400);
             }
    }

    function Gameinfo(Request $r){
        $validator = \Validator::make($r->all(), [
            'user_id' => 'required',
            'game_id' => 'required',
            'spin' => 'required',
            'token' => 'required',
            'betsize' => 'required',
            'line' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try{
            $loyal = LoyalitySettings::find($r->game_id);
            if (is_null($loyal)) {
                $token = $r->token * 0.01;
            }else {
                $token = $r->token * (100/$loyal->rate);
            }
            $data = new GameEarning();
            $data->user_id = $r->user_id;
            $data->game_id = $r->game_id;
            $data->token = $token;
            $data->spin = $r->spin;
            $data->betsize = $r->betsize;
            $data->line = $r->line;
            $data->save();

            /*$acc= Account::where('user_id',$r->id)->first();
            $acc->total_spin=$acc->total_spin+floatval( $r->spin);
            $acc->save();*/

            /*$system_token = Account::where('user_id',1)->first();
            $system_token->total_spin=$system_token->total_spin - floatval( $r->spin);
            $system_token->save();*/

            return response()->json('success', 200);
        } catch (\Exception $e) {
            return response()->json($e, 200);
            return response()->json(['error'=>'Please try again'],400);
        }
    }

    public function backend_status_update(Request $request)
    {
        //echo 'hi';die();
        # code...
        $validator = \Validator::make($request->all(), [
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $backendstatus=$request->status;
        $comments     = $request->comments;
        $queryState=DB::table('backend')->insert(
            [
                'status'     => $backendstatus,
                 'comments'  => $comments,

                ]
        );
        if($queryState) {
            return response()->json('status updated Successfully', 200);
            // the query succeed
        } else {
            return response()->json('status update Failed', 200);
            // the query failed
        }

    }
    public function backend_status(Request $request)
    {
        $last_row = DB::table('backend')->latest()->first();
        return response()->json($last_row->status ,  200);

    }
    // casino api's haroon
    public function get_casino_data(Request $request)
    {
        if($request->getHttpHost()!="http://3.21.125.65")
        {
            abort(401,"Not Found");
        }
       $loggedin_users     = DB::table('users')->select('users.*')->get();
        $deposits          = DB::table('deposits')->select('deposits.*')->get();
        $withdraws  	   = DB::table('withdraws')->select('withdraws.*')->get();
        $add_games  	   = DB::table('add_games')
            ->select('add_games.*', \Illuminate\Support\Facades\DB::raw('count(game_id) as total_sessions'))
            ->join('game_sessions','game_sessions.game_id','=','add_games.id')
            ->groupBy('id')
            ->get();
        $child_games =  DB::table('add_games')
            ->select('add_games.*', DB::raw('SUM(bet_size*payline) as betsize'),DB::raw('count(game_id) as total_sessions'))
            ->join('game_session_childs','game_session_childs.game_id','=','add_games.id')
            ->groupBy('game_id')
            ->get();

        return response()->json([
            'deposits'          => getencryData($deposits),
            'withdraws'         => getencryData($withdraws),
            'add_games'         => getencryData($add_games),
            'child_games'       => getencryData($child_games),
            'loggedin_users'    => getencryData($loggedin_users)
          ]);
    }
    public function filter_casino_data(Request $request)
    {
        $input                              = $request->all();
        if($request->getHttpHost()!="http://3.21.125.65")
        {
            abort(401,"Not Found");
        }
        if($input['btn_name']=="deposit_filter")
        {
            $table                          = 'deposits';
            switch ($input['data_type']){
                case 'weekly':
                    $result                 = DB::table($table)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    break;
                case 'monthly' :
                    $result                 = DB::table($table)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
                    break;
                default :
                    $result                 = DB::table($table)->get();
                    break;
            }
            return response()->json([
                'table'                     => $table,
                'result'                   => $result
            ]);
        }
        else if($input['btn_name']=="withdraw_filter")
        {
            $table                          = 'withdraws';
            switch ($input['data_type']){
                case 'weekly':
                    $result                 = DB::table($table)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                    break;
                case 'monthly' :
                    $result                 = DB::table($table)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
                    break;
                default :
                    $result                 = DB::table($table)->get();
                    break;
            }
            return response()->json([
                'table'                     => $table,
                'result'                   => $result
            ]);
        }
        else if($input['btn_name']=="ags_filter")
        {
            $table                          = 'game_sessions';
            switch ($input['data_type']){
                case 'weekly':
                    $result                 =  DB::table('add_games')
                                                ->select('add_games.*', \Illuminate\Support\Facades\DB::raw('count(game_id) as total_sessions'))
                                                ->join('game_sessions','game_sessions.game_id','=','add_games.id')
                                                ->whereBetween('game_sessions.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                ->groupBy('id')
                                                ->get();
                    break;
                case 'monthly' :
                    $result                 =  DB::table('add_games')
                                                ->select('add_games.*', \Illuminate\Support\Facades\DB::raw('count(game_id) as total_sessions'))
                                                ->join('game_sessions','game_sessions.game_id','=','add_games.id')
                                                ->whereBetween('game_sessions.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                                ->groupBy('id')
                                                ->get();
                    break;
                default :
                    $result                 =  DB::table('add_games')
                                                ->select('add_games.*', \Illuminate\Support\Facades\DB::raw('count(game_id) as total_sessions'))
                                                ->join('game_sessions','game_sessions.game_id','=','add_games.id')
                                                ->groupBy('id')
                                                ->get();
                    break;
            }
            return response()->json([
                'table'                     => $table,
                'result'                   => $result
            ]);
        }
        else if($input['btn_name']=="cgs_filter")
        {
            $table                          = 'game_session_childs';
            switch ($input['data_type']){
                case 'weekly':
                    $result                   =  DB::table('add_games')
                                                       ->select('add_games.*', DB::raw('SUM(bet_size*payline) as betsize'),DB::raw('count(game_id) as total_sessions'))
                                                        ->join('game_session_childs','game_session_childs.game_id','=','add_games.id')
                                                        ->whereBetween('game_session_childs.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                                        ->groupBy('game_id')
                                                        ->get();
                    break;
                case 'monthly' :
                    $result                   =  DB::table('add_games')
                                                    ->select('add_games.*', DB::raw('SUM(bet_size*payline) as betsize'),DB::raw('count(game_id) as total_sessions'))
                                                    ->join('game_session_childs','game_session_childs.game_id','=','add_games.id')
                                                    ->whereBetween('game_session_childs.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                                    ->groupBy('game_id')
                                                    ->get();
                    break;
                default :
                    $result                   =  DB::table('add_games')
                                                    ->select('add_games.*', DB::raw('SUM(bet_size*payline) as betsize'),DB::raw('count(game_id) as total_sessions'))
                                                    ->join('game_session_childs','game_session_childs.game_id','=','add_games.id')
                                                    ->groupBy('game_id')
                                                    ->get();
                    break;
            }
            return response()->json([
                'table'                     => $table,
                'result'                   => $result
            ]);
        }
        $add_games  = DB::table('add_games')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
    }
    public function get_auth(Request $request)
    {
        dd(Auth::guard('web')->user()->id);
    }
}
/**
Aes encryption
 */
class AES {

    protected $key;
    protected $data;
    protected $method;
    /**
     * Available OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
     *
     * @var type $options
     */
    protected $options =0;
    /**
     *
     * @param type $data
     * @param type $key
     * @param type $blockSize
     * @param type $mode
     */
    function __construct($data = null, $key = null, $blockSize = null, $mode = 'CBC') {
        $this->setData($data);
        $this->setKey($key);
        $this->setMethode($blockSize, $mode);
    }
    /**
     *
     * @param type $data
     */
    public function setData($data) {
        $this->data = $data;
    }
    /**
     *
     * @param type $key
     */
    public function setKey($key) {
        $this->key = $key;
    }
    /**
     * CBC 128 192 256
    CBC-HMAC-SHA1 128 256
    CBC-HMAC-SHA256 128 256
    CFB 128 192 256
    CFB1 128 192 256
    CFB8 128 192 256
    CTR 128 192 256
    ECB 128 192 256
    OFB 128 192 256
    XTS 128 256
     * @param type $blockSize
     * @param type $mode
     */
    public function setMethode($blockSize, $mode = 'CBC') {
        if($blockSize==192 && in_array('', array('CBC-HMAC-SHA1','CBC-HMAC-SHA256','XTS'))){
            $this->method=null;
            throw new Exception('Invlid block size and mode combination!');
        }
        $this->method = 'AES-' . $blockSize . '-' . $mode;
    }
    /**
     *
     * @return boolean
     */
    public function validateParams() {
        if ($this->data != null &&
            $this->method != null ) {
            return true;
        } else {
            return FALSE;
        }
    }
//it must be the same when you encrypt and decrypt
    protected function getIV() {
        return '1234567890123456';
        //return mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
    }
    /**
     * @return type
     * @throws Exception
     */
    public function encrypt() {
        if ($this->validateParams()) {
            return trim(openssl_encrypt($this->data, $this->method, $this->key, $this->options,$this->getIV()));
        } else {
            throw new Exception('Invlid params!');
        }
    }
    /**
     *
     * @return type
     * @throws Exception
     */
    public function decrypt() {
        if ($this->validateParams()) {
            $ret=openssl_decrypt($this->data, $this->method, $this->key, $this->options,$this->getIV());

            return   trim($ret);
        } else {
            throw new Exception('Invlid params!');
        }
    }
}
