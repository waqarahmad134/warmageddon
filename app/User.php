<?php

namespace App;

use Mail;
use Cache;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles,LogsActivity;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static $logName = 'User';
    protected $fillable = [
        'first_name','last_name','question','ans','user_name','city','street','country','phone','dob','email', 'password','gender','ref_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Country()
    {
        return $this->hasOne('App\Country', 'id', 'country');
    }
    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }
    public function listafiiliate()
    {
        return $this->hasOne('App\ListAffiliate');
    }
    public function Loginhistory()
    {
        return $this->hasOne('App\LoggedinHistoryUser');
    }
    public function logged_id()
    {
        return $this->hasOne('App\LoggedinUser');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }
    public function wagers()
    {
        return $this->hasOne('App\Wager');
    }
    /*public function account()
    {
        return $this->hasOne('App\Account');
    }*/
   /* public function balance()
    {
        return $this->hasMany('App\Balance');
    }*/
    public function bonus()
    {
        return $this->hasMany('App\Bonus');
    }
    public function deposit()
    {
        return $this->hasMany('App\Deposit');
    }
    public function withdraw()
    {
        return $this->hasMany('App\Withdraw');
    }
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
    public function getPhoneNumber()
    {
        return $this->country_code.$this->phone;
    }
    public function identities() {
        return $this->hasMany('App\SocialIdentity');
     }

     public function sendPasswordResetNotification($token)
    {

        $data = [
            $this->email
        ];
        Mail::send('mail.password_mail', [
            'username'      => $this->usernamme,
            'reset_url'     => route('password.reset.token',$token),
        ], function($message) use($data){
            $message->subject('ProperSix Reset Password');
            $message->to($data[0]);
        });



        //$this->notify(new App\Notifications\MailResetPasswordNotification($token));
    }

    public function payment(){
        return $this->hasMany('App\BuyToken','user_id');
    }
    public function favorite_game(){
        return $this->hasMany('App\FavoriteGame','user_id');
    }
    public function missionStart(){
        return $this->hasMany('App\UserMission','user_id');
    }
    public function missionStartCheck(){
        return $this->hasOne('App\UserMission','user_id')->where('status',1);
    }
    public function purchasesShop(){
        return $this->hasMany('App\PurchasesShop','user_id');
    }

}
