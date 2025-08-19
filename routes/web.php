<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
USE Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

//testing routes
Route::get('/testold/{id}/{amount}/{dollar}','Controller@testold');
Route::get('test2','Controller@test2');
Route::get('/test1/{orderID}','Controller@test1');
//language controller
Route::get('language/{lang}','Frontend\LanguageController@language')->middleware('language');
// social login
Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
// instagram
Route::get('login-instagram','Auth\LoginController@redirectToInstagramProvider')->name('instagram.login');
Route::get('instagram-callback', 'Auth\LoginController@instagramProviderCallback')->name('instagram.login.callback');
//frontend (website)
Route::get('error/{no}','Controller@error');
// external games (softswiss)
Route::get('game/play-demo/{id}','Frontend\GamesController@demo');


Route::get('/terms-and-service', 'Frontend\HomeController@terms_of_service')->name('terms_of_service');
Route::get('/Responsible-Gambling', 'Frontend\HomeController@responsible_gambling')->name('responsible-gambling');
Route::get('/privacy-policy', 'Frontend\HomeController@privacy_policy')->name('privacy_policy');
Route::get('/support', 'Frontend\HomeController@support')->name('support');
Route::get('/payout', 'Frontend\HomeController@payout')->name('payout');
Route::get('/play-rules', 'Frontend\HomeController@playrules')->name('playrules');
Route::get('/antimoney-laundering', 'Frontend\HomeController@antimoney')->name('antimoney');
Route::get('/faq', 'Frontend\HomeController@help')->name('help-support');
Route::get('/affiliate', 'Frontend\HomeController@affiliate')->name('affiliate');
Route::get('/affiliate-signup', 'Frontend\HomeController@affiliate_signup')->name('affiliate_signup');
Route::get('/affcode-check', 'Backend\\affiliate\\AffiliateController@affcode_check')->name('affcode-check');
Route::post('affiliateLogin', 'Backend\\affiliate\\AffiliateController@store_affiliate')->name('affiliateLogin');
Route::get('/cookies', 'Frontend\HomeController@cookies')->name('cookies');
Route::get('/spinwheel', 'Frontend\HomeController@spinwheel')->name('spinwheel');
Route::get('/licence', 'Frontend\HomeController@licence')->name('licence');
Route::get('/commercial-registration', 'Frontend\HomeController@commercial_registration')->name('commercial-registration');
Route::get('checkUserName1','Frontend\UserController@checkUserName')->name('checkUserName1');
// unsubscribe from newsletter
Route::get('unsubscribed-newsletter/{token}','Frontend\UserController@unsubscribed_newsletter');
//routes for wasm game file loading
Route::get('demo-play/Build/{name}','Frontend\HomeController@getwasmfile')->name('getgamefile');
Route::get('play/Build/{name}','Frontend\HomeController@getwasmfile')->name('getgamefile');

//coin cal back urls (coingate & ethereum)
Route::post('coin_callback','Controller@coin_callback');
Route::post('payment_callback','Controller@payment_callback');
Route::get('recordSaving/{id}','Controller@recordSaving');

Route::group([ 'middleware' => ['cr'] ],function(){
    Route::get('/clear-cache', 'HomeController@cache_clear');
    // page
    Route::get('/', 'Frontend\HomeController@index')->name('index');
    // Route::get('/', 'Frontend\HomeController@comingSoon')->name('index');
    // testing games
    Route::get('/softwiss-games', 'Frontend\HomeController@index1');
    Route::get('website/{affiliate_id}/{type}/{source}', 'Frontend\HomeController@visit');
    Route::get('affliate-registration/{id}', 'Frontend\HomeController@affliate')->name('affliate_registration');
    Route::post('contact/send', 'Frontend\ContactController@send')->name('contact.send');
    Route::get('/about-us', 'Frontend\HomeController@about')->name('about');
    Route::get('/contact-us', 'Frontend\HomeController@contact')->name('front.contact');
    Route::post('/contact-us', 'Frontend\HomeController@save_contact');
    Route::post('/support', 'Frontend\HomeController@save_support');
    Route::get('/game', 'Frontend\HomeController@allgame')->name('allgame');
    Route::get('/games', 'Frontend\HomeController@games')->name('games');
    Route::get('/games_winner', 'Controller@games_winner')->name('games_winner');
    Route::post('get-city', 'Frontend\HomeController@get_city')->name('get_cit');
    Route::get('user-login', 'Frontend\HomeController@login')->name('user.login');
    Route::get('user-registration', 'Frontend\HomeController@Registration')->name('user.registration');
    // sigup by reference
    Route::get('signup/{ref_key}','Frontend\HomeController@signup_ref')->name('signup_ref');
    Route::get('referral-registration','Frontend\HomeController@referral_registration');
    Route::get('/user/verify/{token}', 'Frontend\HomeController@verifyUser');
//    Route::get('emailVerify/{id}', 'Frontend\HomeController@emailVerify');
    Route::post('resend-verify-email', 'Frontend\HomeController@resend_email');
    Route::match(array('GET', 'POST'),'subscribe', 'Frontend\HomeController@subscribe')->name('subscribe');
    Route::middleware('cors')->group(function(){
        Route::post('play','Frontend\GamesController@play');
        Route::post('rollback','Frontend\GamesController@rollback');
    });
    Route::get('state/{name}','CountryController@state');

        // user
    Route::get('login','Auth\LoginController@showLogin')->name('login');
     Route::post('login','Auth\LoginController@login')->name('user_login');
     Route::match(array('GET', 'POST'),'register','Auth\RegisterController@register')->name('register');
    Route::post('logout','Auth\LoginController@logout')->name('logout');
    Route::get('play/{id}', 'Backend\\GamesManagement\\AddGamesController@play_game')->name('play_game');
    Route::get('demo-play/{id}', 'Backend\\GamesManagement\\AddGamesController@demo_play_game')->name('demo_play_game');
    Route::resource('dash-panel/user-profile', 'Registration\AddUserController\\UserProfileController')->middleware('userAdmin');
    Route::get('user-logout', 'Registration\AddUserController\\UserProfileController@user_logout')->name('user_logout')->middleware('auth');
    Route::post('game-title', 'Registration\AddUserController\\UserProfileController@game_title')->name('game_title')->middleware('auth');
});



//phone verification
Route::group(['namespace' => 'Frontend','middleware' => ['User' ,'cr']],function(){
    Route::get('game/play/{gameId}','GamesController@startSession');
    Route::get('user/verification','VerificationController@Resend');
    Route::get('verification','VerificationController@mobile_verification')->name('verify-mobile');
    Route::post('sms-verifiction','VerificationController@verification')->name('user.mobile_vefication');
    Route::get('code-verifiction','VerificationController@SendCodeForm')->name('user.sms_send_verification');
    Route::post('code-verifiction','VerificationController@storeCodeForm')->name('user.code_verification');
    Route::get('email-verification','VerificationController@send_email_verification')->name('user.email_verification');
});

Route::group(['namespace' => 'Frontend','middleware' => ['auth' , 'cr']],function(){
    //update lobby api
    Route::post('user/get_lobby_data','UserController@get_lobby_data');
    //get deposit details
    Route::post('user/get_coin_payment','UserController@get_coin_payment');
    // Cancel Withdraw
    Route::post('user/cancel_withdraw/{id}','UserController@cancel_withdraw')->name('user.cancel_withdraw');
   //currency convert
   Route::get('user/currency-convert/{amount}','UserController@currency_convert');
   //currency convert
    Route::post('user/profile/edit/{id}','UserController@update')->name('user.update');
    Route::post('user/avatar/edit/{id}','UserController@update_avatar')->name('user.update_avatar');
    Route::post('user/security/edit/{id}','UserController@Security')->name('user.Security');
    Route::post('user/password/edit/{id}','UserController@PasswordChange')->name('user.PasswordChange');
    Route::post('user/profile-picture/update','UserController@Proupdate')->name('user.Proupdate');
    Route::post('user/account-deactivate','UserController@account_deactivate')->name('user.account_deactivate');
    Route::post('user/support','UserController@support')->name('user.support');
    Route::post('user/notification-view/{id}','UserController@notification_id')->name('user.notification_id');

    Route::post('user/paymnet','PaymentController@paymentDeposit')->name('paymentDeposit');
    Route::post('user/payment-setting','PaymentController@payment_settings')->name('paymentSettings');
    Route::get('secret/{amount}','PaymentController@key');
    Route::post('user/paymnet_coin','PaymentController@paymentDeposit_coingate')->name('paymentDeposit-Coingate');
    Route::post('user/paymnet_ethereum','PaymentController@paymentDeposit_ethereum')->name('paymentDeposit-ethereum');
    Route::post('user/payment_axcess','PaymentController@paymentDeposit_axcess')->name('paymentDeposit-axcess');
    //withdraw
    Route::post('user/withdraw','PaymentController@paymentWithdraw')->name('paymentWithdraw');
    Route::get('user/regbonus_status','PaymentController@checkifusergotregbonus')->name('checkifusergotregbonus');
    // favorite game
    Route::get('user/favorite-game/{id}','UserController@favorite_game')->name('user.favorite_game');
    Route::get('user/favorite-game-data/','UserController@Get_favorite_game');
    //bonus apply
    Route::get('user/apply-bonus/{bonus_code}','UserController@Apply_Bonus');
    // inbox delete
    Route::get('user/inbox-delete/{ids}/{val}','UserController@InboxDelete');
    Route::get('user/inbox-see/{val}','UserController@InboxSee');
    Route::get('user/buy-token/{val}','UserController@BuyToken');
    Route::get('user/mission-start','UserController@MissionStart');
    Route::get('user/vip-shop-start','UserController@ShopStart');

});
Route::get('api/PlayMode', 'Backend\\GamesManagement\\AddGamesController@test');

// Api Routes
Route::group(['prefix'=>'api','namespace' => 'api', /*'middleware' => ['auth']*/ ],function(){
   Route::get('user', 'UserController@customerProfile');
    Route::options('user', 'UserController@customerProfile');
    Route::post('user/backend_status_update', 'UserController@backend_status_update');
    Route::get('user/backend_status', 'UserController@backend_status');
    // haroon casino's api's links
    Route::get('get_data','UserController@get_casino_data');
    Route::get('filter_data','UserController@filter_casino_data');

});
// Casino Users (Frontend)
Route::group(['namespace' => 'Frontend','prefix' => 'user','middleware' => ['User' ,'cr']],function(){
    // play game

    Route::get('deposit','UserController@dashboard')->name('user.panel1');
    Route::get('dashboard','UserController@dashboard')->name('user.panel');
    Route::post('exchange-rate','UserController@exchange_rate')->name('user.ExchangeRate');
    Route::get('profile-show','UserController@user_profile')->name('user.user_profile');
    Route::get('affiliate-list','UserController@aff_list')->name('user.aff_list');
    Route::get('affiliate-nickname','UserController@aff_nickname')->name('user.aff_nickname');
    Route::get('affiliate-invite','UserController@aff_invite')->name('user.aff_invite');
    Route::get('transac-history','UserController@transac_his')->name('user.transac_his');
    Route::get('withdraw','UserController@withdraw')->name('user.withdraw');
    Route::get('deposite','UserController@deposite')->name('user.deposite');
    Route::get('deposite-limit','UserController@deposite_limit')->name('user.deposite_limit');
    Route::get('account-statement','UserController@acc_statement')->name('user.acc_statement');
    Route::get('payment-method','UserController@payment')->name('user.payment');
    Route::get('bouns','UserController@bouns')->name('user.bounscode');
    Route::get('gameplay-history','UserController@gameplay_his')->name('user.gameplay_his');
    Route::get('account-data','UserController@acc_data')->name('user.acc_data');
    Route::get('account-bank','UserController@acc_bank')->name('user.acc_bank');
    Route::get('referrals','UserController@referrals')->name('referrals');
    Route::post('account-document','UserController@acc_document')->name('user.acc_document');
    Route::post('convert_loyalty','UserController@convert_loyalty')->name('user.convert_loyalty');
    // tickets
    Route::post('send-ticket','TicketController@send_ticket')->name('User.SendTicket');
    Route::get('view-ticket/{id}','TicketController@show')->name('User.ViewTicket');
    Route::post('update-ticket','TicketController@update')->name('User.UpdateTicket');
    // bonus offers
    Route::get('bonus-offers-status/{status}','UserController@bonus_offers_status');
});
//Affiliate Admins
Route::get('affiliate/login', 'Backend\\affiliate\\AffiliateController@showLoginForm')->name('affiliate.login');
Route::group(['namespace' => 'Backend','middleware' => ['permission:Affiliate'],'prefix' => 'affiliate'], function () {
    Route::get('/dashboard', 'affiliate\\AffiliateController@index')->name('Affiliate.index');
    Route::get('/users', 'affiliate\\AffiliateController@affiliate_users')->name('AffiliateLists');
    Route::get('/withdraws', 'affiliate\\AffiliateController@withdraws')->name('AffiliateWithdraws');
    Route::post('/AffiliateWithdraws', 'affiliate\\AffiliateController@withdraw')->name('AffiliateWithdraw');
    Route::post('/cancel_withdraw/{id}','affiliate\\AffiliateController@cancel_withdraw')->name('affiliate.cancel_withdraw');
    Route::get('/show-media','affiliate\\AffiliateController@show_media')->name('affiliate.show-media');
});
// Admin Panel (Login,Roles & Permissions)
Route::group(['prefix'=>'admin','namespace'=>'Admin\auth'], function (){
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    });
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

});
// Admin Dash Panels
Route::group(['namespace' => 'Backend','prefix' => 'dash-panel','middleware' => ['auth','userAdmin']],function(){

    Route::get('/', 'HomeController@index')->name('dashboard');
    // cms
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('site-setting', 'cms\\CmsController@site_setting')->name('siteSetting');
        Route::get('remove_img/{name}', 'cms\\CmsController@remove_img')->name('removeImg');
        Route::post('site-setting', 'cms\\CmsController@save_site_setting')->name('site.settings');
    });
    // affiliates
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('affiliate-requests', 'affiliate\\AffiliateController@affiliate_requests')->name('AffiliateRequests');
        Route::get('show_affiliate/{id}', 'affiliate\\AffiliateController@show_affiliate')->name('affiliate.show_request');
        Route::post('approve_affiliate', 'affiliate\\AffiliateController@approve_affiliate')->name('approve_affiliate');
        Route::post('reject_affiliate', 'affiliate\\AffiliateController@reject_affiliate')->name('reject_affiliate');

    });
    // tickets
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('tickets', 'Tickets\\TicketController@index')->name('Admin.Tickets');
        Route::get('show-ticket/{id}', 'Tickets\\TicketController@show')->name('Admin.ShowTicket');
        Route::get('fetch-contents/{id}', 'Tickets\\TicketController@fetch_contents')->name('Admin.FetchContents');
        Route::post('sendTicket', 'Tickets\\TicketController@send_message')->name('Admin.SendMessage');
        Route::post('update-status','Tickets\\TicketController@update_status')->name('Admin.UpdateStatus');
      });
    // help & support (FAQ)
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('faq-categories', 'Help\\HelpController@category')->name('Admin.FaqCategories');
        Route::post('add-faq-category', 'Help\\HelpController@save_category')->name('Admin.AddFaqCateg');
        Route::get('edit-faq-category/{id}', 'Help\\HelpController@edit_category')->name('Admin.EditFaqCateg');
        Route::post('update-faq-category', 'Help\\HelpController@update_category')->name('Admin.UpdateFaqCateg');
        Route::get('faq-list', 'Help\\HelpController@index')->name('Admin.FAQS');
        Route::get('add-faq', 'Help\\HelpController@add')->name('Admin.AddHelp');
        Route::post('save-faq', 'Help\\HelpController@save')->name('Admin.SaveHelp');
        Route::get('edit-faq/{id}', 'Help\\HelpController@edit')->name('Admin.editHelp');
        Route::post('update-faq', 'Help\\HelpController@update')->name('Admin.UpdateHelp');
        Route::get('delete-faq-media/{id}', 'Help\\HelpController@delete_media')->name('Admin.deletefaqMedia');
    });
    // customer info
    Route::group(['middleware' => ['permission:Admin panel|Customer Information']], function () {
        Route::get('online-customer', 'customer\\CustomerController@OnlinecustomerInfo')->name('OnlinecustomerInfo');
        Route::get('online-customer-view/{id}', 'customer\\CustomerController@Online_customer_view')->name('user.online_customer_view');
        Route::get('logout-customer-view/{id}', 'customer\\CustomerController@Online_customer_logout')->name('user.Online_customer_logout');
        Route::get('customer-user', 'customer\\CustomerController@customerInfo')->name('customer_info');
        Route::get('customer-view/{id}', 'customer\\CustomerController@customerView')->name('user.customer_view');
        Route::get('customer', 'customer\\CustomerController@customer')->name('user.customer_search');
        Route::post('customer-search', 'customer\\CustomerController@customerSearch')->name('admin.customerSearch');
        Route::get('user-message/{id}','customer\\CustomerController@UsaerLeaveMessageindex')->name('commentsection');
        Route::post('user-leave-message/{id}','customer\\CustomerController@UsaerLeaveMessage')->name('UsaerLeaveMessage');
    });
    // Bonus & Codes
    Route::group(['middleware' => ['permission:Admin panel|Bonus And Code']], function () {
        Route::get('bonuses-list', 'bonus\\BonusController@index')->name('list-bonuses');
        Route::get('add-bonus', 'bonus\\BonusController@create')->name('add-bonus');
        // bonus types
        Route::post('bonus/type', 'bonus\\BonusController@BonusTypeCheck')->name('admin.BonusTypeCheck');
        Route::post('registration-bonus/', 'bonus\\BonusController@Registration_Bonus')->name('Registration_Bonus');
        Route::post('login-bonus/', 'bonus\\BonusController@login_Bonus')->name('admin.login_Bonus');
        Route::post('deposit-bonus/', 'bonus\\BonusController@deposit_Bonus')->name('admin.deposit_Bonus');
        Route::post('code-bonus/', 'bonus\\BonusController@code_Bonus')->name('admin.code_Bonus');
        Route::post('method-bonus/', 'bonus\\BonusController@method_Bonus')->name('admin.method_Bonus');
        Route::post('cashback-bonus/', 'bonus\\BonusController@cashback_Bonus')->name('admin.cashback_Bonus');

        Route::post('add_user_token/{id}','bonus\\BonusController@add_user_token')->name('add_user_token');

        Route::get('bonuses-destroy/{id}', 'bonus\\BonusController@destroy')->name('bonuses.destroy');
        Route::post('status-bonuses/{id}', 'bonus\\BonusController@status_change')->name('bonus.status_change');
        Route::post('user-bonus/{id}', 'bonus\\BonusController@UsaerBonus')->name('UsaerBonus');
        // propersix bonuses
        Route::get('bonus_list', 'bonus\\BonusController@propersix_bonus')->name('BonusList');
        // end bonus

        Route::resource('add-free-chips', 'bonus\\AddFreeChipsController');
        Route::resource('add-rewards', 'bonus\\AddRewardsController');
        Route::resource('list-rewards', 'bonus\\ListRewardsController');
        // start login registration bonus
        Route::get('user-bonus','bonus\\AddBonusesController@RegistrationBonus')->name('RegistrationBonus');
        Route::post('user-bonus-store','bonus\\AddBonusesController@RegistrationBonusStore')->name('RegistrationBonusStore');
        Route::get('user-bonus-edit/{id}','bonus\\AddBonusesController@RegistrationBonusEdit')->name('RegistrationBonusEdit');
        Route::post('user-bonus-update/{id}','bonus\\AddBonusesController@RegistrationBonusUpdate')->name('RegistrationBonusUpdate');
        Route::get('user-bonus-status/{id}','bonus\\AddBonusesController@RegistrationBonusStatus')->name('RegistrationBonusStatus');
        //end login registration bonus
    });
    // VIP  Loyalty & Shops
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('loyality/general-setting', 'VipLoyalty\\VipLoyaltyController@general_setting')->name('admin.general_setting');
        Route::post('loyality/general-setting-store', 'VipLoyalty\\VipLoyaltyController@general_settingStore')->name('admin.general_setting_store');
        Route::post('loyality/general-setting-update/{id}', 'VipLoyalty\\VipLoyaltyController@general_setting_Update')->name('admin.general_setting_Update');
        Route::get('loyality/general-setting-edit/{id}', 'VipLoyalty\\VipLoyaltyController@settng_Edit')->name('loyality.settng_Edit');
        Route::post('loyality/setting-status/{id}', 'VipLoyalty\\VipLoyaltyController@settng_status')->name('loyality.settng_status');
        Route::delete('loyality/setting-delete/{id}', 'VipLoyalty\\VipLoyaltyController@settng_delete')->name('loyality.settng_delete');

        //Loyality
        Route::get('add-loyality', 'VipLoyalty\\VipLoyaltyController@loyality_add')->name('admin.loyality_add');
        Route::post('add-loyality-store', 'VipLoyalty\VipLoyaltyController@loyality_Store')->name('admin.loyality_Store');
        Route::get('loyality-list', 'VipLoyalty\VipLoyaltyController@index')->name('admin.loyality_list');
        Route::get('loyality/general-loyalty-edit/{id}', 'VipLoyalty\VipLoyaltyController@loyalty_Edit')->name('loyality.loyalty_Edit');
        Route::post('loyality/general-loyalty-update/{id}', 'VipLoyalty\VipLoyaltyController@loyality_Update')->name('admin.loyality_Update');
        Route::post('loyality/tier-loyalty-status/{id}', 'VipLoyalty\VipLoyaltyController@Loyalty_status')->name('loyality.Loyalty_status');
        Route::delete('loyality/tier-loyalty-delete/{id}', 'VipLoyalty\VipLoyaltyController@loyalty_delete')->name('loyality.loyalty_delete');

        //Shop
        Route::get('list-shops', 'VipShops\\VipShopsController@ShopList')->name('admin.shop_list');
        Route::get('add-shops', 'VipShops\\VipShopsController@create')->name('admin.add_shop');
        Route::post('add-shop-store', 'VipShops\\VipShopsController@store')->name('admin.shop_store');
        Route::get('edit-shop/{id}', 'VipShops\\VipShopsController@edit')->name('admin.edit_shop');
        Route::post('add-shop-update/{id}', 'VipShops\\VipShopsControllerr@update')->name('admin.shop_update');
        Route::delete('delete-shops/{id}', 'VipShops\\VipShopsController@destroy')->name('shop.destroy');
        Route::get('purchase-items', 'VipShops\\VipShopsController@PurchaseItems')->name('admin.purchase_items');
        Route::post('status-shops/{id}', 'VipShops\\VipShopsController@status_change')->name('shop.status_change');

    });
    //missions
    Route::group(['middleware' => ['permission:Admin panel|Missions']], function () {
        Route::get('add-mission', 'missions\\MissionsController@create')->name('admin.add_mission');
        Route::get('mission-view/{id}', 'missions\\MissionsController@show')->name('admin.show_mission');
        Route::post('add-mission-store', 'missions\\MissionsController@store')->name('admin.mission_store');
        Route::get('list-mission', 'missions\\MissionsController@missionList')->name('admin.mission_list');
        Route::get('user-mission', 'missions\\MissionsController@usermission')->name('admin.usermission');
        Route::get('edit-mission/{id}', 'missions\\MissionsController@edit')->name('admin.edit_mission');
        Route::post('add-mission-update/{id}', 'missions\\MissionsController@update')->name('admin.mission_update');
        Route::post('status-mission/{id}', 'missions\\MissionsController@status_change')->name('mission.status_change');
        Route::delete('delete-mission/{id}', 'missions\\MissionsController@destroy')->name('mission.destroy');

    });
    // casino & general settings
    Route::group(['middleware' => ['permission:Admin panel|Casino Settings']], function () {
        Route::get('general-settings', 'casinoSetting\\GeneralSettingsController@index')->name('general-settings.index');
        Route::post('general-settings-store', 'casinoSetting\\GeneralSettingsController@store')->name('general-settings.store');
        Route::get('notify-Transaction-settings', 'casinoSetting\\GeneralSettingsController@notify_Transaction_settings')->name('notify_Transaction_settings');
        Route::post('Transaction-settings-store', 'casinoSetting\\GeneralSettingsController@store_Transaction_settings')->name('store_Transaction_settings');
        // Affiliate Referral Settings
        Route::get('affiliate-api-settings','casinoSetting\\AffiliateApiController@index')->name('affiliate-api-settings.index');
        Route::post('affiliate-api-settings','casinoSetting\\AffiliateApiController@update')->name('affiliate-api-settings');
      // language setting
        Route::get('language-keys','languageSetting\\LanguageSettingController@keys')->name('language-settings.keys');
        Route::get('add-key','languageSetting\\LanguageSettingController@add_key')->name('language-setting.addKey');
        Route::get('edit-key/{id}','languageSetting\\LanguageSettingController@edit_key')->name('language-settings.editKey');
        Route::get('delete-key/{id}','languageSetting\\LanguageSettingController@delete_key')->name('language-settings.deleteKey');
        Route::post('save-key','languageSetting\\LanguageSettingController@save_key')->name('language-settings.storeKey');
        Route::post('update-key','languageSetting\\LanguageSettingController@update_key')->name('language-settings.updateKey');

        Route::get('language','languageSetting\\LanguageSettingController@language')->name('language-settings.index');
        Route::get('add-language','languageSetting\\LanguageSettingController@add_lang')->name('language-settings.add');
        Route::get('edit-language/{id}','languageSetting\\LanguageSettingController@edit_lang')->name('language-settings.edit');
        Route::delete('delete-language/{id}','languageSetting\\LanguageSettingController@delete_lang')->name('language-settings.delete');
        Route::post('save-language','languageSetting\\LanguageSettingController@save_lang')->name('language-settings.save');
        Route::post('update-language','languageSetting\\LanguageSettingController@update_lang')->name('language-settings.update');

    });
    // finance
    Route::group(['middleware' => ['permission:Admin panel|Finances']], function () {
        Route::get('deposits', 'finances\\DepositsController@index')->name('deposits.index');
        Route::get('deposit-view/{id}', 'finances\\DepositsController@show')->name('deposits.show');
        Route::get('pending-deposit-view/{id}', 'finances\\DepositsController@pending_show')->name('pending-deposits.show');

        Route::get('withdrawals', 'finances\\WithdrawalsController@index')->name('withdrawals.index');
        Route::get('affiliate-withdrawals', 'finances\\WithdrawalsController@affiliate_withdraws')->name('withdrawals.affiliate');
        Route::get('withdrawal-view/{id}', 'finances\\WithdrawalsController@View')->name('withdrawals.View');
        Route::get('affiliate-withdrawal/{id}', 'finances\\WithdrawalsController@aff_View')->name('Affiliate.withdrawals.View');
        Route::post('withdraw-approve/{id}', 'finances\\WithdrawalsController@Approve')->name('admin.userwithdraw_Approve');
        Route::post('withdraw-reject/{id}', 'finances\\WithdrawalsController@Reject')->name('admin.UserWithdrawReject');
    });
    // game management
    Route::group(['middleware' => ['permission:Admin panel|Games Management']], function () {
        Route::resource('achievement-list', 'GamesManagement\\AchievementListController');
        Route::resource('slots', 'GamesManagement\\SlotsController');
        Route::resource('roulette', 'GamesManagement\\RouletteController');
        Route::resource('craps', 'GamesManagement\\CrapsController');
        Route::resource('keno', 'GamesManagement\\KenoController');
        Route::resource('black-jack', 'GamesManagement\\BlackJackController');
        Route::resource('baccarat', 'GamesManagement\\BaccaratController');
        Route::resource('add-games', 'GamesManagement\\AddGamesController');
        Route::post('order-game/{id}', 'GamesManagement\AddGamesController@GameOrder')->name('GameOrder');
        Route::get('games-name/{id}', 'GamesManagement\\AddGamesController@single_game')->name('single_game');
        Route::get('games-icon-edit/{id}/{ex}/{game}', 'GamesManagement\\AddGamesController@game_icon_edit')->name('game_icon_edit');
        Route::post('games-icon-update/', 'GamesManagement\\AddGamesController@game_icon_update')->name('game_icon_update');

        // softswiss games
        // Route::get('softswiss-categories','Softswiss\\GameController@categories')->name('softswissCategories');
        // Route::get('add-softswiss-category','Softswiss\\GameController@add_category')->name('add.SoftswissCategory');
        // Route::get('edit-softswiss-category/{id}','Softswiss\\GameController@edit_category')->name('edit.SoftswissCategory');
        // Route::get('delete-softswiss-category/{id}','Softswiss\\GameController@delete_category')->name('delete.SoftswissCategory');
        // Route::post('save-softswiss-category','Softswiss\\GameController@save_category')->name('save.SoftswissCategory');
        // Route::post('update-softswiss-category','Softswiss\\GameController@update_category')->name('update.SoftswissCategory');

        // Route::get('softswiss-games','Softswiss\\GameController@games')->name('softswissGames');
        // Route::get('add-softswiss-game','Softswiss\\GameController@add_game')->name('add.SoftswissGame');
        // Route::get('edit-softswiss-game/{id}','Softswiss\\GameController@edit_game')->name('edit.SoftswissGame');
        // Route::get('delete-softswiss-game/{id}','Softswiss\\GameController@delete_game')->name('delete.SoftswissGame');
        // Route::post('save-softswiss-game','Softswiss\\GameController@save_game')->name('save.SoftswissGame');
        // Route::post('update-softswiss-game','Softswiss\\GameController@update_game')->name('update.SoftswissGame');

    });
    //security
    Route::group(['middleware' => ['permission:Admin panel|Security']], function () {
        Route::get('black-list', 'Security\\BlackListController@index')->name('black-list.index');
        Route::get('black-list-block/{id}', 'Security\\BlackListController@block')->name('black-list.block');
        // Accounts & Ip's Detectors
        Route::get('detect-accounts', 'Security\\BlackListController@similar_accounts')->name('AccountDetectors.index');
        Route::get('similar-accounts/{id}', 'Security\\BlackListController@view_accounts')->name('AccountDetectors.view');
        // IP's Detectors
        Route::get('detect-ips', 'Security\\BlackListController@similar_ips')->name('IpDetectors.index');
        Route::get('similar-ips/{id}', 'Security\\BlackListController@view_ips')->name('IpDetectors.view');

    });
     //subscription
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('subscribers', 'Subscriptions\\SubscribersController@index')->name('subscribers-list');
        Route::post('send-email', 'Subscriptions\\SubscribersController@send_email')->name('send-email');
        Route::get('remove-email/{id}', 'Subscriptions\\SubscribersController@remove_email')->name('remove-email');
        Route::post('all-contacts', 'Subscriptions\\SubscribersController@all_contacts')->name('all-contacts');
        Route::get('statistic-report', 'Subscriptions\\SubscribersController@statistic_report')->name('statistic-report');
        Route::post('statistic-filter', 'Subscriptions\\SubscribersController@statistic_filter')->name('statistic_filter');

    });
    // backups
    Route::group(['middleware' => ['permission:Admin panel']], function () {
        Route::get('backup-list', 'backups\\BackupController@index')->name('backup-list');
        Route::get('take-backup', 'backups\\BackupController@backup')->name('backup-new');
        Route::get('database-restore/{id}', 'backups\\BackupController@restore')->name('backup-restore');
    });
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('download/image/{id}', 'affiliate\\AffiliateController@download_image')->name('DownloadImage');
    Route::get('/affiliate-media','affiliate\\AffiliateController@media')->name('affiliate.media');
    Route::get('affiliate-AddTemplate','affiliate\\AffiliateController@add_template')->name('Affiliate.addTemplate');
    Route::get('/view-media/{id}','affiliate\\AffiliateController@view_media')->name('affiliate.showMedia');
    Route::get('/delete-media/{id}','affiliate\\AffiliateController@delete_media')->name('affiliate.deleteMedia');
    Route::get('/edit-media_icon/{id}','affiliate\\AffiliateController@edit_media_icon')->name('edit-MediaIcon');
    Route::get('/delete-media_icon/{id}','affiliate\\AffiliateController@delete_media_icon')->name('delete-MediaIcon');
    Route::post('/save-template','affiliate\\AffiliateController@save_template')->name('affiliate.saveTemplate');
    Route::post('/save-media','affiliate\\AffiliateController@save_media')->name('affiliate.saveMedia');
    Route::post('/update-media','affiliate\\AffiliateController@update_media')->name('affiliate.updateMedia');
    Route::post('/change_mediaStatus','affiliate\\AffiliateController@change_media_status')->name('affiliate.change_mediaStatus');
    Route::resource('affiliate-settings', 'affiliate\\AffiliateSettingsController');
    Route::resource('completed-payments', 'affiliate\\CompletedPaymentsController');
    Route::resource('list-affiliates', 'affiliate\\ListAffiliatesController');
    Route::resource('send-payments', 'affiliate\\SendPaymentsController');
    Route::resource('activated-bonuses', 'bonus\\ActivatedBonusesController');



    //Mission Type
  /*   Route::get('add-mission-type', 'bonus\\MissionController@mission_type_create')->name('admin.add_mission_type');
    Route::post('mission-type-store', 'bonus\\MissionController@mission_type_store')->name('admin.mission_type_store');
    Route::get('list-mission-type', 'bonus\\MissionController@mission_type')->name('admin.mission_type_list');
    Route::get('edit-mission-type/{id}', 'bonus\\MissionController@mission_type_edit')->name('admin.edit_mission_type');
    Route::post('mission-type-update/{id}', 'bonus\\MissionController@mission_type_update')->name('admin.mission_type_update');
    Route::post('status-mission-type/{id}', 'bonus\\MissionController@mission_type_status_change')->name('type_mission.status_change');
    Route::delete('delete-mission-type/{id}', 'bonus\\MissionController@mission_type_destroy')->name('type_mission.destroy');
 */
    //Shop

    // Route::resource('list-shops', 'bonus\\ListShopsController');
    Route::resource('purchases-shops', 'bonus\\PurchasesShopsController');
    Route::resource('admin-language', 'casinoSetting\\AdminLanguageController');
    Route::resource('casino-payout', 'casinoSetting\\CasinoPayoutController');
    Route::resource('environment-settings', 'casinoSetting\\EnvironmentSettingsController');
    // casino general settings
    Route::group(['middleware' => ['permission:Admin panel|Casino Settings']], function () {
        Route::get('general-settings', 'casinoSetting\\GeneralSettingsController@index')->name('general-settings.index');
        Route::post('general-settings-store', 'casinoSetting\\GeneralSettingsController@store')->name('general-settings.store');
        Route::get('notify-Transaction-settings', 'casinoSetting\\GeneralSettingsController@notify_Transaction_settings')->name('notify_Transaction_settings');
        Route::post('Transaction-settings-store', 'casinoSetting\\GeneralSettingsController@store_Transaction_settings')->name('store_Transaction_settings');
    });

    Route::resource('responsible-gaming', 'casinoSetting\\ResponsibleGamingController');
    Route::resource('staff-access', 'casinoSetting\\StaffAccessController');
    Route::resource('system-limits', 'casinoSetting\\SystemLimitsController');
    Route::resource('content-page-add', 'contentManagement\\ContentPageAddController');
    Route::resource('content-page-list', 'contentManagement\\ContentPageListController');
    Route::resource('email-templates-add', 'contentManagement\\EmailTemplatesAddController');
    Route::resource('email-templates-list', 'contentManagement\\EmailTemplatesListController');
    Route::resource('layout-section', 'contentManagement\\LayoutSectionController');
    Route::resource('link-manager', 'contentManagement\\LinkManagerController');
    Route::resource('template-map', 'contentManagement\\TemplateMapController');
    Route::resource('credit-transfers', 'finances\\CreditTransfersController');
    Route::resource('financial-events', 'finances\\FinancialEventsController');
    Route::resource('my-earnings', 'finances\\MyEarningsController');
    Route::resource('payment-methods', 'finances\\PaymentMethodsController');
    Route::resource('earnings', 'LotteryRng\\EarningsController');
    Route::resource('generate-lottery-ticket', 'LotteryRng\\GenerateLotteryTicketController');
    Route::resource('list-lottery-tickets', 'LotteryRng\\ListLotteryTicketsController');
    Route::resource('prizes-grant-prize', 'LotteryRng\\PrizesGrantPrizeController');
    Route::resource('list-prizes', 'LotteryRng\\ListPrizesController');
    Route::resource('prize-settings', 'LotteryRng\\PrizeSettingsController');
    Route::resource('view-results', 'LotteryRng\\ViewResultsController');
    Route::resource('backup-databases', 'Maintenance\\BackupDatabasesController');
    Route::resource('build-images', 'Maintenance\\BuildImagesController');
    Route::resource('clear-logins', 'Maintenance\\ClearLoginsController');
    Route::resource('clear-financial-records', 'Maintenance\\ClearFinancialRecordsController');
    Route::resource('clear-gameplay-records', 'Maintenance\\ClearGameplayRecordsController');
    Route::resource('clear-staff-logs', 'Maintenance\\ClearStaffLogsController');
    Route::resource('clear-blacklist-ips', 'Maintenance\\ClearBlacklistIpsController');
    Route::resource('clear-multiplayers', 'Maintenance\\ClearMultiplayersController');
    Route::resource('clear-tournaments', 'Maintenance\\ClearTournamentsController');
    Route::resource('clear-messages', 'Maintenance\\ClearMessagesController');
    Route::resource('file-integrity-lists', 'Maintenance\\FileIntegrityListsController');
    Route::resource('reset-all-banks', 'Maintenance\\ResetAllBanksController');
    Route::resource('reset-all-jackpots', 'Maintenance\\ResetAllJackpotsController');
    Route::resource('reset-casinos', 'Maintenance\\ResetCasinosController');
    Route::resource('services-health-monitor', 'Maintenance\\ServicesHealthMonitorController');
    Route::resource('create-tournaments', 'MultiTournaments\\CreateTournamentsController');
    Route::resource('free-mass-tickets', 'MultiTournaments\\FreeMassTicketsController');
    Route::resource('free-tickets', 'MultiTournaments\\FreeTicketsController');
    Route::resource('list-tournaments', 'MultiTournaments\\ListTournamentsController');
    Route::resource('settings', 'MultiTournaments\\SettingsController');
    Route::resource('tournament-gameplays', 'MultiTournaments\\TournamentGameplaysController');
    Route::resource('view-all-tickets', 'MultiTournaments\\ViewAllTicketsController');
    Route::resource('bingo-settings', 'MultiPlayerBingo\\BingoSettingsController');
    Route::resource('view-bingo-tickets', 'MultiPlayerBingo\\ViewBingoTicketsController');
    Route::resource('view-bingo-results', 'MultiPlayerBingo\\ViewBingoResultsController');
    Route::resource('card-settings', 'MultiPlayerCard\\CardSettingsController');
    Route::resource('view-bets', 'MultiPlayerCard\\ViewBetsController');
    Route::resource('card-view-results', 'MultiPlayerCard\\CardViewResultsController');
    Route::resource('races-settings', 'MultiPlayerRaces\\RacesSettingsController');
    Route::resource('races-view-bets', 'MultiPlayerRaces\\RacesViewBetsController');
    Route::resource('races-view-results', 'MultiPlayerRaces\\RacesViewResultsController');
    Route::resource('roulette-settings', 'MultiPlayerRoulette\\RouletteSettingsController');
    Route::resource('roulette-view-bets', 'MultiPlayerRoulette\\RouletteViewBetsController');
    Route::resource('roulette-view-results', 'MultiPlayerRoulette\\RouletteViewResultsController');
    Route::resource('sicbo-settings', 'MultiPlayerSicbo\\SicboSettingsController');
    Route::resource('sicbo-view-bets', 'MultiPlayerSicbo\\SicboViewBetsController');
    Route::resource('sicbo-view-results', 'MultiPlayerSicbo\\SicboViewResultsController');
    Route::resource('balance-adjustment', 'Reports\\BalanceAdjustmentController');
    Route::resource('change-notification', 'Reports\\ChangeNotificationController');
    Route::resource('dormant-account', 'Reports\\DormantAccountController');
    Route::resource('performance-payout', 'Reports\\PerformancePayoutController');
    Route::resource('performance-report', 'Reports\\PerformanceReportController');
    Route::resource('revenue-report', 'Reports\\RevenueReportController');
    Route::resource('account-exclusions-report', 'Reports\\AccountExclusionsReportController');
    Route::resource('account-lock', 'Reports\\AccountLockController');
    Route::resource('player-deactivations', 'Reports\\PlayerDeactivationsController');
    Route::resource('player-sessions', 'Reports\\PlayerSessionsController');
    Route::resource('jackpot-config', 'Reports\\JackpotConfigController');
    Route::resource('jackpot-wons', 'Reports\\JackpotWonsController');
    Route::resource('account-summary', 'Reports\\AccountSummaryController');
    Route::resource('significant-event', 'Reports\\SignificantEventController');
    Route::resource('event-reports', 'Reports\\EventReportsController');
    Route::resource('taxed-game-plays', 'Reports\\TaxedGamePlaysController');

    Route::resource('blacklist-add', 'Security\\BlacklistAddController');

    Route::resource('ban-ip', 'Security\\BanIPController');
    Route::resource('banedip-list', 'Security\\BanedipListController');
    Route::resource('configure-feed', 'SportsBook\\ConfigureFeedController');
    Route::resource('configure-leagues', 'SportsBook\\ConfigureLeaguesController');
    Route::resource('maintenance', 'SportsBook\\MaintenanceController');
    Route::resource('reevaluate-tickets', 'SportsBook\\ReevaluateTicketsController');
    Route::resource('sports-settings', 'SportsBook\\SportsSettingsController');
    Route::resource('sports-view-events', 'SportsBook\\SportsViewEventsController');
    Route::resource('sports-view-tickets', 'SportsBook\\SportsViewTicketsController');

    Route::get('create-agent', 'StaffManagement\\CreateAgentController@index')->name('create-agent.index');
    Route::post('create-agent', 'StaffManagement\\CreateAgentController@store')->name('create-agent.store');
    Route::get('agent-list', 'StaffManagement\\CreateAgentController@show')->name('create-agent.list');
    Route::get('agent-logs', 'StaffManagement\\CreateAgentController@logs')->name('create-agent.logs');

    Route::get('create-operator', 'StaffManagement\\CreateOperatorController@index')->name('create-operator.index');
    Route::post('create-operator', 'StaffManagement\\CreateOperatorController@store')->name('create-operator.store');
    Route::get('operator-list', 'StaffManagement\\CreateOperatorController@show')->name('create-operator.list');
    Route::get('operator-logs', 'StaffManagement\\CreateOperatorController@logs')->name('create-operator.logs');

    // Route::resource('create-operator', 'StaffManagement\\CreateOperatorController');
    Route::resource('list-agents', 'StaffManagement\\ListAgentsController');
    Route::resource('list-operator', 'StaffManagement\\ListOperatorController');
    Route::resource('login-history-staff', 'StaffManagement\\LoginHistoryStaffController');
    Route::resource('search-staff', 'StaffManagement\\SearchStaffController');
    Route::resource('transfer-funds-to-agents', 'StaffManagement\\TransferFundsToAgentsController');
    Route::resource('casino-activity', 'Statistics\\CasinoActivityController');
    Route::resource('game-volatility', 'Statistics\\GameVolatilityController');
    Route::resource('overall-activity', 'Statistics\\OverallActivityController');
    Route::resource('chart-profit', 'Statistics\\ChartProfitController');
    Route::resource('deposits-withdrawals', 'Statistics\\DepositsWithdrawalsController');
    Route::resource('signup-conversions', 'Statistics\\SignupConversionsController');
    Route::resource('statistics-dashboard', 'Statistics\\StatisticsDashboardController');
    Route::resource('conversion-rates', 'Statistics\\ConversionRatesController');
    Route::resource('disabled-users', 'Statistics\\DisabledUsersController');
    Route::resource('gameplay-statistics', 'Statistics\\GameplayStatisticsController');
    Route::resource('create-users', 'UserManagement\\CreateUsersController');
    Route::get('/check_pro_parent', 'UserManagement\\CreateUsersController@check_pro_parent');

    // user management
    Route::group(['middleware' => ['permission:Admin panel|User Management']], function () {
        Route::resource('list-users', 'UserManagement\\ListUsersController');
        // user document Start
        Route::get('user-documents', 'UserManagement\\ListUsersController@UserDocument')->name('admin.list_documents');
        Route::get('user-documents-download/{id}', 'UserManagement\\ListUsersController@UserDocumentDownload')->name('admin.list_documents_download');
        Route::post('user-documents-approve/{id}', 'UserManagement\\ListUsersController@UserDocumentApprove')->name('admin.UserDocumentApprove');
        Route::post('user-documents-reject/{id}', 'UserManagement\\ListUsersController@UserDocumentReject')->name('admin.UserDocumentReject');
        Route::get('user-documents-view/{id}', 'UserManagement\\ListUsersController@UserDocumentView')->name('user-documents.View');
        // user document end
        Route::resource('loggedin-users', 'UserManagement\\LoggedinUsersController');
        Route::resource('loggedin-history-users', 'UserManagement\\LoggedinHistoryUsersController');
        Route::resource('list-messages', 'UserManagement\\ListMessagesController');
        Route::resource('send-messages', 'UserManagement\\SendMessagesController');
        Route::resource('multi-account', 'UserManagement\\MultiAccountController');
        Route::resource('multiip-detector', 'UserManagement\\MultiipDetectorController');
        Route::resource('list-support-tickets', 'Other\\ListSupportTicketsController');
        Route::resource('list-misc-logs', 'Other\\ListMiscLogsController');
        Route::resource('send-newsletter', 'Other\\SendNewsletterController');
        Route::resource('system-event-add', 'Other\\SystemEventAddController');
        Route::resource('system-event-list', 'Other\\SystemEventListController');
        Route::resource('upload-site-map', 'Other\\UploadSiteMapController');
    });
    Route::post('get-city', 'UserManagement\\CreateUsersController@get_city')->name('get_city');
    Route::post('status-change/{id}', 'UserManagement\\ListUsersController@status_change')->name('admin.status_change');
    Route::delete('delete-user/{id}', 'UserManagement\\ListUsersController@delete')->name('admin.delete_user');
  //system toekn
    Route::get('system-token','Admin\AdminController@admin_token')->name('admin_token');
    Route::post('system-token-store','Admin\AdminController@Token_store')->name('admin_token_store');
    Route::get('system-token-edit/{id}','Admin\AdminController@Token_edit')->name('Token_edit');
    Route::post('system-token-update','Admin\AdminController@Token_update')->name('admin_token_update');
  //system Spin
    Route::get('system-spin','Admin\AdminController@admin_spin')->name('admin_spin');
    Route::post('system-spin-store','Admin\AdminController@spin_store')->name('admin_spin_store');
    Route::get('system-spin-edit/{id}','Admin\AdminController@spin_edit')->name('spin_edit');
    Route::post('system-spin-update/{id}','Admin\AdminController@spin_update')->name('admin_spin_update');
    Route::get('system-spin-change/{id}','Admin\AdminController@spin_change')->name('spin_change');
  //Pley6 currency conversation
    Route::get('system-pleysix-token','Admin\AdminController@currencyConversaton')->name('currencyConversaton');
    Route::post('system-pleysix-token-store','Admin\AdminController@currencyConversaton_store')->name('currencyConversaton_store');
    Route::get('system-pleysix-token-edit/{id}','Admin\AdminController@currencyConversaton_edit')->name('currencyConversaton_edit');
    Route::post('system-pleysix-token-update/{id}','Admin\AdminController@currencyConversaton_update')->name('currencyConversaton_update');

    // system setting
    Route::get('system-settings','Admin\AdminController@system_settings')->name('system_settings');
    Route::get('deposit-report','Reports\DepositReportsController@index')->name('deposit-report');
    Route::get('generate-deposit-report','Reports\DepositReportsController@generate_report')->name('generate_deposit_report');
});

Route::get('/home', 'HomeController@index')->name('home');
