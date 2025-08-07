<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';

    public function getAxcess()
    {
        return $this->belongsTo(AxcessPayment::class,'orderID','charge_id');
    }
}
