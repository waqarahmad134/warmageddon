<?php

namespace App\Console\Commands;

use App\AffiliateBonus;
use App\Deposit;
use App\GeneralSetting;
use App\ListAffiliate;
use App\ProsixUserWallet;
use App\TokenCurrency;
use Illuminate\Console\Command;

class DepositAffiliate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit:affiliate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deposits                          = Deposit::whereBetween('created_at', [now()->subDay(1), now()])->get();
        $aff_commission                    = GeneralSetting::orderBy('id','desc')->first()->affiliate_commission;
        $token_rate                        = TokenCurrency::where(['status'=>1,'doller'=>1])->get();
        foreach ($deposits as $deposit)
        {

            $referrals                      = ListAffiliate::where('user_id',$deposit->user_id)->first();
            if ($referrals!=null)
            {

                $check             = AffiliateBonus::where('deposit_id',$deposit->id)->get();
                if ($check==null)
                {
                    $bonus               = new AffiliateBonus();
                    $bonus->deposit_id = $deposit->id;
                    $bonus->user_id = $referrals->user_id;
                    $bonus->aff_id = $referrals->aff_id;
                    $bonus->amount = ($aff_commission / 100.00) * $deposit->amount;
                    $bonus->tokens = $token_rate->pley6_token * (($aff_commission / 100.00) * $deposit->amount);
                    $bonus->status = 1;
                    $bonus->save();

                    // updating prosix_user_wallet table lobby main table for user wallet
                    $userWallet=ProsixUserWallet::updateOrCreate(['user_id'=>$bonus->aff_id]);
                    $userWallet->free_token += $bonus->tokens;
                    $userWallet->save();

                    // notification generation for referrer
                    $notification=new \App\Notification;
                    $notification->user_id = $bonus->aff_id;
                    $notification->message='You got '.$bonus->tokens.' free tokens from your referral deposit';
                    $notification->save();

                }

            }
        }
        \Log::info("Deposit command run ");
        $this->info('Deposit Affiliate Command Run successfully!');
    }
}
