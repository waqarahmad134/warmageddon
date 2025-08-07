<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function Country()
    {
        return $this->hasOne('App\Country', 'id', 'w_country');
    }
}
