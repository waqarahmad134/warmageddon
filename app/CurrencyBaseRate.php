<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyBaseRate extends Model
{
    protected $table = 'currency_base_rate';

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getPayment()
    {
        return $this->belongsTo(AxcessPayment::class,'ref_key','token');
    }
}
