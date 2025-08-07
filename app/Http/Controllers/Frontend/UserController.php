<?php

namespace App\Http\Controllers\Frontend;
use App\AffiliateBonus;
use App\CurrencyBaseRate;
use App\CoinPayment;
use App\KycDocuments;
use App\UpdateProfileHistory;
use App\UserProfile;
use Illuminate\Support\Facades\Http;
use App\Deposit;
use App\Tickets;
use GuzzleHttp\Client;
use mysql_xdevapi\Exception;
use Session;
use App\GeneralSetting;
use App\ListAffiliate;
use App\VerifyUser;
use Auth;
use phpDocumentor\Reflection\Types\Collection;
use File;
use Illuminate\Support\Facades\Mail;
use Image;
use App\User;
use App\Bonus;
use App\Wager;
use App\Account;
use App\AddGame;
use App\AddShop;
use App\Balance;
use App\Helpline;
use App\Loyality;
use Carbon\Carbon;
use App\GameEarning;
use App\UserMission;
use App\FavoriteGame;
use App\MissionBonus;
use App\Notification;
use App\ProsixWallet;
use App\PurchasesShop;
use App\TokenCurrency;
use App\UserDocuments;
use App\PropersixBonus;
use App\TransactionType;
use App\ProsixUserWallet;
use App\ProsixWalletType;
use App\ProsixTransaction;
use App\Account_deactivate;
use App\TokenLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Validator;
use DateTime;
class UserController extends Controller
{
    public function checkUserName(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json("not ok");
        } else {
            return response()->json("ok");
        }
    }

    function dashboard(Request $request)
    {
        return $this->all_data();
    }

    function aff_list()
    {
        return view('frontend.casino_user.aff-list');
    }

    function aff_nickname()
    {
        return view('frontend.casino_user.aff-nickname');
    }

    function acc_data()
    {
        return view('frontend.casino_user.acc-data');
    }

    function acc_bank()
    {
        return view('frontend.casino_user.acc-bank');
    }

    public function referrals()
    {
//        $user                  = Auth::user();
//       $referrals              = ListAffiliate::where('user_id','!=',$user->id);
//       $user_id                = $user->id;
//       $result                 = collect();
//       $direct                 = collect();
//       $indirect               = collect();
//           foreach ($referrals->get() as $ref_user)
//           {
//             if($ref_user->aff_id==$user_id || $ref_user->aff_id==$user->id)
//             {
//                 $result->push($ref_user);
//                 if ($ref_user->aff_id==$user->id)
//                 {
//                     $direct->push($ref_user);
//                 }
//                 else{
//                     $indirect->push($ref_user);
//                 }
//                 $referrals   = ListAffiliate::where('aff_id',$ref_user->user_id);
//                 $user_id     = $ref_user->user_id;
//
//             }
//           }
        $deposits = Deposit::whereBetween('created_at', [now()->subDay(1), now()])->get();
        $aff_commission = GeneralSetting::orderBy('id', 'desc')->first()->affiliate_commission;
        $token_rate = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
        foreach ($deposits as $deposit) {

            $referrals = ListAffiliate::where('user_id', $deposit->user_id)->first();
            if ($referrals != null) {

                $check = AffiliateBonus::where('deposit_id', $deposit->id)->first();
                if ($check == null) {
                    $bonus = new AffiliateBonus();
                    $bonus->deposit_id = $deposit->id;
                    $bonus->user_id = $referrals->user_id;
                    $bonus->aff_id = $referrals->aff_id;
                    $bonus->amount = ($aff_commission / 100.00) * $deposit->amount;
                    $bonus->tokens = $token_rate->pley6_token * (($aff_commission / 100.00) * $deposit->amount);
                    $bonus->status = 1;
                    $bonus->save();

                    // updating prosix_user_wallet table lobby main table for user wallet
                    $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => $bonus->aff_id]);
                    $userWallet->free_token += $bonus->tokens;
                    $userWallet->save();

                    // notification generation for referrer
                    $notification = new \App\Notification;
                    $notification->user_id = $bonus->aff_id;
                    $notification->message = 'You got ' . $bonus->tokens . ' free tokens from your referral deposit';
                    $notification->save();

                }

            }
        }
        return "done successfully";
    }

    function acc_document(Request $r)
    {

        //dd($r->photoForFaceComparison);
//        $response = Http::post('https://kyc.propersix.com/autix/auapi/bos/api.php', [
//            'docType'        => 'All',
//            'requestData' => 'IdentityDocument_SingleSided',
//            'photoForFaceComparison' => $r->photoForFaceComparison,
//            'documentImage_Page0'   => $r->documentImage_Page0
//        ]);
//        dd($response);


        if ($r->hasFile('documentImage_Page1')) {
            $validator = Validator::make($r->all(), [
                'photoForFaceComparison' => 'required|mimes:jpeg,png,jpg|max:10240',
                'documentImage_Page0' => 'required|mimes:jpeg,png,jpg|max:10240',
                'documentImage_Page1' => 'required|mimes:jpeg,png,jpg|max:10240',
            ],
                [
                    'photoForFaceComparison.mimes'  => 'User identity pic not in png or jpg format',
                    'documentImage_Page0.mimes'     => 'Front side pic not in png or jpg format',
                    'documentImage_Page1.mimes'     => 'Back side pic not in png or jpg format',
                    // exceeds size
                    'photoForFaceComparison.max'  => 'User identity pic may not be greater than 10MB',
                    'documentImage_Page0.max'     => 'Front side pic may not be greater than 10MB',
                    'documentImage_Page1.max'     => 'Back side pic may not be greater than 10MB',
                ]
            );

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->with('setting_tab','document');
            }
//            $r->validate([
//                'photoForFaceComparison' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip',
//                'documentImage_Page0' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip',
//                'documentImage_Page1' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip',
//            ]);
        }
        else
        {
            $validator = Validator::make($r->all(), [
                'photoForFaceComparison' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip|max:10240',
                'documentImage_Page0' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip|max:10240',
            ],
                [
                    'photoForFaceComparison.mimes'  => 'User identity pic not in png or jpg format',
                    'documentImage_Page0.mimes'     => 'Front side pic not in png or jpg format',
                    // exceeds size
                    'photoForFaceComparison.max'  => 'User identity pic may not be greater than 10MB',
                    'documentImage_Page0.max'     => 'Front side pic may not be greater than 10MB',
                ]
            );

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->with('setting_tab','document');
            }
//            $r->validate([
//                'photoForFaceComparison' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip',
//                'documentImage_Page0' => 'required|mimes:jpeg,png,jpg,doc,pdf,docx,zip',
//            ]);
        }

        $this->update_pro_session(Auth::user()->id,$r);
        try {
            $data = new UserDocuments();
            $data->user_id = Auth::user()->id;
            $data->save();
            if ($r->hasFile('photoForFaceComparison')) {
                $photoForFaceComparison = $r->file('photoForFaceComparison');
                $pathImage = 'public/uploads/document/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $r->photoForFaceComparison->getClientOriginalName();
                    $r->photoForFaceComparison->move('public/uploads/document/', $fileName);
                    $data->identity = 'public/uploads/document/' . $fileName;
                } else {
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $r->photoForFaceComparison->getClientOriginalName();
                    $r->photoForFaceComparison->move('public/uploads/document/', $fileName);
                    $data->identity = 'public/uploads/document/' . $fileName;
                }
            }
            if ($r->hasFile('documentImage_Page0')) {
                $documentImage_Page0 = $r->file('documentImage_Page0');
                $pathImage = 'public/uploads/document/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$r->documentImage_Page0->getClientOriginalName();
                    $r->documentImage_Page0->move('public/uploads/document/', $fileName);
                    $data->bank_statement = 'public/uploads/document/' . $fileName;
                } else {
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $r->documentImage_Page0->getClientOriginalName();
                    $r->documentImage_Page0->move('public/uploads/document/', $fileName);
                    $data->bank_statement = 'public/uploads/document/' . $fileName;
                }
            }
            if ($r->hasFile('documentImage_Page1')) {
                $documentImage_Page1 = $r->file('documentImage_Page1');
                $pathImage = 'public/uploads/document/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $r->documentImage_Page1->getClientOriginalName();
                    $r->documentImage_Page1->move('public/uploads/document/', $fileName);
                    $data->bank_statement = 'public/uploads/document/' . $fileName;
                }
                else
                {
                    $fileName = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '.' . $r->documentImage_Page1->getClientOriginalName();
                    $r->documentImage_Page1->move('public/uploads/document/', $fileName);
                    $data->back_side = 'public/uploads/document/' . $fileName;
                }
            }
            $data->save();
            $check            = GeneralSetting::findOrFail(1);
            if ($check->kyc_api==1)
            {
                $result           = UserDocuments::latest()->first();

                $client = new Client();
                if($result->back_side!=null)
                {
                    $res = $client->post('https://kyc.propersix.com/autix/auapi/bos/api.php',
                        [
                            'multipart' => [
                                [
                                    'name' => 'docType',
                                    'contents' => 'All'
                                ],
                                [
                                    'name' => 'requestData',
                                    'contents' => 'IdentityDocument_DoubleSided'
                                ],
                                [
                                    'Content-type' => 'multipart/form-data',
                                    'name' => 'photoForFaceComparison',
                                    'contents' => fopen('https://propersix.casino/'.$result->identity, 'r')
                                ],
                                [
                                    'Content-type' => 'multipart/form-data',
                                    'name' => 'documentImage_Page0',
                                    'contents' => fopen('https://propersix.casino/'.$result->bank_statement, 'r')
                                ],
                                [
                                    'Content-type' => 'multipart/form-data',
                                    'name' => 'documentImage_Page1',
                                    'contents' => fopen('https://propersix.casino/'.$result->back_side, 'r')
                                ],

                            ]]);
                }
                else{
                    $res = $client->post('https://kyc.propersix.com/autix/auapi/bos/api.php',
                        [
                            'multipart' => [
                                [
                                    'name' => 'docType',
                                    'contents' => 'All'
                                ],
                                [
                                    'name' => 'requestData',
                                    'contents' => 'IdentityDocument_SingleSided'
                                ],
                                [
                                    'Content-type' => 'multipart/form-data',
                                    'name' => 'photoForFaceComparison',
                                    'contents' => fopen('https://propersix.casino/'.$result->identity, 'r')
                                    //'contents' => $r->photoForFaceComparison->getclientoriginalname()
                                ],
                                [
                                    'Content-type' => 'multipart/form-data',
                                    'name' => 'documentImage_Page0',
                                    'contents' => fopen('https://propersix.casino/'.$result->bank_statement, 'r')
                                    //'contents' => $r->documentImage_Page0->getclientoriginalname()
                                ],

                            ]]);
                }
//           echo $res->getStatusCode(); // 200
//            echo $res->getBody();
//            dd(json_decode($res->getBody())->requestDetail->RequestId);

                $kyc                         = new KycDocuments();
                $kyc->doc_id                 = $result->id;
                $kyc->requesID               = json_decode($res->getBody())->requestDetail->RequestId;
//                $kyc->response               = \Opis\Closure\serialize(json_decode($res->getBody()));
                $kyc->status                 = 0;
                $kyc->save();
            }
            Toastr::success('Document uploaded successfully.', 'Success');
            return redirect()->back()->with('setting_tab','document');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ', 'Error');
            return redirect()->back()->with('setting_tab','document');
        }
    }

    function user_profile()
    {
        return $this->all_data();
    }

    function all_data()
    {
        try {
            $user = Auth::user();
            $referrals = ListAffiliate::where('user_id', '!=', $user->id);
            $user_id = $user->id;
            $result = collect();
            $direct = collect();
            $indirect = collect();
            // data from view
            $data     = DB::table('general_settings')->find(1);
            $tok = DB::table('token_currencies')->where(['status'=>1,'doller'=>1])->first();
            $userWallet = \App\ProsixUserWallet::where('user_id',Auth::user()->id)->first();
            $earn = $userWallet->earn_loyalty;
            $total_loyalty=$userWallet->total_loyalty;
            $loyalty_badge = DB::table('loyalities')->where('from_range','<=',$total_loyalty)->where('to_range','>=',$total_loyalty)->orderBy('id','desc')->first();
            $shopList=[];
            if (isset($loyalty_badge)){
                $shopList = DB::table('add_shops')->where('loyalty_type',$loyalty_badge->id)->where('status',1)->orderBy('created_at', 'DESC')->get();
            }
            $userMissionsCom = \App\UserMission::where('user_id',Auth::user()->id)->where('status', '1')->pluck('mission_id')->toArray();
            $userMissionsPending = \App\UserMission::where('user_id',Auth::user()->id)->where('status', '0')->pluck('mission_id')->toArray();
            $not = DB::table('notifications')->where('user_id',Auth::user()->id);
            $read = DB::table('leave_notes')->where('user_id',Auth::user()->id);
            $unReadMsgCount = DB::table('leave_notes')->where('user_id',Auth::user()->id)->where('status' , '0')->count();
            $Unread = DB::table('notifications')->where('user_id',Auth::user()->id)->where('status',1);
            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
            $user_document = DB::table('user_documents')->where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            $transData = DB::table('deposits')->where('user_id' , @Auth::user()->id )->orderBy('created_at', 'DESC')->get();
            $withData = DB::table('withdraws')->where('user_id' , @Auth::user()->id )->where('status','!=',0)->orderBy('created_at', 'DESC')->get();
            $shops = DB::table('add_shops')->where('status',1)->orderBy('created_at', 'DESC')->get();
            $coin_deposits   = DB::table('coin_payment')->where('user_id' , @Auth::user()->id )->where('status',0)->orderBy('id', 'DESC')->get();
            $axcess_deposits  = DB::table('axcess_payment')->where('user_id' , @Auth::user()->id )->where('status',0)->orderBy('id', 'DESC')->get();
            $pendingDeposits = $coin_deposits->merge($axcess_deposits)->sortByDesc('created_at');
            $pendingWithdraws = DB::table('withdraws')->where('user_id' , @Auth::user()->id )->where('status',0)->orderBy('created_at', 'DESC')->get();

            foreach ($referrals->get() as $ref_user) {
                if ($ref_user->aff_id == $user_id || $ref_user->aff_id == $user->id) {
                    $result->push($ref_user);
                    if ($ref_user->aff_id == $user->id) {
                        $direct->push($ref_user);
                    } else {
                        $indirect->push($ref_user);
                    }
                    $referrals = ListAffiliate::where('aff_id', $ref_user->user_id);
                    $user_id   = $ref_user->user_id;
                }
            }
            $cuntryCodes = $this->getCountryDetail();
            $currentDate = date('Y-m-d');
            $weeklycurrent = date("D");
            $monthlycurrent = date('d');
            $missions = MissionBonus::where('specific_day', $currentDate)->where('status', 1)->get();
            $missionsweekly = MissionBonus::where('date_m', 'w')->where('d_m', $weeklycurrent)->where('status', 1)->get();
            $missionsmonthly = MissionBonus::where('date_m', 'm')->where('d_m', $monthlycurrent)->where('status', 1)->get();


            //dd($missions);
            $user = User::find(Auth::user()->id);
            $countryPhoneCode = 'US';
            foreach ($cuntryCodes as $cntry) {

                if ($cntry['phoneCode'] == $user->country_code) {
                    $countryPhoneCode = $cntry['code'];
                }

            }
            //dd($countryPhoneCode);

            //code for progress bar
            $pgbar = $this->progressbar();
            if ($pgbar == '0') {
                $wagerprogress = 0;
                $totalwager = 0;
            } else {
                $wagerprogress = $pgbar['wagerprogress'];
                $totalwager = $pgbar['totalwager'];
            }
            // Ticket history
            $tickets = Tickets::where('user_id', Auth::user()->id)
                ->with('contents', 'files', 'Ticketstatus')->orderBy('created_at','desc')->get();
            $settings = DB::table('cms')->first();
            return view('frontend.casino_user.dashboard', compact('user', 'direct', 'missions', 'currentDate', 'countryPhoneCode', 'missionsweekly', 'missionsmonthly', 'wagerprogress', 'totalwager', 'tickets','data','tok','userWallet','earn','loyalty_badge','shopList','userMissionsCom','userMissionsPending','not','read','unReadMsgCount','Unread','countries','user_document','transData','withData','shops','pendingDeposits','pendingWithdraws','settings'));

        }
        catch (\Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }

    function cancel_withdraw(Request $r, $id)
    {
//        $this->update_pro_session(Auth::user()->id,$r);
        $tok = \App\TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
        $userWallet = \App\ProsixUserWallet::where('user_id', Auth::user()->id)->first();
        $userWithdraw = \App\Withdraw::find($id);
        if ($userWithdraw->status == '0') {
            $usd = $userWithdraw->amount / $tok->pley6_token;
            $userWallet->usd = $userWallet->usd + $usd;
            $userWallet->token = $userWallet->token + $userWithdraw->amount;
            $userWallet->save();

            $userWithdraw->status = 3;
            $userWithdraw->save();

            // notification
            $notification = new \App\Notification;
            $notification->user_id = Auth::id();
            $notification->message = getTranslated('withdraw_cancel') .' '. $userWithdraw->amount . ' token and ' . $usd . ' USD' . ' have been returned to your wallet';
            $notification->save();


            Toastr::success($notification->message, 'Success');
        } else {
            $notification = new \App\Notification;
            $notification->user_id = Auth::id();
            $notification->message = 'Withdrawal request cancelation failed. Please try again later.';
            $notification->save();


            Toastr::warning($notification->message, 'warning');
        }
        return redirect()->back();

    }

    /**
     *
     */
    public function convert_loyalty(Request $r)
    {
        try {
            $loyalty = Loyality::find($r->tier);
            $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
            $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();

            if ($r->lt > $userWallet->earn_loyalty) {
                Toastr::error('You have insufficient VIP points. ', 'Error');
                return redirect()->back();
            }

            //log loyalty token here
            $tlog = new \App\TokenLog();
            $tlog->wallet_id = $userWallet->id;
            $tlog->user_id = $userWallet->user_id;
            $tlog->log_id = 0;
            $tlog->lt_earn_before = $userWallet->earn_loyalty;
            $tlog->token_before = $userWallet->token;
            $tlog->usd_before = $userWallet->usd;
            $tlog->usd_earn_before = $userWallet->usd;

            //token and usd Conversion
            $convertedUsd = $r->lt / $loyalty->conversion_rate;
            $tokenConverted = $convertedUsd * $tok->pley6_token;
            $userWallet->earn_loyalty = $userWallet->earn_loyalty - $r->lt;
            $userWallet->used_loyalty = $userWallet->used_loyalty + $r->lt;
            $userWallet->usd = $userWallet->usd + $convertedUsd;
            $userWallet->token = $userWallet->token + $tokenConverted;

            $tlog->lt_conversion_rate = $loyalty->conversion_rate;
            $tlog->token_converted = $tokenConverted;
            $tlog->usd_converted = $convertedUsd;

            $tlog->token_after = $userWallet->token;
            $tlog->usd_after = $userWallet->usd;
            $tlog->lt_earn_after = $userWallet->earn_loyalty;
            $tlog->usd_earn_after = $userWallet->usd;

            $userWallet->save();
            $tlog->save();


            // notification
            $notification = new \App\Notification;
            $notification->user_id = Auth::id();
            $notification->message = 'Loyalty points successfully converted You got ' . $tokenConverted . ' token and ' . $convertedUsd . ' USD';
            $notification->save();

            Toastr::success("Loyalty points successfully converted, $convertedUsd USD AND $tokenConverted Token added.) ", 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! try later', 'Error');
            return redirect()->back();
        }

    }

    public function getCountryDetail()
    {
        $array = array(
            0 =>
                array(
                    'countryName' => 'Afghanistan',
                    'code' => 'AF',
                    'phoneCode' => '93',
                ),
            1 =>
                array(
                    'countryName' => 'Åland Islands',
                    'code' => 'AX',
                    'phoneCode' => '358',
                ),
            2 =>
                array(
                    'countryName' => 'Albania',
                    'code' => 'AL',
                    'phoneCode' => '355',
                ),
            3 =>
                array(
                    'countryName' => 'Algeria',
                    'code' => 'DZ',
                    'phoneCode' => '213',
                ),
            4 =>
                array(
                    'countryName' => 'American Samoa',
                    'code' => 'AS',
                    'phoneCode' => '1684',
                ),
            5 =>
                array(
                    'countryName' => 'Andorra',
                    'code' => 'AD',
                    'phoneCode' => '376',
                ),
            6 =>
                array(
                    'countryName' => 'Angola',
                    'code' => 'AO',
                    'phoneCode' => '244',
                ),
            7 =>
                array(
                    'countryName' => 'Anguilla',
                    'code' => 'AI',
                    'phoneCode' => '1264',
                ),
            8 =>
                array(
                    'countryName' => 'Antigua and Barbuda',
                    'code' => 'AG',
                    'phoneCode' => '1268',
                ),
            9 =>
                array(
                    'countryName' => 'Argentina',
                    'code' => 'AR',
                    'phoneCode' => '54',
                ),
            10 =>
                array(
                    'countryName' => 'Armenia',
                    'code' => 'AM',
                    'phoneCode' => '374',
                ),
            11 =>
                array(
                    'countryName' => 'Aruba',
                    'code' => 'AW',
                    'phoneCode' => '297',
                ),
            12 =>
                array(
                    'countryName' => 'Australia',
                    'code' => 'AU',
                    'phoneCode' => '61',
                ),
            13 =>
                array(
                    'countryName' => 'Austria',
                    'code' => 'AT',
                    'phoneCode' => '43',
                ),
            14 =>
                array(
                    'countryName' => 'Azerbaijan',
                    'code' => 'AZ',
                    'phoneCode' => '994',
                ),
            15 =>
                array(
                    'countryName' => 'Bahamas',
                    'code' => 'BS',
                    'phoneCode' => '1242',
                ),
            16 =>
                array(
                    'countryName' => 'Bahrain',
                    'code' => 'BH',
                    'phoneCode' => '973',
                ),
            17 =>
                array(
                    'countryName' => 'Bangladesh',
                    'code' => 'BD',
                    'phoneCode' => '880',
                ),
            18 =>
                array(
                    'countryName' => 'Barbados',
                    'code' => 'BB',
                    'phoneCode' => '1246',
                ),
            19 =>
                array(
                    'countryName' => 'Belarus',
                    'code' => 'BY',
                    'phoneCode' => '375',
                ),
            20 =>
                array(
                    'countryName' => 'Belgium',
                    'code' => 'BE',
                    'phoneCode' => '32',
                ),
            21 =>
                array(
                    'countryName' => 'Belize',
                    'code' => 'BZ',
                    'phoneCode' => '501',
                ),
            22 =>
                array(
                    'countryName' => 'Benin',
                    'code' => 'BJ',
                    'phoneCode' => '229',
                ),
            23 =>
                array(
                    'countryName' => 'Bermuda',
                    'code' => 'BM',
                    'phoneCode' => '1441',
                ),
            24 =>
                array(
                    'countryName' => 'Bhutan',
                    'code' => 'BT',
                    'phoneCode' => '975',
                ),
            25 =>
                array(
                    'countryName' => 'Bolivia',
                    'code' => 'BO',
                    'phoneCode' => '591',
                ),
            26 =>
                array(
                    'countryName' => 'Bosnia and Herzegovina',
                    'code' => 'BA',
                    'phoneCode' => '387',
                ),
            27 =>
                array(
                    'countryName' => 'Botswana',
                    'code' => 'BW',
                    'phoneCode' => '267',
                ),
            28 =>
                array(
                    'countryName' => 'Brazil',
                    'code' => 'BR',
                    'phoneCode' => '55',
                ),
            29 =>
                array(
                    'countryName' => 'British Indian Ocean Territory',
                    'code' => 'IO',
                    'phoneCode' => '246',
                ),
            30 =>
                array(
                    'countryName' => 'British Virgin Islands',
                    'code' => 'VG',
                    'phoneCode' => '1284',
                ),
            31 =>
                array(
                    'countryName' => 'Brunei',
                    'code' => 'BN',
                    'phoneCode' => '673',
                ),
            32 =>
                array(
                    'countryName' => 'Bulgaria',
                    'code' => 'BG',
                    'phoneCode' => '359',
                ),
            33 =>
                array(
                    'countryName' => 'Burkina Faso',
                    'code' => 'BF',
                    'phoneCode' => '226',
                ),
            34 =>
                array(
                    'countryName' => 'Burundi',
                    'code' => 'BI',
                    'phoneCode' => '257',
                ),
            35 =>
                array(
                    'countryName' => 'Cambodia',
                    'code' => 'KH',
                    'phoneCode' => '855',
                ),
            36 =>
                array(
                    'countryName' => 'Cameroon',
                    'code' => 'CM',
                    'phoneCode' => '237',
                ),
            37 =>
                array(
                    'countryName' => 'Canada',
                    'code' => 'CA',
                    'phoneCode' => '1',
                ),
            38 =>
                array(
                    'countryName' => 'Cape Verde',
                    'code' => 'CV',
                    'phoneCode' => '238',
                ),
            39 =>
                array(
                    'countryName' => 'Cayman Islands',
                    'code' => 'KY',
                    'phoneCode' => '1345',
                ),
            40 =>
                array(
                    'countryName' => 'Central African Republic',
                    'code' => 'CF',
                    'phoneCode' => '236',
                ),
            41 =>
                array(
                    'countryName' => 'Chad',
                    'code' => 'TD',
                    'phoneCode' => '235',
                ),
            42 =>
                array(
                    'countryName' => 'Chile',
                    'code' => 'CL',
                    'phoneCode' => '56',
                ),
            43 =>
                array(
                    'countryName' => 'China',
                    'code' => 'CN',
                    'phoneCode' => '86',
                ),
            44 =>
                array(
                    'countryName' => 'Christmas Island',
                    'code' => 'CX',
                    'phoneCode' => '61',
                ),
            45 =>
                array(
                    'countryName' => 'Cocos (Keeling) Islands',
                    'code' => 'CC',
                    'phoneCode' => '61',
                ),
            46 =>
                array(
                    'countryName' => 'Colombia',
                    'code' => 'CO',
                    'phoneCode' => '57',
                ),
            47 =>
                array(
                    'countryName' => 'Comoros',
                    'code' => 'KM',
                    'phoneCode' => '269',
                ),
            48 =>
                array(
                    'countryName' => 'Cook Islands',
                    'code' => 'CK',
                    'phoneCode' => '682',
                ),
            49 =>
                array(
                    'countryNfame' => 'Costa Rica',
                    'code' => 'CR',
                    'phoneCode' => '506',
                ),
            50 =>
                array(
                    'countryName' => 'Croatia',
                    'code' => 'HR',
                    'phoneCode' => '385',
                ),
            51 =>
                array(
                    'countryName' => 'Cuba',
                    'code' => 'CU',
                    'phoneCode' => '53',
                ),
            52 =>
                array(
                    'countryName' => 'Curaçao',
                    'code' => 'CW',
                    'phoneCode' => '5999',
                ),
            53 =>
                array(
                    'countryName' => 'Cyprus',
                    'code' => 'CY',
                    'phoneCode' => '357',
                ),
            54 =>
                array(
                    'countryName' => 'Czechia',
                    'code' => 'CZ',
                    'phoneCode' => '420',
                ),
            55 =>
                array(
                    'countryName' => 'DR Congo',
                    'code' => 'CD',
                    'phoneCode' => '243',
                ),
            56 =>
                array(
                    'countryName' => 'Denmark',
                    'code' => 'DK',
                    'phoneCode' => '45',
                ),
            57 =>
                array(
                    'countryName' => 'Djibouti',
                    'code' => 'DJ',
                    'phoneCode' => '253',
                ),
            58 =>
                array(
                    'countryName' => 'Dominica',
                    'code' => 'DM',
                    'phoneCode' => '1767',
                ),
            59 =>
                array(
                    'countryName' => 'Dominican Republic',
                    'code' => 'DO',
                    'phoneCode' => '1809',
                ),
            60 =>
                array(
                    'countryName' => 'Dominican Republic',
                    'code' => 'DO',
                    'phoneCode' => '1829',
                ),
            61 =>
                array(
                    'countryName' => 'Dominican Republic',
                    'code' => 'DO',
                    'phoneCode' => '1849',
                ),
            62 =>
                array(
                    'countryName' => 'Ecuador',
                    'code' => 'EC',
                    'phoneCode' => '593',
                ),
            63 =>
                array(
                    'countryName' => 'Egypt',
                    'code' => 'EG',
                    'phoneCode' => '20',
                ),
            64 =>
                array(
                    'countryName' => 'El Salvador',
                    'code' => 'SV',
                    'phoneCode' => '503',
                ),
            65 =>
                array(
                    'countryName' => 'Equatorial Guinea',
                    'code' => 'GQ',
                    'phoneCode' => '240',
                ),
            66 =>
                array(
                    'countryName' => 'Eritrea',
                    'code' => 'ER',
                    'phoneCode' => '291',
                ),
            67 =>
                array(
                    'countryName' => 'Estonia',
                    'code' => 'EE',
                    'phoneCode' => '372',
                ),
            68 =>
                array(
                    'countryName' => 'Ethiopia',
                    'code' => 'ET',
                    'phoneCode' => '251',
                ),
            69 =>
                array(
                    'countryName' => 'Falkland Islands',
                    'code' => 'FK',
                    'phoneCode' => '500',
                ),
            70 =>
                array(
                    'countryName' => 'Faroe Islands',
                    'code' => 'FO',
                    'phoneCode' => '298',
                ),
            71 =>
                array(
                    'countryName' => 'Fiji',
                    'code' => 'FJ',
                    'phoneCode' => '679',
                ),
            72 =>
                array(
                    'countryName' => 'Finland',
                    'code' => 'FI',
                    'phoneCode' => '358',
                ),
            73 =>
                array(
                    'countryName' => 'France',
                    'code' => 'FR',
                    'phoneCode' => '33',
                ),
            74 =>
                array(
                    'countryName' => 'French Guiana',
                    'code' => 'GF',
                    'phoneCode' => '594',
                ),
            75 =>
                array(
                    'countryName' => 'French Polynesia',
                    'code' => 'PF',
                    'phoneCode' => '689',
                ),
            76 =>
                array(
                    'countryName' => 'Gabon',
                    'code' => 'GA',
                    'phoneCode' => '241',
                ),
            77 =>
                array(
                    'countryName' => 'Gambia',
                    'code' => 'GM',
                    'phoneCode' => '220',
                ),
            78 =>
                array(
                    'countryName' => 'Georgia',
                    'code' => 'GE',
                    'phoneCode' => '995',
                ),
            79 =>
                array(
                    'countryName' => 'Germany',
                    'code' => 'DE',
                    'phoneCode' => '49',
                ),
            80 =>
                array(
                    'countryName' => 'Ghana',
                    'code' => 'GH',
                    'phoneCode' => '233',
                ),
            81 =>
                array(
                    'countryName' => 'Gibraltar',
                    'code' => 'GI',
                    'phoneCode' => '350',
                ),
            82 =>
                array(
                    'countryName' => 'Greece',
                    'code' => 'GR',
                    'phoneCode' => '30',
                ),
            83 =>
                array(
                    'countryName' => 'Greenland',
                    'code' => 'GL',
                    'phoneCode' => '299',
                ),
            84 =>
                array(
                    'countryName' => 'Grenada',
                    'code' => 'GD',
                    'phoneCode' => '1473',
                ),
            85 =>
                array(
                    'countryName' => 'Guadeloupe',
                    'code' => 'GP',
                    'phoneCode' => '590',
                ),
            86 =>
                array(
                    'countryName' => 'Guam',
                    'code' => 'GU',
                    'phoneCode' => '1671',
                ),
            87 =>
                array(
                    'countryName' => 'Guatemala',
                    'code' => 'GT',
                    'phoneCode' => '502',
                ),
            88 =>
                array(
                    'countryName' => 'Guernsey',
                    'code' => 'GG',
                    'phoneCode' => '44',
                ),
            89 =>
                array(
                    'countryName' => 'Guinea',
                    'code' => 'GN',
                    'phoneCode' => '224',
                ),
            90 =>
                array(
                    'countryName' => 'Guinea-Bissau',
                    'code' => 'GW',
                    'phoneCode' => '245',
                ),
            91 =>
                array(
                    'countryName' => 'Guyana',
                    'code' => 'GY',
                    'phoneCode' => '592',
                ),
            92 =>
                array(
                    'countryName' => 'Haiti',
                    'code' => 'HT',
                    'phoneCode' => '509',
                ),
            93 =>
                array(
                    'countryName' => 'Honduras',
                    'code' => 'HN',
                    'phoneCode' => '504',
                ),
            94 =>
                array(
                    'countryName' => 'Hong Kong',
                    'code' => 'HK',
                    'phoneCode' => '852',
                ),
            95 =>
                array(
                    'countryName' => 'Hungary',
                    'code' => 'HU',
                    'phoneCode' => '36',
                ),
            96 =>
                array(
                    'countryName' => 'Iceland',
                    'code' => 'IS',
                    'phoneCode' => '354',
                ),
            97 =>
                array(
                    'countryName' => 'India',
                    'code' => 'IN',
                    'phoneCode' => '91',
                ),
            98 =>
                array(
                    'countryName' => 'Indonesia',
                    'code' => 'ID',
                    'phoneCode' => '62',
                ),
            99 =>
                array(
                    'countryName' => 'Iran',
                    'code' => 'IR',
                    'phoneCode' => '98',
                ),
            100 =>
                array(
                    'countryName' => 'Iraq',
                    'code' => 'IQ',
                    'phoneCode' => '964',
                ),
            101 =>
                array(
                    'countryName' => 'Ireland',
                    'code' => 'IE',
                    'phoneCode' => '353',
                ),
            102 =>
                array(
                    'countryName' => 'Isle of Man',
                    'code' => 'IM',
                    'phoneCode' => '44',
                ),
            103 =>
                array(
                    'countryName' => 'Israel',
                    'code' => 'IL',
                    'phoneCode' => '972',
                ),
            104 =>
                array(
                    'countryName' => 'Italy',
                    'code' => 'IT',
                    'phoneCode' => '39',
                ),
            105 =>
                array(
                    'countryName' => 'Ivory Coast',
                    'code' => 'CI',
                    'phoneCode' => '225',
                ),
            106 =>
                array(
                    'countryName' => 'Jamaica',
                    'code' => 'JM',
                    'phoneCode' => '1876',
                ),
            107 =>
                array(
                    'countryName' => 'Japan',
                    'code' => 'JP',
                    'phoneCode' => '81',
                ),
            108 =>
                array(
                    'countryName' => 'Jersey',
                    'code' => 'JE',
                    'phoneCode' => '44',
                ),
            109 =>
                array(
                    'countryName' => 'Jordan',
                    'code' => 'JO',
                    'phoneCode' => '962',
                ),
            110 =>
                array(
                    'countryName' => 'Kazakhstan',
                    'code' => 'KZ',
                    'phoneCode' => '77',
                ),
            111 =>
                array(
                    'countryName' => 'Kazakhstan',
                    'code' => 'KZ',
                    'phoneCode' => '76',
                ),
            112 =>
                array(
                    'countryName' => 'Kenya',
                    'code' => 'KE',
                    'phoneCode' => '254',
                ),
            113 =>
                array(
                    'countryName' => 'Kiribati',
                    'code' => 'KI',
                    'phoneCode' => '686',
                ),
            114 =>
                array(
                    'countryName' => 'Kosovo',
                    'code' => 'XK',
                    'phoneCode' => '383',
                ),
            115 =>
                array(
                    'countryName' => 'Kuwait',
                    'code' => 'KW',
                    'phoneCode' => '965',
                ),
            116 =>
                array(
                    'countryName' => 'Kyrgyzstan',
                    'code' => 'KG',
                    'phoneCode' => '996',
                ),
            117 =>
                array(
                    'countryName' => 'Laos',
                    'code' => 'LA',
                    'phoneCode' => '856',
                ),
            118 =>
                array(
                    'countryName' => 'Latvia',
                    'code' => 'LV',
                    'phoneCode' => '371',
                ),
            119 =>
                array(
                    'countryName' => 'Lebanon',
                    'code' => 'LB',
                    'phoneCode' => '961',
                ),
            120 =>
                array(
                    'countryName' => 'Lesotho',
                    'code' => 'LS',
                    'phoneCode' => '266',
                ),
            121 =>
                array(
                    'countryName' => 'Liberia',
                    'code' => 'LR',
                    'phoneCode' => '231',
                ),
            122 =>
                array(
                    'countryName' => 'Libya',
                    'code' => 'LY',
                    'phoneCode' => '218',
                ),
            123 =>
                array(
                    'countryName' => 'Liechtenstein',
                    'code' => 'LI',
                    'phoneCode' => '423',
                ),
            124 =>
                array(
                    'countryName' => 'Lithuania',
                    'code' => 'LT',
                    'phoneCode' => '370',
                ),
            125 =>
                array(
                    'countryName' => 'Luxembourg',
                    'code' => 'LU',
                    'phoneCode' => '352',
                ),
            126 =>
                array(
                    'countryName' => 'Macau',
                    'code' => 'MO',
                    'phoneCode' => '853',
                ),
            127 =>
                array(
                    'countryName' => 'Macedonia',
                    'code' => 'MK',
                    'phoneCode' => '389',
                ),
            128 =>
                array(
                    'countryName' => 'Madagascar',
                    'code' => 'MG',
                    'phoneCode' => '261',
                ),
            129 =>
                array(
                    'countryName' => 'Malawi',
                    'code' => 'MW',
                    'phoneCode' => '265',
                ),
            130 =>
                array(
                    'countryName' => 'Malaysia',
                    'code' => 'MY',
                    'phoneCode' => '60',
                ),
            131 =>
                array(
                    'countryName' => 'Maldives',
                    'code' => 'MV',
                    'phoneCode' => '960',
                ),
            132 =>
                array(
                    'countryName' => 'Mali',
                    'code' => 'ML',
                    'phoneCode' => '223',
                ),
            133 =>
                array(
                    'countryName' => 'Malta',
                    'code' => 'MT',
                    'phoneCode' => '356',
                ),
            134 =>
                array(
                    'countryName' => 'Marshall Islands',
                    'code' => 'MH',
                    'phoneCode' => '692',
                ),
            135 =>
                array(
                    'countryName' => 'Martinique',
                    'code' => 'MQ',
                    'phoneCode' => '596',
                ),
            136 =>
                array(
                    'countryName' => 'Mauritania',
                    'code' => 'MR',
                    'phoneCode' => '222',
                ),
            137 =>
                array(
                    'countryName' => 'Mauritius',
                    'code' => 'MU',
                    'phoneCode' => '230',
                ),
            138 =>
                array(
                    'countryName' => 'Mayotte',
                    'code' => 'YT',
                    'phoneCode' => '262',
                ),
            139 =>
                array(
                    'countryName' => 'Mexico',
                    'code' => 'MX',
                    'phoneCode' => '52',
                ),
            140 =>
                array(
                    'countryName' => 'Micronesia',
                    'code' => 'FM',
                    'phoneCode' => '691',
                ),
            141 =>
                array(
                    'countryName' => 'Moldova',
                    'code' => 'MD',
                    'phoneCode' => '373',
                ),
            142 =>
                array(
                    'countryName' => 'Monaco',
                    'code' => 'MC',
                    'phoneCode' => '377',
                ),
            143 =>
                array(
                    'countryName' => 'Mongolia',
                    'code' => 'MN',
                    'phoneCode' => '976',
                ),
            144 =>
                array(
                    'countryName' => 'Montenegro',
                    'code' => 'ME',
                    'phoneCode' => '382',
                ),
            145 =>
                array(
                    'countryName' => 'Montserrat',
                    'code' => 'MS',
                    'phoneCode' => '1664',
                ),
            146 =>
                array(
                    'countryName' => 'Morocco',
                    'code' => 'MA',
                    'phoneCode' => '212',
                ),
            147 =>
                array(
                    'countryName' => 'Mozambique',
                    'code' => 'MZ',
                    'phoneCode' => '258',
                ),
            148 =>
                array(
                    'countryName' => 'Myanmar',
                    'code' => 'MM',
                    'phoneCode' => '95',
                ),
            149 =>
                array(
                    'countryName' => 'Namibia',
                    'code' => 'NA',
                    'phoneCode' => '264',
                ),
            150 =>
                array(
                    'countryName' => 'Nauru',
                    'code' => 'NR',
                    'phoneCode' => '674',
                ),
            151 =>
                array(
                    'countryName' => 'Nepal',
                    'code' => 'NP',
                    'phoneCode' => '977',
                ),
            152 =>
                array(
                    'countryName' => 'Netherlands',
                    'code' => 'NL',
                    'phoneCode' => '31',
                ),
            153 =>
                array(
                    'countryName' => 'New Caledonia',
                    'code' => 'NC',
                    'phoneCode' => '687',
                ),
            154 =>
                array(
                    'countryName' => 'New Zealand',
                    'code' => 'NZ',
                    'phoneCode' => '64',
                ),
            155 =>
                array(
                    'countryName' => 'Nicaragua',
                    'code' => 'NI',
                    'phoneCode' => '505',
                ),
            156 =>
                array(
                    'countryName' => 'Niger',
                    'code' => 'NE',
                    'phoneCode' => '227',
                ),
            157 =>
                array(
                    'countryName' => 'Nigeria',
                    'code' => 'NG',
                    'phoneCode' => '234',
                ),
            158 =>
                array(
                    'countryName' => 'Niue',
                    'code' => 'NU',
                    'phoneCode' => '683',
                ),
            159 =>
                array(
                    'countryName' => 'Norfolk Island',
                    'code' => 'NF',
                    'phoneCode' => '672',
                ),
            160 =>
                array(
                    'countryName' => 'North Korea',
                    'code' => 'KP',
                    'phoneCode' => '850',
                ),
            161 =>
                array(
                    'countryName' => 'Northern Mariana Islands',
                    'code' => 'MP',
                    'phoneCode' => '1670',
                ),
            162 =>
                array(
                    'countryName' => 'Norway',
                    'code' => 'NO',
                    'phoneCode' => '47',
                ),
            163 =>
                array(
                    'countryName' => 'Oman',
                    'code' => 'OM',
                    'phoneCode' => '968',
                ),
            164 =>
                array(
                    'countryName' => 'Pakistan',
                    'code' => 'PK',
                    'phoneCode' => '92',
                ),
            165 =>
                array(
                    'countryName' => 'Palau',
                    'code' => 'PW',
                    'phoneCode' => '680',
                ),
            166 =>
                array(
                    'countryName' => 'Palestine',
                    'code' => 'PS',
                    'phoneCode' => '970',
                ),
            167 =>
                array(
                    'countryName' => 'Panama',
                    'code' => 'PA',
                    'phoneCode' => '507',
                ),
            168 =>
                array(
                    'countryName' => 'Papua New Guinea',
                    'code' => 'PG',
                    'phoneCode' => '675',
                ),
            169 =>
                array(
                    'countryName' => 'Paraguay',
                    'code' => 'PY',
                    'phoneCode' => '595',
                ),
            170 =>
                array(
                    'countryName' => 'Peru',
                    'code' => 'PE',
                    'phoneCode' => '51',
                ),
            171 =>
                array(
                    'countryName' => 'Philippines',
                    'code' => 'PH',
                    'phoneCode' => '63',
                ),
            172 =>
                array(
                    'countryName' => 'Pitcairn Islands',
                    'code' => 'PN',
                    'phoneCode' => '64',
                ),
            173 =>
                array(
                    'countryName' => 'Poland',
                    'code' => 'PL',
                    'phoneCode' => '48',
                ),
            174 =>
                array(
                    'countryName' => 'Portugal',
                    'code' => 'PT',
                    'phoneCode' => '351',
                ),
            175 =>
                array(
                    'countryName' => 'Puerto Rico',
                    'code' => 'PR',
                    'phoneCode' => '1787',
                ),
            176 =>
                array(
                    'countryName' => 'Puerto Rico',
                    'code' => 'PR',
                    'phoneCode' => '1939',
                ),
            177 =>
                array(
                    'countryName' => 'Qatar',
                    'code' => 'QA',
                    'phoneCode' => '974',
                ),
            178 =>
                array(
                    'countryName' => 'Republic of the Congo',
                    'code' => 'CG',
                    'phoneCode' => '242',
                ),
            179 =>
                array(
                    'countryName' => 'Romania',
                    'code' => 'RO',
                    'phoneCode' => '40',
                ),
            180 =>
                array(
                    'countryName' => 'Russia',
                    'code' => 'RU',
                    'phoneCode' => '7',
                ),
            181 =>
                array(
                    'countryName' => 'Rwanda',
                    'code' => 'RW',
                    'phoneCode' => '250',
                ),
            182 =>
                array(
                    'countryName' => 'Réunion',
                    'code' => 'RE',
                    'phoneCode' => '262',
                ),
            183 =>
                array(
                    'countryName' => 'Saint Barthélemy',
                    'code' => 'BL',
                    'phoneCode' => '590',
                ),
            184 =>
                array(
                    'countryName' => 'Saint Kitts and Nevis',
                    'code' => 'KN',
                    'phoneCode' => '1869',
                ),
            185 =>
                array(
                    'countryName' => 'Saint Lucia',
                    'code' => 'LC',
                    'phoneCode' => '1758',
                ),
            186 =>
                array(
                    'countryName' => 'Saint Martin',
                    'code' => 'MF',
                    'phoneCode' => '590',
                ),
            187 =>
                array(
                    'countryName' => 'Saint Pierre and Miquelon',
                    'code' => 'PM',
                    'phoneCode' => '508',
                ),
            188 =>
                array(
                    'countryName' => 'Saint Vincent and the Grenadines',
                    'code' => 'VC',
                    'phoneCode' => '1784',
                ),
            189 =>
                array(
                    'countryName' => 'Samoa',
                    'code' => 'WS',
                    'phoneCode' => '685',
                ),
            190 =>
                array(
                    'countryName' => 'San Marino',
                    'code' => 'SM',
                    'phoneCode' => '378',
                ),
            191 =>
                array(
                    'countryName' => 'Saudi Arabia',
                    'code' => 'SA',
                    'phoneCode' => '966',
                ),
            192 =>
                array(
                    'countryName' => 'Senegal',
                    'code' => 'SN',
                    'phoneCode' => '221',
                ),
            193 =>
                array(
                    'countryName' => 'Serbia',
                    'code' => 'RS',
                    'phoneCode' => '381',
                ),
            194 =>
                array(
                    'countryName' => 'Seychelles',
                    'code' => 'SC',
                    'phoneCode' => '248',
                ),
            195 =>
                array(
                    'countryName' => 'Sierra Leone',
                    'code' => 'SL',
                    'phoneCode' => '232',
                ),
            196 =>
                array(
                    'countryName' => 'Singapore',
                    'code' => 'SG',
                    'phoneCode' => '65',
                ),
            197 =>
                array(
                    'countryName' => 'Sint Maarten',
                    'code' => 'SX',
                    'phoneCode' => '1721',
                ),
            198 =>
                array(
                    'countryName' => 'Slovakia',
                    'code' => 'SK',
                    'phoneCode' => '421',
                ),
            199 =>
                array(
                    'countryName' => 'Slovenia',
                    'code' => 'SI',
                    'phoneCode' => '386',
                ),
            200 =>
                array(
                    'countryName' => 'Solomon Islands',
                    'code' => 'SB',
                    'phoneCode' => '677',
                ),
            201 =>
                array(
                    'countryName' => 'Somalia',
                    'code' => 'SO',
                    'phoneCode' => '252',
                ),
            202 =>
                array(
                    'countryName' => 'South Africa',
                    'code' => 'ZA',
                    'phoneCode' => '27',
                ),
            203 =>
                array(
                    'countryName' => 'South Georgia',
                    'code' => 'GS',
                    'phoneCode' => '500',
                ),
            204 =>
                array(
                    'countryName' => 'South Korea',
                    'code' => 'KR',
                    'phoneCode' => '82',
                ),
            205 =>
                array(
                    'countryName' => 'South Sudan',
                    'code' => 'SS',
                    'phoneCode' => '211',
                ),
            206 =>
                array(
                    'countryName' => 'Spain',
                    'code' => 'ES',
                    'phoneCode' => '34',
                ),
            207 =>
                array(
                    'countryName' => 'Sri Lanka',
                    'code' => 'LK',
                    'phoneCode' => '94',
                ),
            208 =>
                array(
                    'countryName' => 'Sudan',
                    'code' => 'SD',
                    'phoneCode' => '249',
                ),
            209 =>
                array(
                    'countryName' => 'Suriname',
                    'code' => 'SR',
                    'phoneCode' => '597',
                ),
            210 =>
                array(
                    'countryName' => 'Svalbard and Jan Mayen',
                    'code' => 'SJ',
                    'phoneCode' => '4779',
                ),
            211 =>
                array(
                    'countryName' => 'Swaziland',
                    'code' => 'SZ',
                    'phoneCode' => '268',
                ),
            212 =>
                array(
                    'countryName' => 'Sweden',
                    'code' => 'SE',
                    'phoneCode' => '46',
                ),
            213 =>
                array(
                    'countryName' => 'Switzerland',
                    'code' => 'CH',
                    'phoneCode' => '41',
                ),
            214 =>
                array(
                    'countryName' => 'Syria',
                    'code' => 'SY',
                    'phoneCode' => '963',
                ),
            215 =>
                array(
                    'countryName' => 'São Tomé and Príncipe',
                    'code' => 'ST',
                    'phoneCode' => '239',
                ),
            216 =>
                array(
                    'countryName' => 'Taiwan',
                    'code' => 'TW',
                    'phoneCode' => '886',
                ),
            217 =>
                array(
                    'countryName' => 'Tajikistan',
                    'code' => 'TJ',
                    'phoneCode' => '992',
                ),
            218 =>
                array(
                    'countryName' => 'Tanzania',
                    'code' => 'TZ',
                    'phoneCode' => '255',
                ),
            219 =>
                array(
                    'countryName' => 'Thailand',
                    'code' => 'TH',
                    'phoneCode' => '66',
                ),
            220 =>
                array(
                    'countryName' => 'Timor-Leste',
                    'code' => 'TL',
                    'phoneCode' => '670',
                ),
            221 =>
                array(
                    'countryName' => 'Togo',
                    'code' => 'TG',
                    'phoneCode' => '228',
                ),
            222 =>
                array(
                    'countryName' => 'Tokelau',
                    'code' => 'TK',
                    'phoneCode' => '690',
                ),
            223 =>
                array(
                    'countryName' => 'Tonga',
                    'code' => 'TO',
                    'phoneCode' => '676',
                ),
            224 =>
                array(
                    'countryName' => 'Trinidad and Tobago',
                    'code' => 'TT',
                    'phoneCode' => '1868',
                ),
            225 =>
                array(
                    'countryName' => 'Tunisia',
                    'code' => 'TN',
                    'phoneCode' => '216',
                ),
            226 =>
                array(
                    'countryName' => 'Turkey',
                    'code' => 'TR',
                    'phoneCode' => '90',
                ),
            227 =>
                array(
                    'countryName' => 'Turkmenistan',
                    'code' => 'TM',
                    'phoneCode' => '993',
                ),
            228 =>
                array(
                    'countryName' => 'Turks and Caicos Islands',
                    'code' => 'TC',
                    'phoneCode' => '1649',
                ),
            229 =>
                array(
                    'countryName' => 'Tuvalu',
                    'code' => 'TV',
                    'phoneCode' => '688',
                ),
            230 =>
                array(
                    'countryName' => 'Uganda',
                    'code' => 'UG',
                    'phoneCode' => '256',
                ),
            231 =>
                array(
                    'countryName' => 'Ukraine',
                    'code' => 'UA',
                    'phoneCode' => '380',
                ),
            232 =>
                array(
                    'countryName' => 'United Arab Emirates',
                    'code' => 'AE',
                    'phoneCode' => '971',
                ),
            233 =>
                array(
                    'countryName' => 'United Kingdom',
                    'code' => 'GB',
                    'phoneCode' => '44',
                ),
            234 =>
                array(
                    'countryName' => 'United States',
                    'code' => 'US',
                    'phoneCode' => '1',
                ),
            235 =>
                array(
                    'countryName' => 'United States Virgin Islands',
                    'code' => 'VI',
                    'phoneCode' => '1340',
                ),
            236 =>
                array(
                    'countryName' => 'Uruguay',
                    'code' => 'UY',
                    'phoneCode' => '598',
                ),
            237 =>
                array(
                    'countryName' => 'Uzbekistan',
                    'code' => 'UZ',
                    'phoneCode' => '998',
                ),
            238 =>
                array(
                    'countryName' => 'Vanuatu',
                    'code' => 'VU',
                    'phoneCode' => '678',
                ),
            239 =>
                array(
                    'countryName' => 'Vatican City',
                    'code' => 'VA',
                    'phoneCode' => '379',
                ),
            240 =>
                array(
                    'countryName' => 'Venezuela',
                    'code' => 'VE',
                    'phoneCode' => '58',
                ),
            241 =>
                array(
                    'countryName' => 'Vietnam',
                    'code' => 'VN',
                    'phoneCode' => '84',
                ),
            242 =>
                array(
                    'countryName' => 'Wallis and Futuna',
                    'code' => 'WF',
                    'phoneCode' => '681',
                ),
            243 =>
                array(
                    'countryName' => 'Western Sahara',
                    'code' => 'EH',
                    'phoneCode' => '212',
                ),
            244 =>
                array(
                    'countryName' => 'Yemen',
                    'code' => 'YE',
                    'phoneCode' => '967',
                ),
            245 =>
                array(
                    'countryName' => 'Zambia',
                    'code' => 'ZM',
                    'phoneCode' => '260',
                ),
            246 =>
                array(
                    'countryName' => 'Zimbabwe',
                    'code' => 'ZW',
                    'phoneCode' => '263',
                ),
        );
        return $array;
    }

    public function ShopStart(Request $res)
    {

        try {
            $tok = DB::table('token_currencies')->where(['status' => 1, 'doller' => 1])->first();
            $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
            $userShopps = PurchasesShop::where('user_id', Auth::user()->id)->pluck('shop_id')->toArray();
            $shopDetail = AddShop::find($res->id);

            //log loyalty token here
            $tlog = new \App\TokenLog();
            $tlog->wallet_id = $userWallet->id;
            $tlog->user_id = $userWallet->user_id;
            $tlog->log_id = 1;

            // if( in_array($res->id , $userShopps) ){
            //     return response()->json(['error'=>'You Already Buy This Item '], 200);
            // }
            if ($shopDetail->price > $userWallet->earn_loyalty) {
                return response()->json(['error' => 'You have insufficient VIP points.'], 200);
            }

            // Save user shop
            $userPurchase = new \App\PurchasesShop();
            $userPurchase->shop_id = $res->id;
            $userPurchase->user_id = Auth::user()->id;
            $userPurchase->save();
            // Updating user loyalty
            $tlog->shop_type = $shopDetail->type;
            $tlog->usd_earn_before = $userWallet->usd;
            $tlog->token_before = $userWallet->token;
            $tlog->usd_before = $userWallet->usd;
            if ($shopDetail->type == 1) {
                $userWallet->usd += ($shopDetail->amount / $tok->pley6_token);
                $tlog->bonus_token_before = $userWallet->free_token;
                $userWallet->token = $userWallet->token + $shopDetail->amount;
                $tlog->bonus_token_after = $userWallet->free_token;
            } else {
                $tlog->free_spin_before = $userWallet->free_spin;
                $userWallet->free_spin = $userWallet->free_spin + $shopDetail->amount;
                $tlog->free_spin_after = $userWallet->free_spin;
            }

            $tlog->lt_earn_before = $userWallet->earn_loyalty;
            $userWallet->earn_loyalty = $userWallet->earn_loyalty - $shopDetail->price;
            $userWallet->used_loyalty = $userWallet->used_loyalty + $shopDetail->price;
            $tlog->lt_earn_after = $userWallet->earn_loyalty;
            $userWallet->save();


            $tlog->token_after = $userWallet->token;
            $tlog->usd_after = $userWallet->usd;


            $tlog->usd_earn_after = $userWallet->usd;
            $tlog->item_id = $shopDetail->id;
            $tlog->save();

            // notification
            $notification = new \App\Notification;
            $notification->user_id = Auth::id();
            $notification->message = 'You have purchased Item from VIP Shop successfully';
            $notification->save();

            return response()->json(['success' => 'success'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }

        // try {
        //     $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        //     $amount = Account::where('user_id',Auth::user()->id)->sum('balance');
        //     $amount =$tok->pley6_token * floatval($system_token);

        //     $data = AddShop::find($res->id);
        //     if($data->price > $amount){
        //         return response()->json(['error'=>'Your balance is insuffient'], 200);
        //     }
        //     if (is_null($data)) {
        //         return response()->json(['error'=>'Not found!'], 200);
        //     }else {
        //             $mission = new \App\PurchasesShop();
        //             $mission->shop_id = $res->id;
        //             $mission->user_id = Auth::user()->id;
        //             $mission->save();
        //             $acc= Account::where('user_id',Auth::id())->first();
        //             $acc->balance=$acc->balance - floatval(@$data->price);
        //             $acc->save();
        //             $bonus_type = 'shop_token';
        //             $bonus_from = 'casino';
        //             Wallet($data->amount,$bonus_type,$bonus_from,Auth::id());

        //             /* $admin_token = Account::where('user_id',1)->first();
        //             $admin_token->total = $admin_token->total + $Mtoken;
        //             $admin_token->save(); */
        //             //logCreatedActivity($data,$bonus_type,$data);


        //             return response()->json(['success'=>'success'], 200);
        //      }
        // } catch (\Exception $e) {
        //     return response()->json(['error'=>'Something went wrong! try again'], 200);
        // }
    }

    public function update(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'first_name' => 'sometimes|nullable|string|max:255',
            'last_name' => 'sometimes|nullable|string|max:255',
            'email' => "unique:users,email,".Auth::user()->id.",id",
            'zipcode' => 'sometimes|nullable|required',
            'Language' => 'sometimes|nullable|string|max:255',
            'state' => 'sometimes|nullable|string|max:255',
            'country' => 'sometimes|nullable|string|max:255',
            'Address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|min:8,'.Auth::user()->id.",id",
            'dob' => 'sometimes|nullable|before:-18 years',
        ],
            [
                'dob.before'  => 'You must be at least 18 years old',
                'phone.min'   => 'Phone number must be at least 8 digits'
            ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('setting_tab','general');
        }
        // dd($r->all());
//        $r->validate([
//            'first_name' => 'sometimes|nullable|string|max:255',
//            'last_name' => 'sometimes|nullable|string|max:255',
//            'email' => "unique:users,email,".Auth::user()->id.",id",
//            'zipcode' => 'sometimes|nullable|required',
//            'Language' => 'sometimes|nullable|string|max:255',
//            'state' => 'sometimes|nullable|string|max:255',
//            'country' => 'sometimes|nullable|string|max:255',
//            'Address' => 'sometimes|nullable|string|max:255',
//            'phone' => 'sometimes|nullable',
//            'dob' => 'sometimes|nullable|before:-18 years',
//        ],
//            [
//                'dob.before'  => 'You must be at least 18 years old'
//            ]
//        );

//        $this->update_pro_session($id,$r);
        try {
            $user_pr = User::findOrFail($id);
            //old email
            $old_email = $user_pr->email;
            $user_pr->phone = strip_tags($r->phone);
            $user_pr->country_code = strip_tags($r->phone_phoneCode);
            $user_pr->save();
            $user = UserProfile::where('user_id',$id)->first();
            $user->first_name = strip_tags($r->first_name);
            $user->last_name = strip_tags($r->last_name);
            $user->country = strip_tags($r->country);
            $user->state = strip_tags($r->state);
            $user->zipcode = strip_tags($r->zipcode);
            $user->phone_number = strip_tags($r->phone);
            $user->address = strip_tags($r->Address);
            $user->date_of_birth = date('Y-m-d', strtotime(strip_tags($r->dob)));
            $user->gender = strip_tags($r->gender);
            $user->language = strip_tags($r->Language);

            if ($r->hasFile('image')) {
                $file = $r->file('image');
                $images = Image::canvas(300, 300, '#fff');
                $image = Image::make($file)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $pathImage = 'user/profile/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $images->save('user/profile/' . $name);
                    $user->base_image = $name;
                } else {
                    $name = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    if ($user->base_image) {
                        if ($user->base_image != 'user/profile/avatar.png') {
                            File::delete('user/profile/' . $user->base_image);
                        }
                    }
                    $images->save('user/profile/' . $name);
                    $user->base_image = 'user/profile/' . $name;
                }
                $user->save();

            }

            $user->save();
            if ($old_email != $r->email) {
                $r->validate([
                    'email' => 'required|unique:users',
                ]);
                $check                            = UpdateProfileHistory::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
                if (($check==null || $check->count()==0) || (Carbon::parse($check->created_at)->diffInDays(Carbon::now()))>=14) {
                    $update_history              = new UpdateProfileHistory();
                    $update_history->user_id     = Auth::user()->id;
                    $update_history->old_response = \Opis\Closure\serialize($user_pr);
                    $update_history->save();
                    $email = $r->email;
                    $user_pr->email = $r->email;
                    $user_pr->verified = 0;
                    $user_pr->save();
                    $verifyUser = VerifyUser::where('user_id', $user_pr->id)->first();
                    if (!isset($verifyUser)) {
                        $verifyUser = new VerifyUser();
                    }
                    $user_token  =  str_random(40);
                    $verifyUser->user_id = $user_pr->id;
                    $verifyUser->token = $user_token;
                    $verifyUser->save();
                    Mail::send('mail.email_verify', [
                        'username' => $user_pr->user_name,
                        'verify_url' => url('user/verify', $verifyUser->token),
                        'user_token' => $user_token
                    ], function ($message) use ($email) {
                        $message->subject('ProperSix email verification');
                        $message->to($email);
                    });
                    return view('frontend.login.after_reg', [
                        'data' => '1',
                        'userId' => $user_pr->id
                    ]);
                }
                else
                {
                    Toastr::error("Can't update email now try after ".(14-Carbon::parse($check->created_at)->diffInDays(Carbon::now())). " days");
                    return redirect()->back()->with('setting_tab','general');
                }
            }
            Toastr::success('User profile updated successfully.', 'Success');
            return redirect()->back()->with('setting_tab','general');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ', 'Error');
            return redirect()->back()->with('setting_tab','general');
        }
    }

    public function update_avatar(Request $r, $id)
    {
        try {
//         $this->update_pro_session(Auth::user()->id,$r);
            $user_pr = User::findOrFail($id);
            $user = $user_pr->profile;
            if ($r->hasFile('avatar_upload')) {
                $file = $r->file('avatar_upload');
                $images = Image::canvas(300, 300, '#fff');
                $image = Image::make($file)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $pathImage = 'user/profile/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $images->save('user/profile/' . $name);
                    $user->base_image = $name;
                } else {
                    $name = (Auth::user()->user_name!=null?str_replace(' ', '', Auth::user()->user_name):Auth::user()->id).'_'.time() .'_'.str_random(10). '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    if ($user->base_image) {
                        if ($user->base_image != 'user/profile/avatar.png') {
                            File::delete('user/profile/' . $user->base_image);
                        }
                    }
                    $images->save('user/profile/' . $name);
                    $user->base_image = 'user/profile/' . $name;
                }
                $user->save();
                Toastr::success('User profile updated successfully.', 'Success');
                return redirect()->back()->with('setting_tab','avatar');
            } else {
                if ($r->get('avatar_test')) {
                    $user->base_image = $r->get('avatar_test');
                    $user->save();
                    Toastr::success('User profile updated successfully.', 'Success');
                    return redirect()->back()->with('setting_tab','avatar');
                }
                Toastr::success('User profile updated successfully.', 'Success');
                return redirect()->back()->with('setting_tab','avatar');
            }

        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again', 'Error');
            return redirect()->back()->with('setting_tab','avatar');
        }


    }

    public function Security(Request $r, $id)
    {
        //   dd($r->all());
        $r->validate([
            'secret_answer' => 'required|string|max:255',
            'secret_question' => 'required|string|max:255',
            'password' => 'required|min:8|max:20',
        ]);
//        $this->update_pro_session(Auth::user()->id,$r);
        try {
            if (!\Hash::check($r->password, auth()->user()->password)) {
                Toastr::error('The password is incorrect.');
                return redirect()->back();
            } else {

                $user_pr = User::findOrFail($id);

                $user = $user_pr->profile;
                $user->secret_question = $r->secret_question;
                $user->secret_answer = $r->secret_answer;
                $user->save();
                Toastr::success('Security question updated successfully.', 'Success');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ', 'Error');
            return redirect()->back();
        }
    }

    public function PasswordChange(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'old_password' => 'required|min:8|max:20',
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('setting_tab','security');
        }
//        $this->update_pro_session(Auth::user()->id,$r);
        try {
            if (!\Hash::check($r->old_password, auth()->user()->password)) {
                Toastr::error('The password is incorrect.');
                return redirect()->back()->with('setting_tab','security');
            }
            elseif($r->old_password==$r->password)
            {
                Toastr::warning('New password can’t be the old password.');
                return redirect()->back()->with('setting_tab','security');
            }
            else {

                $user = User::findOrFail($id);

                $user->password = Hash::make($r->password);
                $user->save();
                Toastr::success('Password updated successfully!', 'Success');
                return redirect()->back()->with('setting_tab','security');
            }

        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ', 'Error');
            return redirect()->back()->with('setting_tab','security');
        }
    }

    function currency_convert($amount)
    {
        try {
            $data = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
            $result = $data->pley6_token * floatval($amount);
            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json('data not found', 400);
        }
    }

    function Proupdate(Request $r)
    {
        $user = Auth::user()->profile;
        try {
            if ($r->hasFile('image')) {
                $file = $r->file('image');
                $images = Image::canvas(300, 300, '#fff');
                $image = Image::make($file)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $pathImage = 'user/profile/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $name = (Auth::user()->user_name != null ? Auth::user()->user_name : Auth::user()->id) . '_' . time() . '_' . str_random(10) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $images->save('user/profile/' . $name);
                    $user->base_image = $name;
                } else {
                    $name = (Auth::user()->user_name != null ? Auth::user()->user_name : Auth::user()->id) . '_' . time() . '_' . str_random(10) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    if ($user->base_image) {
                        if ($user->base_image != 'user/profile/avatar.png') {
                            File::delete('user/profile/' . $user->base_image);
                        }
                    }
                    $images->save('user/profile/' . $name);
                    $user->base_image = 'user/profile/' . $name;
                }
                $user->save();

            }
            return response()->json(['success' => 'done', 200]);
        }catch (\Exception $e) {
            Toastr::error('Something went wrong ! please try again');
            return redirect()->back();
        }

    }

    public function InboxDelete($ids, $type)
    {
        try {
            if ($ids != []) {
                foreach (json_decode($ids) as $key => $value) {
                    $data = Notification::findOrFail($value);
                    $data->delete();
                }
                $dat = DB::table('notifications')->where('user_id', Auth::user()->id)->where('status', 0)->count();
                return response()->json(['success' => 'success', 'item' => $dat], 200);
            } else {
                return response()->json(['error' => 'Inbox not delete'], 200);
            }
        } catch (\Exception $e) {
            //return response()->json($e, 200);
            return response()->json(['error' => 'Something went wrong! try again'], 200);
        }

    }

    public function account_deactivate(Request $request)
    {
        $data = User::find($request->id);
        if ($request->question == Auth::user()->ans && Hash::check($request->password, $data->password)) {
            $data = new Account_deactivate;
            $data->user_id = $request->id;
            $data->time = $request->time;
            $data->reason = $request->reason;
            $data->save();
            Toastr::success('Thank you for submitting', 'Success');
            return response()->json(['data' => json_encode($request->all())], 200);
        } else {
            return response()->json('Please enter correct value', 400);
        }
    }

    public function support(Request $request)
    {
        $data = new Helpline;
        $data->user_id = $request->id;
        $data->email = $request->email;
        $data->message = $request->message;
        $data->priority = $request->priority;
        $data->save();
        Toastr::success('Thank you for submitting the request', 'Success');
        return response()->json(['data' => json_encode($request->all())], 200);

    }

    public function InboxSee($id)
    {

        $not_view = \App\LeaveNote::findOrFail($id);
        $not_view->status = 1;
        $not_view->save();
        $dat = DB::table('leave_notes')->where('user_id', Auth::user()->id)->where('status', 0)->count();
        return response()->json(['success' => 'success', 'item' => $dat], 200);
    }

    public function notification_id(Request $request, $id)
    {

        $not_view = \App\Notification::findOrFail($id);
        $not_view->status = 1;
        $not_view->save();
        return response()->json($not_view, 200);
    }

    function balnceUpdate()
    {
        if (Auth::check()) {
            $balance = Auth::user()->account->total;
            return response()->json($balance, 200);
        } else {
            $balance = 0;
            return response()->json($balance, 200);
        }
    }

    function UserPrevent()
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            $user->game_status = 0;
            $user->save();
            return response()->json($user, 200);
        }
    }

    function favorite_game($id)
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            if (@$user->favorite_game->count() > 0) {
                @$game = FavoriteGame::where('user_id', $user->id)->where('game_id', $id)->first();
                if (!@$game) {
                    $fav = new FavoriteGame();
                    $fav->user_id = $user->id;
                    $fav->game_id = $id;
                    $fav->save();
                    return response()->json(['success' => 'success'], 200);
                }
                @$game->delete();
                return response()->json(['delete' => 'success'], 200);
            }
            $fav = new FavoriteGame();
            $fav->user_id = $user->id;
            $fav->game_id = $id;
            $fav->save();
            return response()->json(['success' => 'success'], 200);
        } else {
            return response()->json(['error' => 'something went wrong'], 200);
        }
    }

    function Get_favorite_game()
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            if (@$user->favorite_game->count() > 0) {
                return response()->json(@$user->favorite_game, 200);
            }
            return response()->json([], 200);
        } else {
            return response()->json(['error' => 'something went wrong'], 200);
        }
    }

    function Apply_Bonus($bonus_code)
    {
        $profile = \DB::table("user_profiles")->where('user_id', Auth::user()->id)->first();
        //code to check if user has met the previous bonus wager requirement
        $user_codebonus = DB::table('bonuses')
            ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
            ->select('amount', 'add_bonus_id', 'status', 'bonuses.created_at as creationdate')
            ->where('user_id', Auth::user()->id)
            ->where('bonuses.type', 'code')
            ->orderBy('bonuses.created_at', 'desc')
            ->first();
        if ($user_codebonus) {
            $totalwageredamount = DB::table('game_session_childs')
                ->select(DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id', Auth::user()->id)
                ->where('spin_type', 'paid')
                ->where('created_at', '>=', $user_codebonus->creationdate)
                ->first();
            if ($totalwageredamount->wageredamount < ($user_codebonus->amount * 35)) {
                return response()->json(["error" => "You have not completed 35x (" . ($user_codebonus->amount * 35) . " tokens) wagering requirement of previously availed bonus!"], 200);
            }
        }
        //wager requirement check end
        # code...
        $bonus = PropersixBonus::where('type', 'code')->where('bonus_code', $bonus_code)->where('status', 1)->first();
        if (!$bonus) {
            return response()->json(['error' => 'Invalid  or expire Bonus Code!'], 200);
        }
        $exCountries = ($bonus->ex_country) ? explode(',', $bonus->ex_country) : [];

        $userBonus = Bonus::where('add_bonus_id', $bonus->id)->where('user_id', $profile->user_id)->first();

        if ($userBonus) {
            return response()->json(['error' => 'Bonus already availed!'], 200);
        }

        $eligible = false;

        if (!in_array($profile->country, $exCountries)) {
            $eligible = true;
        } else {
            return response()->json(['error' => 'This bonus is not applicable in your region.'], 200);
        }


        if ($eligible && !$userBonus) {


            if ($bonus->wagering_req == 0 || $bonus->wagering_req == '') {

                $user = \App\User::where('id', Auth::user()->id)->first();
                if ($bonus->specific_day) {

                    $bnousDate = date('Y-m-d', strtotime($bonus->specific_day));
                    $currentDate = date('Y-m-d', time());

                    if ($bnousDate == $currentDate) {
                        // toDO
                        $this->Bonus($user, $bonus);
                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'This code is Valid for only 24 hours'], 200);
                    }

                }
                if ($bonus->till) {
                    $bnousfrom = strtotime($bonus->from);
                    $bnoustill = strtotime(date('Y-m-d 23:59:59', strtotime($bonus->till)));
                    $currentDate = time();
                    /*echo $bnousfrom.'</br>';
                    echo 'from'.date('y-m-d',$bnousfrom).'</br>';
                    echo $bnoustill.'</br>';
                    echo 'till'.date('y-m-d',$bnoustill).'</br>';
                    echo $currentDate.'</br>';
                    echo 'current'.date('y-m-d',$currentDate).'</br>';*/
                    if ($bnousfrom <= $currentDate && $currentDate <= $bnoustill) {
                        //toDo

                        $this->Bonus($user, $bonus);
                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'This code is valid between ' . $bonus->from . ' and ' . date('Y-m-d 23:59:59', strtotime($bonus->till))], 200);
                    }
                }
            } elseif ($bonus->wagering_req != 0 || $bonus->wagering_req != '') {


                $user = \App\User::where('id', Auth::user()->id)->first();
                if ($bonus->specific_day) {
                    $bonusdateforchecking = date('Y-m-d', strtotime($bonus->specific_day));
                    $userspending = DB::table('game_session_childs')
                        ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                        ->where('user_id', $user->id)
                        ->where(DB::raw('date(created_at)'), $bonusdateforchecking)
                        ->where('spin_type', 'paid')
                        ->groupBy('game_id')
                        ->first();
                    $bnousDate = date('Y-m-d', strtotime($bonus->specific_day));
                    $currentDate = date('Y-m-d', time());

                    if ($bnousDate == $currentDate && $bonus->wagering_req <= $userspending->wageredamount) {
                        // toDO
                        $this->Bonus($user, $bonus);
                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this Bonus.This code is Valid for only 24 hours'], 200);
                    }
                }
                if ($bonus->till) {
                    $bonusdateforcheckingfrom = date('Y-m-d 00:00:00', strtotime($bonus->from));
                    $bonusdateforcheckingtill = date('Y-m-d 23:59:59', strtotime($bonus->till));
                    $userspending = DB::table('game_session_childs')
                        ->select(DB::raw('date(created_at)'), DB::raw('date(created_at)'), DB::raw('SUM(bet_size*payline) as wageredamount'))
                        ->where('user_id', $user->id)
                        ->where(DB::raw('date(created_at)'), '>=', $bonusdateforcheckingfrom)
                        ->where(DB::raw('date(created_at)'), '<=', $bonusdateforcheckingtill)
                        ->where('spin_type', 'paid')
                        ->groupBy('game_id')
                        ->first();
                    $bnousfrom = strtotime($bonus->from);
                    $bnoustill = strtotime(date('Y-m-d 23:59:59', strtotime($bonus->till)));
                    $currentDate = time();

                    if ($bnousfrom <= $currentDate && $currentDate <= $bnoustill && $userspending->wageredamount >= $bonus->wagering_req) {
                        //toDo
                        $this->Bonus($user, $bonus);
                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'Your current wagered amount ' . $userspending->wageredamount . '  has to be greater than ' . $bonus->wagering_req . ' tokens to get this bonus.This code is valid between ' . $bonus->from . ' and ' . date('Y-m-d 23:59:59', strtotime($bonus->till))], 200);
                    }
                }
            } else {
                return response()->json(['error' => 'Wagered amount is not enough to get this bonus'], 200);
            }

        }
        return response()->json(['error' => 'Bonus Code Expired'], 200);
    }

    function Apply_Bonusasd($bonus_code)
    {

        $bonus = PropersixBonus::where('type', 'code')->where('bonus_code', $bonus_code)->where('status', 1)->first();
        DB::beginTransaction();
        if (!is_null($bonus)) {
            if (@$bonus->users) {
                if (@UserCheck($bonus_code) <= 0) {
                    return response()->json(['error' => 'You are not eligible for a bonus.'], 200);
                }
            }
            /*  if (@$bonus->ex_country) { */
            $data = PropersixBonus::where('type', 'code')->where('bonus_code', $bonus_code)->where('ex_country', 'like', '%' . Auth::user()->profile->country . '%')->get();
            if (@$data->count() > 0) {
                return response()->json(['error' => 'Your country is not eligible for a bonus.'], 200);
            } else {
                $b_c = Bonus::where('add_bonus_id', @$bonus->id)->first();
                if (@$b_c) {
                    return response()->json(['error' => 'Bonus code invalid'], 200);
                }
                if (@$bonus->specific_day) {
                    $data = PropersixBonus::where('type', 'code')->where('bonus_code', $bonus_code)->where('specific_day', '=', Carbon::today()->toDateString())->first();
                    if (@$data->count() > 0) {

                        $bonus = new \App\Bonus;
                        $bonus->user_id = Auth::id();
                        $bonus->amount = $data->bonus_amount;
                        $bonus->spin = @$data->free_spin;
                        $bonus->betsize = @$data->bet_size;
                        $bonus->line = @$data->lines;
                        $bonus->type = $data->type;
                        $bonus->from = 'casino';
                        $bonus->to = Auth::user()->user_name;
                        $bonus->save();

                        // notification
                        $notification = new \App\Notification;
                        $notification->user_id = Auth::id();
                        $notification->message = 'You got ' . $data->bonus_amount . ' token and ' . $data->free_spin . ' spin bonus';
                        $notification->save();

                        /*$account = Account::where('user_id', Auth::id())->first();
                        $account->total = $data->bonus_amount;
                        $account->total_spin = $data->free_spin;
                        $account->save();*/

                        $wal = ProsixWalletType::where('type', $bonus->type)->first();
                        if (is_null($wal)) {
                            $wallet_type = new ProsixWalletType();
                        } else {
                            $wallet_type = $wal;
                        }
                        $wallet_type->type = $bonus->type;
                        $wallet_type->save();

                        $wallet = new ProsixWallet();
                        $wallet->user_id = Auth::user()->id;
                        $wallet->amount = $data->bonus_amount;
                        $wallet->type_id = $wallet_type->id;
                        $wallet->created_by = Auth::id();
                        $wallet->save();

                        $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => Auth::id()]);
                        $userWallet->free_token = $userWallet->free_token + floatval(@$data->bonus_amount);
                        $userWallet->free_spin = $userWallet->free_spin + floatval(@$data->free_spin);
                        $userWallet->type_id = $wallet_type->id;
                        $userWallet->save();

                        $user_id = Auth::id();
                        $logModel = $bonus;
                        $request = $bonus;
                        $log = $bonus->type;
                        logCreatedActivity($user_id, $logModel, $request, $log);

                        DB::commit();

                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'Bonus code expired'], 200);
                    }
                } elseif (@$bonus->till) {
                    $data = PropersixBonus::where('type', 'code')
                        ->where('bonus_code', $bonus_code)
                        ->where('from', '<=', Carbon::today()->toDateString())
                        ->where('till', '>=', Carbon::today()->toDateString())
                        ->first();
                    if ($data->count() > 0) {
                        // s
                        $bonus = new \App\Bonus;
                        $bonus->user_id = Auth::id();
                        $bonus->amount = $data->bonus_amount;
                        $bonus->spin = @$data->free_spin;
                        $bonus->betsize = @$data->bet_size;
                        $bonus->line = @$data->lines;
                        $bonus->type = $data->type;
                        $bonus->from = 'casino';
                        $bonus->to = Auth::user()->user_name;
                        $bonus->save();

                        // notification
                        $notification = new \App\Notification;
                        $notification->user_id = Auth::id();
                        $notification->message = 'You got ' . $data->bonus_amount . ' token and ' . $data->free_spin . ' spin bonus';
                        $notification->save();

                        /*$account = Account::where('user_id', Auth::id())->first();
                        $account->total = $data->bonus_amount;
                        $account->total_spin = $data->free_spin;
                        $account->save();*/

                        $wal = ProsixWalletType::where('type', $bonus->type)->first();
                        if (is_null($wal)) {
                            $wallet_type = new ProsixWalletType();
                        } else {
                            $wallet_type = $wal;
                        }
                        $wallet_type->type = $bonus->type;
                        $wallet_type->save();

                        $wallet = new ProsixWallet();
                        $wallet->user_id = Auth::user()->id;
                        $wallet->amount = $data->bonus_amount;
                        $wallet->type_id = $wallet_type->id;
                        $wallet->created_by = Auth::id();
                        $wallet->save();

                        $userWallet = ProsixUserWallet::updateOrCreate(['user_id' => Auth::id()]);
                        $userWallet->free_token = $userWallet->free_token + floatval(@$data->bonus_amount);
                        $userWallet->free_spin = $userWallet->free_spin + floatval(@$data->free_spin);
                        $userWallet->type_id = $wallet_type->id;
                        $userWallet->save();

                        $user_id = Auth::id();
                        $logModel = $bonus;
                        $request = $bonus;
                        $log = $bonus->type;
                        logCreatedActivity($user_id, $logModel, $request, $log);

                        DB::commit();
                        return response()->json(['success' => 'success'], 200);
                    } else {
                        return response()->json(['error' => 'Bonus code expired'], 200);
                    }

                }
            }

            /*  } else {

                 return response()->json(['error'=>'You are not eligible for a bonus.'], 200);
             } */

        } else {
            return response()->json(['error' => 'Invalid bonus code'], 200);
        }
    }

    function Bonus($user, $data)
    {
            $bonus = new \App\Bonus;
            $bonus->user_id = $user->id;
            $bonus->add_bonus_id = $data->id;
            $bonus->amount = $data->bonus_amount;
            $bonus->spin = $data->free_spin;
            $bonus->betsize = $data->bet_size;
            $bonus->line = $data->lines;
            $bonus->type = $data->type;
            $bonus->from = 'casino';
            $bonus->to = $user->user_name;
            $bonus->save();
            // logCreatedActivity($data,$bonus->type,$bonus);
            // notification
            $notification = new \App\Notification;
            $notification->user_id = $user->id;
            if (($data->bonus_amount != 0 || $data->bonus_amount != '') && ($data->free_spin != 0 || $data->free_spin != '')) {
                $notification->message = 'You got ' . $data->bonus_amount . ' free tokens and ' . $data->free_spin . ' free spin using bonus code.';
            }
            if (($data->bonus_amount == 0 || $data->bonus_amount == '') && ($data->free_spin != 0 || $data->free_spin != '')) {
                $notification->message = 'You got ' . $data->free_spin . ' free spins using bonus code.';

            }
            if (($data->bonus_amount != 0 || $data->bonus_amount != '') && ($data->free_spin == 0 || $data->free_spin == '')) {
                $notification->message = 'You got ' . $data->bonus_amount . ' free tokens using bonus code.';

            }
            $notification->save();

            $wal = ProsixWalletType::where('type', $bonus->type)->first();
            if (is_null($wal)) {
                $wallet_type = new ProsixWalletType();
            } else {
                $wallet_type = $wal;
            }
            $wallet_type->type = $bonus->type;
            $wallet_type->save();
            $wallet = new ProsixWallet();
            $wallet->user_id = Auth::user()->id;
            $wallet->amount = $data->bonus_amount;
            $wallet->type_id = $wallet_type->id;
            $wallet->created_by = Auth::id();
            $wallet->save();

            $account = ProsixUserWallet::updateOrCreate(['user_id' => $user->id]);
            $account->free_token = $account->free_token + floatval(@$data->bonus_amount);
            $account->free_spin = $account->free_spin + floatval(@$data->free_spin);
            $account->type_id = $wallet_type->id;
            $account->save();

            $user_id = Auth::id();
            $logModel = $bonus;
            $request = $bonus;
            $log = $bonus->type;
            logCreatedActivity($user_id, $logModel, $request, $log);
    }

    public function MissionStart(Request $res)
    {
        try {
            $data = MissionBonus::find($res->id);
            $curDate = date('Y-m-d');
            /*            $amount = DB::table('game_earnings')->where('user_id',Auth::user()->id)->sum('token');*/
            $userMissionsCom = UserMission::where('user_id', Auth::user()->id)->where('status', '1')->pluck('mission_id')->toArray();
            $userMissionsPending = UserMission::where('user_id', Auth::user()->id)->where('status', '0')->pluck('mission_id')->toArray();

            if (count($userMissionsPending)) {
                return response()->json(['error' => 'You can not start two missions at a time'], 200);
            }

            if (in_array($data->id, $userMissionsCom)) {
                return response()->json(['error' => 'Mission Already Completed '], 200);
            }
            if (in_array($data->id, $userMissionsPending)) {
                return response()->json(['error' => 'Mission Already Started '], 200);
            }
            if ($data->specific_day != '') {
                if ($data->specific_day < $curDate) {
                    return response()->json(['error' => 'Mission Expired'], 200);
                }
            } elseif ($data->date_m == 'w') {
                if ($data->d_m != date('D')) {
                    return response()->json(['error' => 'Mission is not valid for this day of WEEK'], 200);
                }
            } elseif ($data->date_m == 'm') {
                if ($data->d_m != date('d')) {
                    return response()->json(['error' => 'Mission is not valid for this day of MONTH'], 200);
                }
            }


            $newMission = new UserMission();

            $newMission->mission_id = $res->id;
            $newMission->user_id = Auth::user()->id;
            $newMission->mission_date = $curDate;
            $newMission->save();

            return response()->json(['success' => 'success'], 200);
            // if (@$amount >= $data->amount || $data->id == 1) {
            //     if (is_null($data)) {
            //         return response()->json(['error'=>'Not found!'], 200);
            //     }else {
            //         $complt = UserMission::where(['mission_id'=>$res->id,'user_id'=>Auth::user()->id,'status'=>0])->first();
            //         if (!is_null($complt)) {
            //             return response()->json(['error'=>'Already completed mission!'], 200);
            //         }
            //         $d = UserMission::where(['mission_id'=>$res->id,'user_id'=>Auth::user()->id,'status'=>1])->first();
            //         if (!is_null($d)) {
            //             return response()->json(['error'=>'Already Started mission!'], 200);
            //         }else {
            //             $change = UserMission::where(['user_id'=>Auth::user()->id,'status'=>1])->get();
            //             if (@$change) {
            //             foreach ($change as $key => $value) {
            //                 $value->status = 0;
            //                 $value->save();
            //             }
            //             }
            //             $mission = new UserMission();
            //             $mission->mission_id = $res->id;
            //             $mission->user_id = Auth::user()->id;
            //             $mission->save();
            //             return response()->json(['success'=>'success'], 200);
            //         }
            //     }
            // }
            // else{
            //     return response()->json(['error'=>'Insufficient wager amount'], 200);
            // }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }


    function BuyToken($amount)
    {
        $amount = intval($amount);
        if (!is_int($amount)) {
            return response()->json(['input_error' => 'Please insert valid number'], 200);
        }
        if ($amount <= 0) {
            return response()->json(['input_error' => 'Please insert valid number'], 200);
        }
        DB::beginTransaction();
        try {
            $acc = ProsixUserWallet::where('user_id', Auth::id())->first();
            if (@$acc->usd < @$amount) {
                return response()->json(['error' => 'Your balance is insuffient'], 200);
            }

            $token_currency = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
            $token = $amount * $token_currency->pley6_token;

            $type = 'buy_token';

            $wal = ProsixWalletType::where('type', $type)->first();
            if (is_null($wal)) {
                $wallet_type = new ProsixWalletType();
            } else {
                $wallet_type = $wal;
            }
            $wallet_type->type = $type;
            $wallet_type->save();

            $wallet = new ProsixWallet();
            $wallet->user_id = Auth::user()->id;
            $wallet->amount = $token;
            $wallet->type_id = $wallet_type->id;
            $wallet->created_by = Auth::id();
            $wallet->save();

            $userWallet = ProsixUserWallet::where('user_id', Auth::id())->first();
            $userWallet->token = $userWallet->token + $token;
            $userWallet->usd = $userWallet->usd - floatval($amount);
            $userWallet->type_id = $wallet_type->id;
            $userWallet->save();

            $AdminWallet = ProsixUserWallet::where('user_id', 1)->first();
            $AdminWallet->token = $AdminWallet->token + $token;
            $AdminWallet->type_id = $wallet_type->id;
            $AdminWallet->save();
            $user_id = Auth::id();
            $logModel = $userWallet;
            $request = $userWallet;
            $log = $type;
            logCreatedActivity($user_id, $logModel, $request, $log);
            DB::commit();
            return response()->json(['success' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 200);
        }

    }

    public function progressbar()
    {
        $tok = DB::table('token_currencies')->where('doller', 1)->where('status', 1)->first();
        $userWallet = ProsixUserWallet::where('user_id', Auth::user()->id)->first();
        $userDeposites = DB::table('deposits')->where('user_id', Auth::user()->id)->sum('amount');
        $usertokens = $userWallet->token;
        $userdeposit_tokens = $userDeposites * $tok->pley6_token;

        //code to check bonus code wager
        $user_codebonus = DB::table('bonuses')
            ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
            ->select('amount', 'add_bonus_id', 'status', 'bonuses.created_at as creationdate')
            ->where('user_id', Auth::user()->id)
            ->where('bonuses.type', 'code')
            ->orderBy('bonuses.created_at', 'desc')
            ->first();
        if ($user_codebonus) {
            $totalwageredamount = DB::table('game_session_childs')
                ->select(DB::raw('SUM(bet_size*payline) as wageredamount'))
                ->where('user_id', Auth::user()->id)
                ->where('spin_type', 'paid')
                ->where('created_at', '>=', $user_codebonus->creationdate)
                ->first();
            if ($totalwageredamount->wageredamount < ($user_codebonus->amount * 35)) {
                return [
                    'wagerprogress' => $totalwageredamount->wageredamount,
                    'totalwager' => $user_codebonus->amount * 35
                ];
            }
        }
        //code to check bonus code end

        $user_registrationbonus = DB::table('bonuses')
            ->join('propersix_bonuses', 'bonuses.add_bonus_id', '=', 'propersix_bonuses.id')
            ->select('amount', 'add_bonus_id', 'status')
            ->where('user_id', Auth::user()->id)
            ->where('bonuses.type', 'registration_bonus')
            ->first();

        if ($user_registrationbonus) {
            if ($user_registrationbonus->status == '1') {
                if ($usertokens < $userdeposit_tokens) {
                    return 0;
                }
                $totalwageredamount = DB::table('game_session_childs')
                    ->select(DB::raw('SUM(bet_size*payline) as wageredamount'))
                    ->where('user_id', Auth::user()->id)
                    ->where('spin_type', 'paid')
                    ->first();
                if ($totalwageredamount) {
                    if ($totalwageredamount->wageredamount < ($user_registrationbonus->amount * 35)) {
                        return [
                            'wagerprogress' => $totalwageredamount->wageredamount,
                            'totalwager' => $user_registrationbonus->amount * 35
                        ];
                    } else {
                        return 0;
                    }
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    // user session for prosix_wallet
    function update_pro_session($userId, $request)
    {

        $data = ProsixWallet::where('user_id', $userId)
            ->latest()
            ->first();
        $request->session()->put('proSix_walletData', $data);
    }

    public function get_lobby_data(Request $request)
    {
        $data = ProsixUserWallet::where('user_id', Auth::user()->id)
            ->latest()
            ->first();

        $mission_data = UserMission::where('user_id', Auth::user()->id)->where('status', '0')->latest()->first();
//        $userMissionsPending = UserMission::where('user_id',Auth::user()->id)->where('status', '0');
//        if (count($userMissionsPending->pluck('mission_id')->toArray()))
//        {
//            $mission = MissionBonus::find($userMissionsPending->latest()->first()->mission_id);
//            $curDate = date('Y-m-d');
//            if ($mission->specific_day != '')
//            {
//                if($mission->specific_day >= $curDate ){
//                    $mission_data = $userMissionsPending->latest()->first();
//                }
//            }
//            elseif ($mission->date_m == 'w')
//            {
//                if($mission->d_m == date('D') ){
//                    $mission_data = $userMissionsPending->latest()->first();
//                }
//            }
//            elseif($mission->date_m == 'm')
//            {
//                if($mission->d_m == date('d') ){
//                    $mission_data = $userMissionsPending->latest()->first();
//                }
//            }
//        }
        return response()->json([
            'wallet_data' => $data,
            'mission_data' => $mission_data
        ], 200);
    }
    public function get_coin_payment(Request $request)
    {
        $result                      = CoinPayment::where('id',$request->id)->first();
        return response()->json($result);
    }
    public function bonus_offers_status($status)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($status == 1) {
            try {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_POSTFIELDS => "{\"list_ids\":[\"f424453a-f9c1-42fc-b3e5-e7a46714cda6\"],\"contacts\":[{\"address_line_1\":\"string (optional)\",\"address_line_2\":\"string (optional)\",\"alternate_emails\":[\"$user->email\"],\"city\":\"string (optional)\",\"country\":\"string (optional)\",\"email\":\"$user->email\",\"first_name\":\" \",\"last_name\":\"string (optional)\",\"postal_code\":\"string (optional)\",\"region\":\"string (optional)\",\"custom_fields\":{}}]}",
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
            } catch (\Exception $e) {
                Toastr::error('Something Went Wrong', 'Error');
                return redirect()->back();
            }
        }
        else {
            try {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts/search",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"query\":\"email LIKE '$user->email%'\"}",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer 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",
                        "content-type: application/json"
                    ),
                ));

                $search = curl_exec($curl);
                $err = curl_error($curl);
                $result = \GuzzleHttp\json_decode($search);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {

                    $contact_id = $result->result[0]->id;
//                $list_id = $result->result[0]->list_ids[0];
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/lists/f424453a-f9c1-42fc-b3e5-e7a46714cda6/contacts?contact_ids=$contact_id",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "Authorization: Bearer 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"
                        ),
                    ));
                    $search_contact = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {

                    }
                }
            } catch (\Exception $e) {
                Toastr::error('Something Went Wrong', 'Error');
                return redirect()->back();
            }
        }
        $user->bonus_offers = $status;
        $user->save();
        return response()->json('success');
    }
    public function unsubscribed_newsletter($token)
    {
        $user                   = User::where('ref_key',$token)->first();
        if ($user!=null && $user->count()>0)
        {
            try {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts/search",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"query\":\"email LIKE '$user->email%'\"}",
                    CURLOPT_HTTPHEADER => array(
                        "authorization: Bearer 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",
                        "content-type: application/json"
                    ),
                ));

                $search = curl_exec($curl);
                $err = curl_error($curl);
                $result = \GuzzleHttp\json_decode($search);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {

                    $contact_id = $result->result[0]->id;
//                $list_id = $result->result[0]->list_ids[0];
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/lists/f424453a-f9c1-42fc-b3e5-e7a46714cda6/contacts?contact_ids=$contact_id",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "Authorization: Bearer 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"
                        ),
                    ));
                    $search_contact = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {

                    }
                }
            } catch (\Exception $e) {
                Toastr::error('Something Went Wrong', 'Error');
                return redirect('/');
            }
            $user->bonus_offers = 0;
            $user->save();
            Toastr::success('You have unsubscribed from the newsletter.','Success');
            return redirect('/');
        }
        else
        {
            Toastr::error('Sorry! Mismatched user token');
            return redirect('/');
        }
    }
    public function exchange_rate(Request $request)
    {
        $input = $request->all();
//        $req_url = 'https://api.exchangerate-api.com/v4/latest/'.$input['currency'];
//        $response_json = file_get_contents($req_url);
//        if(false !== $response_json) {
//            try {
//                // Decoding
//                $response_object = json_decode($response_json);
//                $base_price = 89; // Your price in USD
//                //$EUR_price = round(($base_price * $response_object->rates->USD), 2);
//                $result     = number_format(floor($response_object->rates->USD*100)/100,2);
////                echo $result*$base_price.'<br>';
////                $usd = number_format((float)($base_price * $response_object->rates->USD), 2, '.', '');
////                dd($usd);
//                if ($input['currency']!="USD")
//                {
//                    $date = new DateTime();
//                    $date->modify('-5 minutes');
//                    $formatted_date = $date->format('Y-m-d H:i:s');
//                    $history                     = CurrencyBaseRate::where('user_id',Auth::user()->id)->where('created_at','>=',$formatted_date)->get();
//                    if ($history!=null && $history->count()>0)
//                    {
//                        $new_history                 = CurrencyBaseRate::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
//                    }
//                    else
//                    {
//                        $new_history                  = new CurrencyBaseRate();
//                    }
//                    $new_history->user_id         = Auth::user()->id;
//                    $new_history->currency        = $input['currency'];
//                    $new_history->usd_base_amount = 1;
//                    $new_history->amount_in_usd   = $result;
//                    $new_history->response        = \Opis\Closure\serialize($response_object);
//                    $new_history->status          = 0;
//                    $new_history->save();
//                }
//                return response()->json($result);
//
//            }
//            catch(Exception $e) {
//            }
//        }
        try {
            if ($input['currency'] != "USD") {
                $date = new DateTime();
                $date->modify('-5 minutes');
                $formatted_date = $date->format('Y-m-d H:i:s');
                $history = CurrencyBaseRate::where('user_id', Auth::user()->id)->where('created_at', '>=', $formatted_date)->get();
                if ($history != null && $history->count() > 0)
                {
                    $old_history = CurrencyBaseRate::where('user_id', Auth::user()->id)->where('currency',$input['currency'])->orderBy('id', 'desc')->first();
                    return response()->json($old_history->amount_in_usd);
                }
                else {
                    $endpoint = 'convert';
                    $access_key = '6bb36453b5a137caf172397228f6c772';

                    $from = $input['currency'];
                    $to = 'USD';
                    $amount = 1;
                    $ch = curl_init('http://api.exchangeratesapi.io/v1/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // get the JSON data:
                    $json = curl_exec($ch);
                    curl_close($ch);
                    // Decode JSON response:
                    $conversionResult = json_decode($json, true);
                    // access the conversion result
                    $result = number_format(floor($conversionResult['result'] * 100) / 100, 2);
                    $new_history = new CurrencyBaseRate();
                    $new_history->user_id = Auth::user()->id;
                    $new_history->currency = $input['currency'];
                    $new_history->usd_base_amount = 1;
                    $new_history->amount_in_usd = $result;
                    $new_history->response = \Opis\Closure\serialize($conversionResult);
                    $new_history->status = 0;
                    $new_history->save();
                    $result     = number_format(floor($conversionResult['result']*100)/100,2);
                    return response()->json($result);
                }
            }
            else
            {
                return response()->json(1);
            }

        } catch (\Exception $e)
        {

        }
    }
}
