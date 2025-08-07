<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class ProAffiliateTrnsaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pro:affiliate_transaction';

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
        $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
        $transactionsquery = "SELECT
            pro_affiliate_transaction.user_id,
            SUM(pro_affiliate_transaction.token_lost) AS token_lost,
            users.pro_child
        FROM
            pro_affiliate_transaction
            INNER JOIN
            users
            ON
                pro_affiliate_transaction.user_id = users.id
        WHERE
            payout = 0 AND users.pro_child != 'Null' AND users.pro_child != ''
        GROUP BY
	user_id";
        $result = DB::select(DB::raw($transactionsquery));
        if ($result) {
            foreach ($result as $r) {
                $userreferrer = DB::table('users')
                    ->select('users.pro_parent', 'users.id', 'users.pro_payout_percentage')
                    ->where('users.pro_parent', $r->pro_child)
                    ->first();
                if ($userreferrer && $userreferrer->pro_payout_percentage != null) {
                    $token_lost = ($userreferrer->pro_payout_percentage / 100) * $r->token_lost;
                    $refererWallet = \App\ProsixUserWallet::where('user_id', $userreferrer->id)->first();
                    $refererWallet->token = $refererWallet->token + $token_lost;
                    $usd = $token_lost * (1 / $tok->pley6_token);
                    $refererWallet->usd = $refererWallet->usd + $usd;
                    $refererWallet->save();
                    $changestatus = \DB::table('pro_affiliate_transaction')->where('payout', 0)->where('user_id', $r->user_id)->update(['payout' => 1]);
                }
            }
        }
        \Log::info("command run ");
        $this->info('Demo:Cron Command Run successfully!');
    }
}
