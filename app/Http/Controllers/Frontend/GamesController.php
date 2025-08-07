<?php

namespace App\Http\Controllers\Frontend;

use App\AddGame;
use App\Country;
use App\GameSession;
use App\ProsixUserWallet;
use App\SoftswissGameActions;
use App\SoftswissGames;
use App\SoftswissGameSession;
use App\SoftswissRollback;
use App\SoftswissRollbackActions;
use App\SoftswissTransactions;
use App\TokenCurrency;
use App\User;
use App\UserProfile;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
{
    public $user_wallet;
    public $tok;
    public $auth_token;
    public $backend_url;
    public $server_url;

    public function __construct(Request $request)
    {
        //$this->user_wallet = ProsixUserWallet::where('user_id', 636)->first();
        $this->tok         = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $this->auth_token  = request()->getHost()=="propersix.casino"?"m04f6zddo524018e":"03om5k6g806cq23h";
        $this->backend_url = request()->getHost()=="propersix.casino"?"https://casino.cur.a8r.games":"https://casino.int.a8r.games";
        $this->server_url  = request()->getHost()=="propersix.casino"?"https://propersix.casino":"http://54.151.49.67";

    }

    public function demo($gameId)
    {
        Log::error('demo reached');
        dd('reached');
        $game = SoftswissGames::whereId($gameId)->first();
        Log::error('Game Data');
        Log::info(json_encode($game));
        $agent = new Agent();
        $body = [
            'casino_id' => 'propersix',
            'game' => $game->identifier,
            'locale' => 'en',
            'ip' => request()->getHost()=="propersix.casino"?request()->ip():'119.73.115.33',
            'client_type' => $agent->isMobile()?'mobile':'desktop',
            'urls' => (object)[
                'return_url' => "http://dev.casino2/test2"
            ],

        ];

        // $body           = '{"casino_id":"","game":"","locale":"","ip":"","client_type":"","urls":"'.$retrun_links.'"}';

        // dd(json_decode(json_encode($body))->urls);
        $endpoint = $this->backend_url."/demo";

        $hash = hash_hmac('sha256', json_encode((object)$body), $this->auth_token);
        $client = new \GuzzleHttp\Client();
        $headers = [
            'content-type' => 'application/json',
            'X-REQUEST-SIGN' => $hash,
            //'X-Authorization-Key' => $this->auth_token,
        ];
        $response = $client->request('POST', $endpoint,
            [
                'verify' => false,
                'headers' => $headers,
                RequestOptions::JSON => (object)$body
            ]);
        $content            = json_decode($response->getBody());
        return redirect($content->launch_options->game_url);
        //dd(json_decode($response->getBody()));
    }

    public function startSession($gameId)
    {
        $user = Auth::user();
        $user_profile = UserProfile::where('user_id',$user->id)->first();
        $user_wallet = ProsixUserWallet::where('user_id', $user->id)->first();
        $game = SoftswissGames::whereId($gameId)->first();
        $agent = new Agent();

        $body = [
            'casino_id' => 'propersix',
            'game' => $game->identifier,
            'currency' => 'USD',
            'locale' => 'en',
            'ip' => request()->getHost()=="propersix.casino"?request()->ip():'119.73.115.33',
            'client_type' => $agent->isMobile()?'mobile':'desktop',
            'balance' => $user_wallet->usd * 100,
            'urls' => (object)[
                'return_url' => $this->server_url."/api/session-closed",
                'deposit_url' => $this->server_url."/user/deposit",
            ],
            'user' => (object)[
                'id' => $user->email,
                'email' => $user->email,
//                'external_id' => $user->id,
                'firstname' => $user->first_name,
                'lastname' => $user->last_name,
                'nickname' => $user->user_name,
                'city' => $user->city,
                'date_of_birth' => $user->dob,
                'registered_at' => $user->created_at->toDateString(),
                'gender' => ($user_profile!=null && $user_profile->count()>0)?strtolower($user_profile->gender):'m',
                'country' => $user->country!=null?strtoupper(Country::where('id',$user->country)->first()->iso2):'',
            ],

        ];

        // $body           = '{"casino_id":"","game":"","locale":"","ip":"","client_type":"","urls":"'.$retrun_links.'"}';

        // dd(json_decode(json_encode($body))->urls);
        $endpoint = $this->backend_url."/sessions";

        $hash = hash_hmac('sha256', json_encode($body), $this->auth_token);
        $client = new \GuzzleHttp\Client();
        $headers = [
            'content-type' => 'application/json',
            'X-REQUEST-SIGN' => $hash,
            //'X-Authorization-Key' => $this->auth_token,
        ];
        $response = $client->request('POST', $endpoint,
            [
                'verify' => false,
                'headers' => $headers,
                RequestOptions::JSON => (object)$body
            ]);
        $content = json_decode($response->getBody());
        if (!SoftswissGameSession::where('session_identifier', $content->session_id)->exists()) {
            $game_session = new SoftswissGameSession();
            $game_session->user_id = $user->id;
            $game_session->game_id = $gameId;
            $game_session->session_identifier = $content->session_id;
            $game_session->game_link = $content->launch_options->game_url;
            $game_session->game_detector = $content->launch_options->strategy;
            $game_session->free_spins = $user_wallet->free_spin;
            $game_session->free_token = $user_wallet->free_token;
            $game_session->token = $user_wallet->token;
            $game_session->save();
        }
       // return redirect($content->launch_options->game_url);
        $message = "softswiss";
        generatePush('playGame','receiver.'.$user->id,$message);
        return view('frontend.softswiss_games.play_game', [
            'launch_options' => json_decode($response->getBody())->launch_options,
            'sessionID' => json_decode($response->getBody())->session_id
        ]);
    }

    public function play(Request $request)
    {
        if (hash_equals($request->header('X-REQUEST-SIGN'), hash_hmac('sha256', json_encode(json_decode($request->getContent())), $this->auth_token))) {
            // get game from wallet db
            \Log::info("game :".json_decode($request->getContent())->game);
            // user wallet
            $player            = User::where('email',json_decode($request->getContent())->user_id)->first();
            $this->user_wallet = ProsixUserWallet::where('user_id',$player->id)->first();


            $game = SoftswissGames::where('identifier', json_decode($request->getContent())->game)->first();
            if ($game!=null && $game->count()>0)
            {
                // just for testing
                $game->description = \Opis\Closure\serialize(json_decode($request->getContent()));
                $game->save();
            }
            else
            {
                \Log::info("game not exists..");
            }


            $response = json_decode($request->getContent(), true);

            if (isset($response['actions'])) {
                // check that 2 bets not exceeds user balance
                $balance_exceeds       = 0;
                foreach ($response['actions'] as $action)
                {
                    if ($action['action'] == "bet")
                    {
                        $balance_exceeds+= $action['amount'];
                    }
                }
                // compare 2 bets amount with user balance
                if (($balance_exceeds/100)>$this->user_wallet->usd)
                {
                    return response()->json(['message' => "2 bits exceeds user balance", "code" => 100,'balance' => round($this->user_wallet->usd * 100)], 412);
                }
                    $transaction = [];
                    if (isset($response['finished']) && $response['finished'] == true) {
                        foreach ($response['actions'] as $action) {
                            // check duplicate actions
                            if (!SoftswissGameActions::where('action_identifier', $action['action_id'])->exists()) {
                                if ($action['action'] == "bet") {
                                    //convert user wallet usd to cents and compare with given amount
                                    if ($this->user_wallet->usd*100 == $action['amount'])
                                    {
                                        $this->user_wallet->usd = 0;
                                        $this->user_wallet->save();

                                    }
                                    else if (($this->user_wallet->usd*100) > ($action['amount']))
                                    {
                                        if (!SoftswissRollbackActions::where('original_action_id',$action['action_id'])->where('status',0)->exists())
                                        $this->user_wallet->usd   = (($this->user_wallet->usd*100) - ($action['amount']))/100;
                                    }
                                    else
                                    {
                                        return response()->json(['message' => "Insufficient Balance.", "code" => 100, 'balance' => round($this->user_wallet->usd * 100)], 412);
                                    }


                                }
                                else if ($action['action'] == "win") {
                                    if (!SoftswissRollbackActions::where('original_action_id',$action['action_id'])->where('status',0)->exists())
                                    $this->user_wallet->usd = (($this->user_wallet->usd*100) + ($action['amount']))/100;
                                }
                                // save balance in user wallet
                                $this->user_wallet->save();
                                $this->user_wallet->token = $this->tok->pley6_token * $this->user_wallet->usd;
                                $this->user_wallet->save();
                                    // save action in action table
                                $game_action = new SoftswissGameActions();
                                $game_action->game_id = $game->id;
                                $game_action->action_identifier = $action['action_id'];
                                $game_action->action_type = $action['action'];
                                $game_action->amount = $action['amount'];
                                if (isset($action['jackpot_contribution']))
                                    $game_action->jackpot_contribution = $action['jackpot_contribution'];
                                if (isset($action['jackpot_win']))
                                    $game_action->jackpot_win = $action['jackpot_win'];
                                $game_action->save();

                                // actions transactions
                                $action_transaction = new SoftswissTransactions();
                                $action_transaction->action_id = $game_action->id;
                                $action_transaction->action_identifier = $game_action->action_identifier;
                                $action_transaction->game_id = $game->id;
                                $action_transaction->save();

                                $date = date($action_transaction->created_at);
                                $date_time = new \DateTime($date);
                                $transaction1 = [
                                    "action_id" => $action['action_id'],
                                    "tx_id" => "" . $action_transaction->id . "",
                                    "processed_at" => $date_time->format(\DateTime::ATOM)
                                ];
                                array_push($transaction, $transaction1);
                            } // as transaction should be passed for duplicate entry also
                            else {
                                $date = date('y-m-d h:i:s');
                                $date_time = new \DateTime($date);
                                // fetching old transaction from transaction history
                                $old_transaction = SoftswissTransactions::where('action_identifier', $action['action_id'])->first();
                                $transaction1 = [
                                    "action_id" => $action['action_id'],
                                    "tx_id" => "" . $old_transaction->id . "",
                                    "processed_at" => $date_time->format(\DateTime::ATOM)
                                ];
                                array_push($transaction, $transaction1);
                            }
                        }
                    }
                    else {
                        foreach ($response['actions'] as $action) {
                            // check duplicate transactions
                            if (!SoftswissGameActions::where('action_identifier', $action['action_id'])->exists()) {
                                if ($action['action'] == "bet") {
                                    if (($this->user_wallet->usd*100) == ($action['amount']))
                                    {
                                        $this->user_wallet->usd = 0;
                                        $this->user_wallet->save();

                                    }
                                   else if (($this->user_wallet->usd*100) >= ($action['amount']))
                                    {
                                        if (!SoftswissRollbackActions::where('original_action_id',$action['action_id'])->where('status',0)->exists())
                                        $this->user_wallet->usd = (($this->user_wallet->usd*100) - ($action['amount']))/100;
                                    }
                                    else
                                    {
                                        return response()->json(['message' => "Insufficient Balance.", "code" => 100, 'balance' => round($this->user_wallet->usd * 100)], 412);
                                    }
                                }
                                else if ($action['action'] == "win") {
                                    if (!SoftswissRollbackActions::where('original_action_id',$action['action_id'])->where('status',0)->exists())
                                    $this->user_wallet->usd = (($this->user_wallet->usd*100) + ($action['amount']))/100;
                                }
                                $this->user_wallet->save();
                                $this->user_wallet->token = $this->tok->pley6_token * $this->user_wallet->usd;
                                $this->user_wallet->save();
                                // save action in action table
                                $game_action = new SoftswissGameActions();
                                $game_action->game_id = $game->id;
                                $game_action->action_identifier = $action['action_id'];
                                $game_action->action_type = $action['action'];
                                $game_action->amount = $action['amount'];
                                if (isset($action['jackpot_contribution']))
                                    $game_action->jackpot_contribution = $action['jackpot_contribution'];
                                if (isset($action['jackpot_win']))
                                    $game_action->jackpot_win = $action['jackpot_win'];
                                $game_action->save();

                                // actions transactions
                                $action_transaction = new SoftswissTransactions();
                                $action_transaction->action_id = $game_action->id;
                                $action_transaction->action_identifier = $game_action->action_identifier;
                                $action_transaction->game_id = $game->id;
                                $action_transaction->save();
                                $date = date($action_transaction->created_at);
                                $date_time = new \DateTime($date);
                                $transaction1 = [
                                    "action_id" => $action['action_id'],
                                    "tx_id" => "" . $action_transaction->id . "",
                                    "processed_at" => $date_time->format(\DateTime::ATOM)
                                ];
                                array_push($transaction, $transaction1);


                            } // as transaction should be passed for duplicate entry also
                            else {
                                $date = date('y-m-d h:i:s');
                                $date_time = new \DateTime($date);
                                // fetching old transaction from transaction history
                                $old_transaction = SoftswissTransactions::where('action_identifier', $action['action_id'])->first();
                                $transaction1 = [
                                    "action_id" => $action['action_id'],
                                    "tx_id" => "" . $old_transaction->id . "",
                                    "processed_at" => $date_time->format(\DateTime::ATOM)
                                ];
                                array_push($transaction, $transaction1);
                            }
                        }
                    }
//                    if (round($this->user_wallet->usd * 100) > 0) {
                        $body = [
                            'balance' => round($this->user_wallet->usd * 100) > 0 ? round($this->user_wallet->usd * 100) : 0,
                            'game_id' => $game->identifier,
                            'transactions' => $transaction
                        ];
                        $hash = hash_hmac('sha256', json_encode($body), $this->auth_token);
                        $headers = [
                            'content-type' => 'application/json',
                            'X-REQUEST-SIGN' => $hash,
                        ];
                        return response()->json($body)->withHeaders($headers);

                    //}

            }
            if (round($this->user_wallet->usd * 100) > 0) {
                $body = [
                    'balance' => round($this->user_wallet->usd * 100) > 0 ? round($this->user_wallet->usd * 100) : 0,
                    //'game_id' => 'acceptance_game_112',
                    'game_id'   => $game->identifier,
                ];
                $hash = hash_hmac('sha256', json_encode($body), $this->auth_token);

                $headers = [
                    'content-type' => 'application/json',
                    'X-REQUEST-SIGN' => $hash,
                ];
                return response()->json($body)->withHeaders($headers);
            }
        } else {
            return response()->json(['message' => "Request sign doesn't match.", "code" => 403], 403);
            //abort(403,"Request sign doesn't match.");
//            $body   = [
//                'code'    => 403,
//                'message' => "Request sign doesn't match."
//            ];
//            $hash = hash_hmac('sha256', json_encode($body), $this->auth_token);
//
//            $headers = [
//                'content-type' => 'application/json',
//                'X-REQUEST-SIGN' => $hash,
//            ];
//            return response()->json($body)->withHeaders($headers);
        }
    }

    public function rollback(Request $request)
    {
        $input = $request->all();
        if (hash_equals($request->header('X-REQUEST-SIGN'), hash_hmac('sha256', json_encode(json_decode($request->getContent())), $this->auth_token))) {
            \Log::info("game :".json_decode($request->getContent())->game);
            // testing mode
            $h          = SoftswissGames::where('id',2)->first();
            $h->description = \Opis\Closure\serialize(json_decode($request->getContent()));
            $h->save();
            $player            = User::where('email',json_decode($request->getContent())->user_id)->first();
            $this->user_wallet = ProsixUserWallet::where('user_id',$player->id)->first();
           $game = SoftswissGames::where('identifier', json_decode($request->getContent())->game)->first();
//            // just for testing
//            $game->description = \Opis\Closure\serialize($request->getContent());
//            $game->save();
            $response = json_decode($request->getContent(), true);
            // roll back table
            $rollback                      = new SoftswissRollback();
            $rollback->user_id             = isset($response['user_id'])?$response['user_id']:null;
            $rollback->currency            = isset($response['currency'])?$response['currency']:null;
            $rollback->game_identifier     = isset($response['game'])?$response['game']:null;
            $rollback->game_id             = isset($response['game_id'])?$response['game_id']:null;
            $rollback->finished            = isset($response['finished'])?$response['finished']:null;
            $rollback->actions             = isset($response['actions'])?\Opis\Closure\serialize($response['user_id']):null;
            $rollback->save();
            $transaction = [];
            if (isset($response['actions'])) {
                foreach ($response['actions'] as $action) {
                    if (!SoftswissRollbackActions::where('action_id',$action['action_id'])->exists()) {
                        // save rollback action in db
                        $roll_action = new SoftswissRollbackActions();
                        $roll_action->rollback_id = $rollback->id;
                        $roll_action->action_type = $action['action'];
                        $roll_action->action_id = $action['action_id'];
                        $roll_action->original_action_id = $action['original_action_id'];


                        if (SoftswissGameActions::where('action_identifier', $action['original_action_id'])->exists()) {
                            $roll_action->status        = 1;
                            $old_transaction = SoftswissTransactions::where('action_identifier', $action['original_action_id'])->with('getAction')->first();
                            $date = date($old_transaction->created_at);
                            $date_time = new \DateTime($date);
                            $transaction1 = [
                                "action_id" => $action['action_id'],
                                "tx_id" => "" . $old_transaction->id . "",
                                "processed_at" => $date_time->format(\DateTime::ATOM)
                            ];
                            array_push($transaction, $transaction1);
                            // revert balance and store in wallet
                            // add balance on bet
                            if ($old_transaction->getAction->action_type == "bet") {
                                $this->user_wallet->usd = (($this->user_wallet->usd*100) + ($old_transaction->getAction->amount))/100;
                            }
                            if ($old_transaction->getAction->action_type == "win") {
                                if ($this->user_wallet->usd*100<$old_transaction->getAction->amount)
                                {
                                    $this->user_wallet->usd = 0;
                                }
                                else
                                {
                                    $this->user_wallet->usd = (($this->user_wallet->usd * 100) - ($old_transaction->getAction->amount))/100;
                                }

                            }

                            $this->user_wallet->save();
                            $this->user_wallet->token = $this->tok->pley6_token * $this->user_wallet->usd;
                            $this->user_wallet->save();
                        }
                        else {
                            $roll_action->status        = 0;
                            $date = date('y-m-d h:i:s');
                            $date_time = new \DateTime($date);
                            $transaction1 = [
                                "action_id" => $action['action_id'],
                                "tx_id" => "",
                                "processed_at" => $date_time->format(\DateTime::ATOM)
                            ];
                            array_push($transaction, $transaction1);
                        }
                        $roll_action->save();
                    }
                }
            }

            $body = [
                'balance' => round($this->user_wallet->usd * 100) > 0 ? round($this->user_wallet->usd * 100) : 0,
               // 'game_id' => "".$game->id."",
                 'game_id' => $game->identifier,
                'transactions' => $transaction
            ];
            $hash = hash_hmac('sha256', json_encode($body), $this->auth_token);
            $headers = [
                'content-type' => 'application/json',
                'X-REQUEST-SIGN' => $hash,
            ];
            return response()->json($body)->withHeaders($headers);
        } else {
            return response()->json(['message' => "Request sign doesn't match.", "code" => 403], 403);
        }
    }
}
