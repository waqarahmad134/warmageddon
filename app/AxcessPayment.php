<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AxcessPayment extends Model
{
    protected $table = 'axcess_payment';

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','user');
    }
    public function paymentHistory()
    {
        return $this->hasMany(CurrencyBaseRate::class,'ref_key','token');
    }
}
