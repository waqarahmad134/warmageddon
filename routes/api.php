<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\TokenCurrency;
use App\Deposit;
use App\LeaveNote;
use App\ProsixUserWallet;
use App\ProsixTransaction;
use App\TransactionType;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/user', function (Request $request) {
////    return $request->user();
// dd(\Illuminate\Support\Facades\Auth::user());
//});

Route::get('/waqar2', function () {
    return response()->json([
        'message' => 'hi waqar'
    ]);
});

function apiResponse($status, $message, $data = null, $error = null, $code = 200) {
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'error' => $error
    ], $code);
}


Route::get('/allgames', function () {
    try {
        $games = DB::table('add_games')->get();
        return apiResponse(true, 'Games fetched successfully', $games);
    } catch (\Exception $e) {
        return apiResponse(false, 'Failed to fetch games', null, $e->getMessage(), 500);
    }
});

Route::get('/allusers', function () {
    try {
        $perPage = request()->get('per_page', 20);
        $users = DB::table('users')->paginate($perPage);

        return apiResponse(true, 'Users fetched successfully', $users);
    } catch (\Exception $e) {
        return apiResponse(false, 'Failed to fetch users', null, $e->getMessage(), 500);
    }
});

Route::post('/newlogin', function (Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return apiResponse(false, 'Validation failed', null, $validator->errors(), 422);
        }

        // Find user (by email OR username)
        $user = User::where('email', $request->email)
                    ->orWhere('user_name', $request->email)
                    ->first();

        if (!$user) {
            return apiResponse(false, 'Invalid credentials', null, null, 401);
        }

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return apiResponse(false, 'Invalid credentials', null, null, 401);
        }

        // Create token (using Laravel Sanctum or Passport)
        $token = $user->createToken('api_token')->plainTextToken;

        return apiResponse(true, 'Login successful', [
            'user' => $user,
            'token' => $token,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
            'error'   => $e->getMessage(),
            'trace'   => $e->getTraceAsString(), // 👈 shows exact line
        ], 500);
    }
    
});



Route::post('/add-user-token/{id}', function (Request $request, $id) {
    try {
        $request->validate([
            'add_token' => 'required|numeric|min:1',
        ]);

        $tok = TokenCurrency::where(['status' => 1, 'doller' => 1])->first();
        if (!$tok) {
            return apiResponse(false, 'Token currency not found', null, null, 404);
        }

        $user = User::find($id);
        if (!$user) {
            return apiResponse(false, 'User not found', null, null, 404);
        }

        // Create or update wallet
        $userWallet = ProsixUserWallet::updateOrCreate(
            ['user_id' => $id],
            ['usd' => 0, 'token' => 0]
        );

        // Deposit record
        $deposit = new Deposit();
        $deposit->user_id = $id;
        $deposit->type = 'admin';
        $deposit->charge_id = 'ch_' . Str::random(20);
        $deposit->amount = round($request->add_token / $tok->pley6_token);
        $deposit->from = 'Casino';
        $deposit->to = $user->user_name;
        $deposit->save();

        // Update wallet
        $userWallet->usd += $request->add_token / $tok->pley6_token;
        $userWallet->token += $request->add_token;
        $userWallet->save();

        // Transaction type
        $tran_Type = new TransactionType();
        $tran_Type->type = 'add_token';
        $tran_Type->created_by = null;
        $tran_Type->save();

        // Transaction
        $transaction = new ProsixTransaction();
        $transaction->user_id = $id;
        $transaction->amount = $request->add_token;
        $transaction->currency = 'pley6_token';
        $transaction->from = 'casino';
        $transaction->type = $tran_Type->id;
        $transaction->to = $user->user_name;
        $transaction->created_by = null;
        $transaction->save();

        // Leave note
        $note = new LeaveNote();
        $note->user_id = $id;
        $note->body = 'You received bonus of ' . $request->add_token . ' tokens from Casino';
        $note->status = 0;
        $note->save();

        return apiResponse(true, 'Tokens added successfully', [
            'wallet' => [
                'usd' => $userWallet->usd,
                'token' => $userWallet->token,
            ],
            'deposit' => $deposit,
            'transaction' => $transaction,
        ]);
    } catch (\Exception $e) {
        return apiResponse(false, 'Failed to add tokens', null, $e->getMessage(), 500);
    }
});


Route::group(['middleware' => ['guest:api'],'namespace' => 'api'], function () {

});

Route::group(['namespace' => 'api'],function() {
    Route::post('test-callback','PaymentCallbackController@test');
    Route::post('68929719a56e76e447393a03dd1fc8ef/ethereum-callback','PaymentCallbackController@ethereum_callback');
    Route::post('68929719a56e76e447393a03dd1fc8ef/btc-callback','PaymentCallbackController@btc_callback');
    Route::post('68929719a56e76e447393a03dd1fc8ef/usdt-callback','PaymentCallbackController@usdt_callback');
    Route::post('65829719a56e57e447393a03hh1fcfe8/lby-callback','PaymentCallbackController@lby_callback');
    Route::post('48329719a56e67e447393a03oo1fc98c/psix-callback','PaymentCallbackController@psix_callback');
    Route::post('axcess-callback','PaymentCallbackController@axcess_callback');
    Route::post('axcess-payment/{id}','PaymentCallbackController@axcess_payment');
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('logout', 'UserController@logout');
    // for testing guard
        Route::get('user1', 'UserController@get_auth');
    // Route::options('user', 'UserController@customerProfile');
    Route::post('user/token', 'UserController@tokenUpdate');

    //user profit and loss
    Route::post('user/token/profit', 'UserController@tokenProfit');
    Route::post('user/token/loss', 'UserController@tokenLoss');
    // spin api
    Route::post('user/AwardedSpinsLeft', 'UserController@spinUpdate');
    // user banned api
    Route::post('user/game-earning', 'UserController@Gameinfo');

    Route::post('user/update_game_session', 'UserController@updateChildSession');
    Route::post('user/Bonus_Winnings', 'UserController@Bonus_Winnings');


    Route::post('user/ban_user_game', 'UserController@BanUserGame');

    // external games
    Route::match(array('GET', 'POST'),'session-closed','GameCallbackController@session_closed');

});
