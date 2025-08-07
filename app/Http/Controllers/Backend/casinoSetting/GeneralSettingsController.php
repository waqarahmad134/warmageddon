<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\GeneralSetting;

use App\TransactionSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class GeneralSettingsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = DB::table('general_settings')->find(1);
                return view('backend.casino-setting.general-settings.index',compact('data'));
            } catch (\Exception $e) {
                Toastr::error('Something went wrong please try again!');
                return redirect()->back();
            }
    }

    public function store(Request $request)
    {

        try {
            $data = GeneralSetting::findOrFail(1);
            $data->currency = $request->currency;
            $data->min_deposit = $request->min_deposit;
            $data->min_withdraw = $request->min_withdraw;
            $data->affiliate_commission = $request->affiliate_commission;
            $data->inactive_days = $request->inactive_days;
            $data->real_game = $request->real_game;
            $data->fun_game = $request->fun_game;
            $data->stripe_key = $request->stripe_key;
            $data->coingate_token = $request->coingate_token;
            $data->kyc_action     = $request->kyc_action;
            $data->kyc_api        = $request->kyc_api;
            $data->email_verification = Input::has('email_verification')?1:0;
            $data->save();
            Toastr::success('Operation successful!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    public function store_Transaction_settings(Request $request)
    {
        try {
            $data = TransactionSetting::findOrFail(1);
            $data->transfer = $request->transfer;
            $data->deposit = $request->deposit;
            $data->withdraw = $request->withdraw;
            $data->save();
            Toastr::success('Operation successful!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
     public function notify_Transaction_settings(){
        try {
            $data = DB::table('transaction_settings')->find(1);
            return view('backend.casino-setting.general-settings.notify_Transaction_settings','data');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
     }

}
