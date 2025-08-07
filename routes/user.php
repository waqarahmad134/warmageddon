<?php
/* 
Auth::routes(['verify' => true]); */


Route::group(['prefix' => 'user','namespace' => 'Auth'],function(){
    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.request');
    
    // registation mail check
    route::get('mail-check/{email}','LoginController@Mail_Check');
    route::get('username-check/{email}','LoginController@username_Check');
    //end registation mail check
});

//email verify
Route::get('user-email-verify', 'Frontend\HomeController@emailVerify')->name('user.emailVerify'); 
//Prevent user for game
Route::get('user-prevent','Frontend\UserController@UserPrevent');
// end verify
Route::get('login/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');

route::get('registration','Auth\LoginController@Password_create');
route::post('registration','Auth\LoginController@Password_store')->name('password.store');

// balance 
Route::group(['namespace' => 'Frontend','prefix' => 'user'/* ,'middleware' => ['User'] */],function(){
    Route::get('account-balance/','UserController@balnceUpdate');
});

// api 

Route::group(['prefix'=>'api','namespace' => 'api'],function(){  
    //user token 
    Route::get('user/all-token', 'UserController@allToken');
    //user buy token
    Route::get('user/buy-token', 'UserController@BuyToken');
    // system profit or loss api 
    Route::get('system-token', 'UserController@SystemToken');
    // game play status
   // Route::get('PlayMode', 'UserController@GamePlayStatus');
    // game id
    Route::get('user/game', 'UserController@GameId');

    

});
