<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffiliateUser extends Model
{
    use SoftDeletes;
    protected $table = 'affiliate_user';

    public function getUserCountry()
    {
        return $this->belongsTo(Country::class,'country','id');
    }
}
