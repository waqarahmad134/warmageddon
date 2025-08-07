<?php

namespace App\Console\Commands;

use App\AffiliateApiHistory;
use App\AffiliateApiSetting;
use App\Http\Controllers\backend\affiliate\AffiliateAppController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
class Affilka extends Command
{
    protected $signature = 'affilka:cron';

    protected $description = 'Command description';
    // affiliate app settings
    private $settings;
    public function __construct()
    {
        parent::__construct();
        $this->settings         = AffiliateApiSetting::where('id',1)->first();
    }

    public function handle(Request $request)
    {
        \Log::info("Affilka command run ");
        if ($this->settings->player_import==1)
        {
            $affiliate_history = AffiliateApiHistory::where('status',0)->get();
            if ($affiliate_history!=null && $affiliate_history->count()>0)
            {
                foreach ($affiliate_history as $item)
                {
                    app(AffiliateAppController::class)->make_player($item,"cron",$request);
                }
            }
        }
        if ($this->settings->import_player_activities==1)
        {
            app(AffiliateAppController::class)->import_player_activities($request);
        }
       $this->info('affilka:cron Command Run successfully!');
        return "Affilka command run";
    }
}
