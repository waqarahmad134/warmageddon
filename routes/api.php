<?php

use Illuminate\Http\Request;

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
