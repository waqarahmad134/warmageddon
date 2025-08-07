<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinPayment extends Model
{
    protected $table = 'coin_payment';

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class,'user_id','user_id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
