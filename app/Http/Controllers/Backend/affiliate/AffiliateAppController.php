<?php

namespace App\Http\Controllers\backend\affiliate;

use App\AffiliateApiHistory;
use App\AffiliateApiSetting;
use App\GameSessionChild;
use App\TokenCurrency;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Session;

class AffiliateAppController extends Controller
{
    private $settings;
    private $stag = null;
    private $key = null;
    private $secret = null;
    public  function __construct(Request $request)
    {
        $this->settings         = AffiliateApiSetting::where('id',1)->first();
        $this->stag             = Session::has('affiliate_session') ? $request->session()->get('affiliate_session')->stag : null;
        $this->key              = Config::get('services.affilka.host')=="propersix"?Config::get('services.affilka.key'):'cd07122b33c2c9a871fd5a8af7fe090a';
        $this->secret           = Config::get('services.affilka.host')=="propersix"?Config::get('services.affilka.secret'):'dcffba051c759fada927e2d909defc8547b387fd91b20e783d7d4daf99a62434';
    }
    // get partner list
    public function partner_list()
    {
        if ($this->settings->partner_list==1)
        {
            $apihistory = new AffiliateApiHistory();
            try {
                $vars = 'tags: ["12985_6040dd7414c4c63d65a5cc31"]';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/partners?tags[]=12985_6040dd7414c4c63d65a5cc31";
                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('GET', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                    ]);
                $apihistory->api_type = "partners list";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getBody()));
            } catch (\Exception $e) {
                $apihistory->api_type = "partners";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return $e->getCode();

            }
        }

    }
   // import or update casino players
    public function make_player($apihistory,$fun,Request $request)
   {
       if ($this->settings->player_import==1)
       {
       //try {
            // stag will be get from url

            $vars = json_encode(\Opis\Closure\unserialize($apihistory->data));
            if (Config::get('services.affilka.host')=="propersix")
            {
                $endpoint = "https://3p-partners.softswiss.net/api/v1/players";
            }
            else
            {
                $endpoint = "https://devaff.softswiss.net/api/v1/players";
            }
            $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
            $client = new \GuzzleHttp\Client();
            $headers = [
                'content-type' => 'application/json',
                'X-Authorization-Sign' => $hash,
                'X-Authorization-Key' => $this->key,
            ];

            $response = $client->request('POST', $endpoint,
                [
                    'verify' => false,
                    'headers' => $headers,
                    RequestOptions::JSON => ['players' => json_decode($vars)->players]
                ]);

            $apihistory->api_type = "import player";
            $apihistory->source_fun = "data sent to ".$endpoint;
            $apihistory->responseCode = json_decode($response->getStatusCode());
            $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
            $apihistory->status       = 1;
            $apihistory->save();
           \Log::info("data sent to ".$endpoint);
           // $request->session()->forget('affiliate_session');
            return response()->json(json_decode($response->getBody()));
//        } catch (\Exception $e) {
//            $apihistory->api_type = "import player";
//            $apihistory->source_fun = $fun;
//            $apihistory->responseCode = $e->getCode();
//            $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
//            $apihistory->status       = 1;
//            $apihistory->save();
//            return response()->json($e->getCode());
//
//        }
    }
    else
    {
        return  0;
    }

   }
   // mark player as disable
    public function mark_player_disable($user,$fun)
    {
        if ($this->settings->player_disable_mark==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            $history_check                       = AffiliateApiHistory::where('user_id',$user->id)
                                                                     ->first();
            if ($history_check!=null && $history_check->count()>0)
            {
                try {
                    // stag will be get from player view list
                    $vars = '{"tags":["'.$history_check->stag.'"]}';
                    $endpoint = "https://3p-partners.softswiss.net/api/v1/players/mark_as_disabled";

                    $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                    $client = new \GuzzleHttp\Client();
                    $headers = [
                        'content-type' => 'application/json',
                        'X-Authorization-Sign' => $hash,
                        'X-Authorization-Key' => $this->key,
                    ];

                    $response = $client->request('PUT', $endpoint,
                        [
                            'verify' => false,
                            'headers' => $headers,
                            RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                        ]);
                    $apihistory->api_type   = "mark player disable";
                    $apihistory->source_fun = $fun;
                    $apihistory->user_id     = $user->id;
                    //$apihistory->stag        = $history_check->stag;
                    $apihistory->data        = \Opis\Closure\serialize($vars);
                    $apihistory->responseCode = json_decode($response->getStatusCode());
                    $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                    $apihistory->status       = 1;
                    $apihistory->save();
                    return response()->json(json_decode($response->getBody()));
                } catch (\Exception $e) {
                    $apihistory->api_type   = "mark player disable";
                    $apihistory->source_fun = $fun;
                    $apihistory->user_id     = $user->id;
                    //$apihistory->stag        = $history_check->stag;
                    $apihistory->data        = \Opis\Closure\serialize($vars);
                    $apihistory->responseCode = json_decode($response->getStatusCode());
                    $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                    $apihistory->status       = 1;
                    $apihistory->save();
                    return response()->json($e->getCode());

                }
            }

        }
    }
    // unmark player as disable
   public function unmark_player_disable($user,$fun)
   {
       if ($this->settings->player_disable_unmark==1)
       {
           $apihistory                          = new AffiliateApiHistory();
           $history_check                       = AffiliateApiHistory::where('user_id',$user->id)
                                                                       ->first();

           if ($history_check!=null && $history_check->count()>0) {
               try {
                   // stag will be get from player view list
                   $vars = '{"tags":["' . $history_check->stag . '"]}';
                   $endpoint = "https://3p-partners.softswiss.net/api/v1/players/unmark_as_disabled";

                   $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                   $client = new \GuzzleHttp\Client();
                   $headers = [
                       'content-type' => 'application/json',
                       'X-Authorization-Sign' => $hash,
                       'X-Authorization-Key' => $this->key,
                   ];

                   $response = $client->request('PUT', $endpoint,
                       [
                           'verify' => false,
                           'headers' => $headers,
                           RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                       ]);
                   $apihistory->api_type   = "unmark player disable";
                   $apihistory->source_fun = $fun;
                   $apihistory->user_id     = $user->id;
                   //$apihistory->stag        = $history_check->stag;
                   $apihistory->data        = \Opis\Closure\serialize($vars);
                   $apihistory->responseCode = json_decode($response->getStatusCode());
                   $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                   $apihistory->status       = 1;
                   return response()->json(json_decode($response->getBody()));
               } catch (\Exception $e) {
                   $apihistory->api_type   = "unmark player disable";
                   $apihistory->source_fun = $fun;
                   $apihistory->user_id     = $user->id;
                   //$apihistory->stag        = $history_check->stag;
                   $apihistory->data        = \Opis\Closure\serialize($vars);
                   $apihistory->responseCode = json_decode($response->getStatusCode());
                   $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                   $apihistory->status       = 1;
                   $apihistory->save();
                   return response()->json($e->getCode());

               }
           }
       }
   }
   // mark player as duplicate
    public function mark_player_duplicate()
    {
        if ($this->settings->player_duplicate_mark==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                // stag will be get from player view list
                $vars = '{"tags":["12985_6040dd7414c4c63d65a5cc31"]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/players/mark_as_duplicate";

                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('PUT', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                    ]);
                $apihistory->api_type = "mark player as duplicate";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getBody()));
            } catch (\Exception $e) {
                $apihistory->api_type = "mark player as duplicate";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json($e->getCode());

            }
        }
    }
    // unmark player as duplicate
    public function unmark_player_duplicate()
    {
        if ($this->settings->player_duplicate_unmark==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                // stag will be get from player view list
                $vars = '{"tags":["12985_6040dd7414c4c63d65a5cc31"]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/players/unmark_as_duplicate";

                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('PUT', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                    ]);
                $apihistory->api_type = "unmark player as duplicate";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getBody()));
            } catch (\Exception $e) {
                $apihistory->api_type = "unmark player duplicate";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json($e->getCode());

            }
        }
    }
    // mark player as self-excluded
    public function mark_player_self_excluded()
    {
        if ($this->settings->player_self_excluded_mark==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                // stag will be get from player view list
                $vars = '{"tags":["12985_6040dd7414c4c63d65a5cc31"]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/players/mark_as_self_excluded";

                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('PUT', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                    ]);
                $apihistory->api_type = "mark player as self_excluded";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getBody()));
            } catch (\Exception $e) {
                $apihistory->api_type = "mark player as self_excluded";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json($e->getCode());

            }
        }
    }
    // unmark player as self-excluded
    public function unmark_player_self_excluded()
    {
        if ($this->settings->player_self_excluded_unmark==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                // stag will be get from player view list
                $vars = '{"tags":["12985_6040dd7414c4c63d65a5cc31"]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/players/unmark_as_self_excluded";

                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('PUT', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => ['tags' => json_decode($vars)->tags]
                    ]);
                $apihistory->api_type = "unmark player as self_excluded";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getBody()));
            } catch (\Exception $e) {
                $apihistory->api_type = "unmark player as self_excluded";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json($e->getCode());

            }
        }
    }
    // Attempt to import invalid player activities
    public function invalid_player_activities()
    {
        if ($this->settings->import_invalid_player_activities==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                $vars = '{"from":"2021-02-15T16:12:58.542+03:00","to":"2021-03-15T16:12:58.542+03:00","items":[{"tag":"12985_6040dd7414c4c63d65a5cc31","user_id":"1","currency":"USD","bets_sum_cents":-100,"wins_sum_cents":-200,"wager_cents":300,"additional_deductions_sum_cents":10,"rounds_count":100,"bonus_issues_sum_cents":2000,"chargebacks_sum_cents":100,"chargebacks_count":2,"deposits_sum_cents":300,"deposits_count":2,"cashouts_sum_cents":500,"cashouts_count":1,"deposits":[{"deposit_id":"ca561ab","amount_cents":100,"processed_at":"2017-06-15T15:12:58.542+03:00"},{"deposit_id":"ef397","amount_cents":200,"processed_at":"2017-06-15T15:14:58.542+03:00"}],"sb_bets_sum_cents":100,"sb_pending_bets_sum_cents":100,"sb_cancelled_bets_sum_cents":100,"sb_rejected_bets_sum_cents":100,"sb_wins_sum_cents":100,"sb_win_rollbacks_sum_cents":100,"sb_balance_corrections_sum_cents":-100,"sb_bonuses_sum_cents":100,"sb_gifts_sum_cents":100,"sb_third_party_fees_sum_cents":100,"game_provider_fees_sum_cents":10,"payment_system_fees_sum_cents":10,"jackpot_fees_sum_cents":10}]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/activity";
                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('POST', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => json_decode($vars)
                    ]);
                return response()->json(json_decode($response->getStatusCode()));
            } catch (\Exception $e) {
                //dd(json_decode($e->getMessage()));
                return response()->json($e->getCode());
            }
        }

    }
    // import valid player activities
    public function import_player_activities(Request $request)
    {
        if ($this->settings->import_player_activities==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            $affiliate_history                   = AffiliateApiHistory::where('stag','!=',null)
                                                                       ->where('api_type','import player')
                                                                       ->where('status',1)
                                                                        ->where('user_id','!=',null)
                                                                        ->groupBy('user_id')
                                                                        ->get();
            if ($affiliate_history!=null && $affiliate_history->count()>0)
            {
                try {
                    $start_from = date('Y-m-d H:0:0', strtotime('-1 hour'));
                    $date_time  = new \DateTime($start_from);
                    $from       = $date_time->format(\DateTime::ATOM);
                    $end_to     = date('Y-m-d H:0:0');
                    $date_time1  = new \DateTime($end_to);
                    $to         = $date_time1->format(\DateTime::ATOM);
                    $deposits = [];
                    $deposit_count = 0;
                    $deposit_sum = 0;
                    $playerData = [
                        'from'    => $from,
                        'to'      => $to
                    ];
                    $playerData['items'] = array();
                    $tok                             = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                    foreach ($affiliate_history as $row)
                    {
                        $deposit                          = DB::table('deposits')->where('user_id',$row->user_id)
                                                                                        ->where('type','!=','admin')
                                                                                        ->where('created_at', '>=',date('Y-m-d H:0:0', strtotime('-1 hour')))
                                                                                        ->where('created_at', '<',date('Y-m-d H:0:0'))
                                                                                        ->get();
                        $data                              = GameSessionChild::whereIn('session_child_id', function($query) {
                            $query->from('game_session_childs')->groupBy('session_id')->selectRaw('MAX(session_child_id)');
                                                                            })->where('user_id',$row->user_id)
                                                                              ->where('spin_type','paid')
                                                                              ->where('created_at', '>=',date('Y-m-d H:0:0', strtotime('-1 hour')))
                                                                              ->where('created_at', '<',date('Y-m-d H:0:0'))
                                                                             ->get();
                        $total_session_bet_amount        = $data->sum('total_session_bet_amount');
                        $wagered_amount                  = $total_session_bet_amount/$tok->pley6_token;
                        $rounds_count                    = $data->sum('total_paid_spins');

                       if (($deposit!=null && $deposit->count()>0) || ($wagered_amount>0))
                       {
                           foreach ($deposit as $item)
                           {
                               $deposits1=[
                                   'deposit_id'  => $item->id,
                                   'amount_cents' => $item->amount*100,
                                   'processed_at' => $item->created_at
                               ];
                               array_push($deposits,$deposits1);
                               $deposit_count+=1;
                               $deposit_sum+=$item->amount*100;
                           }
                           $items = [
                               'tag' => $row->stag,
                               'user_id' => $row->user_id,
                               'currency' => 'USD',
                               'bets_sum_cents' => 0*100,
                               'wins_sum_cents' => 0*100,
                               'wager_cents'    => intval(round($wagered_amount))*100,
                               'rounds_count' => $rounds_count,
                               'additional_deductions_sum_cents' => 0,
                               'deposits' => $deposits,
                               'deposits_sum_cents' => $deposit_sum,
                               'deposits_count' => $deposit_count,
                               'cashouts_sum_cents' => 0,
                               'cashouts_count' => 0,
                               'bonus_issues_sum_cents' => 0,
                               'chargebacks_sum_cents'  => 0,
                               'chargebacks_count' => 0
                           ];
                           array_push($playerData['items'],$items);
                       }
                    }
                    if (count($playerData['items'])>0)
                    {
                        $vars     = json_encode($playerData);
                        if (Config::get('services.affilka.host')=="propersix")
                        {
                            $endpoint = "https://3p-partners.softswiss.net/api/v1/activity";
                        }
                        else
                        {
                            $endpoint = "https://devaff.softswiss.net/api/v1/activity";
                        }
                        $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                        $client = new \GuzzleHttp\Client();
                        $headers = [
                            'content-type' => 'application/json',
                            'X-Authorization-Sign' => $hash,
                            'X-Authorization-Key' => $this->key,
                        ];
                        $response = $client->request('POST', $endpoint,
                            [
                                'verify' => false,
                                'headers' => $headers,
                                RequestOptions::JSON => json_decode($vars)
                            ]);
                        $apihistory->api_type = "import player activities";
                        $apihistory->source_fun = "cron";
                        $apihistory->responseCode = json_decode($response->getStatusCode());
                        $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                        $apihistory->status       = 1;
                        $apihistory->save();
                        return response()->json(json_decode($response->getStatusCode()));
                    }
                } catch (\Exception $e) {
                    $apihistory->api_type = "import player activities";
                    $apihistory->source_fun = "cron";
                    $apihistory->responseCode = $e->getCode();
                    $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                    $apihistory->status       = 1;
                    $apihistory->save();
                    return response()->json($e->getCode());

                }
            }

        }

    }
    public function visits_sync()
    {
        if ($this->settings->count_visit_sync==1)
        {
            $apihistory                          = new AffiliateApiHistory();
            try {
                $vars = '{"from":"2017-06-15T16:12:58.542+03:00","to":"2018-06-15T16:12:58.542+03:00","links":[{"code":"aut","affiliate_email":"johndoe+1@example.com","visits_count":20},{"code":"unde","affiliate_email":"johndoe+2@example.com","visits_count":40}]}';
                $endpoint = "https://3p-partners.softswiss.net/api/v1/synced_visits_data";
                $hash = hash_hmac('sha512', json_encode(json_decode($vars)), $this->secret);
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'content-type' => 'application/json',
                    'X-Authorization-Sign' => $hash,
                    'X-Authorization-Key' => $this->key,
                ];

                $response = $client->request('POST', $endpoint,
                    [
                        'verify' => false,
                        'headers' => $headers,
                        RequestOptions::JSON => json_decode($vars)
                    ]);
                $apihistory->api_type = "visits sync";
                $apihistory->source_fun = null;
                $apihistory->responseCode = json_decode($response->getStatusCode());
                $apihistory->response     = \Opis\Closure\serialize(json_decode($response->getBody()));
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json(json_decode($response->getStatusCode()));
            } catch (\Exception $e) {
                $apihistory->api_type = "visits sync";
                $apihistory->source_fun = null;
                $apihistory->responseCode = $e->getCode();
                $apihistory->response     = \Opis\Closure\serialize($e->getMessage());
                $apihistory->status       = 1;
                $apihistory->save();
                return response()->json($e->getCode());

            }
        }

    }
}
