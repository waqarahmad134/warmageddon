<?php

namespace App\Http\Controllers\Backend\finances;

use App\CoinGate;
use App\CoinPayment;
use App\Deposit;
use App\Transaction;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class DepositsController extends Controller
{
    public function index(Request $request)
    {

// Your Eloquent query executed by using get()

         // Show results of log
            $deposits = DB::table('deposits')
                ->leftJoin('coin_payment', 'coin_payment.orderID', '=', 'deposits.charge_id')
                ->leftJoin('axcess_payment', 'axcess_payment.orderID', '=', 'deposits.charge_id')
                ->leftJoin('users', 'users.id', '=', 'deposits.user_id')
                ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'deposits.user_id')
                ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
                ->select('deposits.id as depositsid','deposits.created_at as deposit_created','users.*','deposits.*','user_profiles.*','coin_payment.*','axcess_payment.currency as axcess_currency')
                ->orderBy('deposit_created','desc')
                ->get();
        $pending_deposits                      = CoinPayment::where('status',0)->with('getuser','userProfile')->orderBy('created_at','desc')->get();
   // ->select('product.id','category.name')->get();
       // print_r($deposits);echo '<br/>';die();
        return view('backend.finances.deposits.index', compact('deposits','pending_deposits'));
    }


    public function show($id)
    {
        //$deposit = DepositEvent::findOrFail($id);
        $deposit = Deposit::where('deposits.id',$id)
            ->leftJoin('coin_payment', 'coin_payment.orderID', '=', 'deposits.charge_id')
            ->leftJoin('axcess_payment', 'axcess_payment.orderID', '=', 'deposits.charge_id')
            ->leftJoin('users', 'users.id', '=', 'deposits.user_id')
        ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'deposits.user_id')
         ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
         ->select('deposits.*','deposits.created_at as depositCreatedAt', 'countries.name as countryname', 'users.*','user_profiles.state','user_profiles.zipcode','coin_payment.orderID as CoinOrderID','coin_payment.walletAddress as CoinWalletAddress','axcess_payment.currency as axcess_currency')->first();
        return view('backend.finances.deposits.show', compact('deposit'));
    }
    // showing pending deposit details
    public function pending_show($id)
    {
        $deposit                  = CoinPayment::where('id',$id)->with('getuser','userProfile')->first();
        return view('backend.finances.deposits.show_pending', compact('deposit'));

    }


}
