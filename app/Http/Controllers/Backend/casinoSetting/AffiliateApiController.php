<?php

namespace App\Http\Controllers\backend\casinoSetting;

use App\AffiliateApiSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AffiliateApiController extends Controller
{
    public function index()
    {
        $settings                      = AffiliateApiSetting::where('id',1)->first();
         return view('backend.casino-setting.affiliate-api.index',compact('settings'));
    }
    public function update(Request $request)
    {
        $affliate_settings                                = AffiliateApiSetting::where('id',1)->first();
        if ($affliate_settings==null || $affliate_settings->count()==0)
        {
            $affliate_settings                            = new AffiliateApiSetting();
        }
        $affliate_settings->partner_list                  = Input::has('partner_list')?1:0;
        $affliate_settings->player_disable_mark           = Input::has('player_disable_mark')?1:0;
        $affliate_settings->player_disable_unmark         = Input::has('player_disable_unmark')?1:0;
        $affliate_settings->player_duplicate_mark         = Input::has('player_duplicate_mark')?1:0;
        $affliate_settings->player_duplicate_unmark       = Input::has('player_duplicate_unmark')?1:0;
        $affliate_settings->player_import                 = Input::has('player_import')?1:0;
        $affliate_settings->player_self_excluded_mark     = Input::has('player_self_excluded_mark')?1:0;
        $affliate_settings->player_self_excluded_unmark   = Input::has('player_self_excluded_unmark')?1:0;
        $affliate_settings->sync_players                  = Input::has('sync_players')?1:0;
        $affliate_settings->import_player_activities      = Input::has('import_player_activities')?1:0;
        $affliate_settings->import_invalid_player_activities = Input::has('import_invalid_player_activities')?1:0;
        $affliate_settings->import_invalid_synced_visits  = Input::has('import_invalid_synced_visits')?1:0;
        $affliate_settings->count_visit_sync              = Input::has('count_visit_sync')?1:0;
        $affliate_settings->save();
        Toastr::success('Affiliate referral settings has been updated successfully');
        return redirect()->back();
    }
}
