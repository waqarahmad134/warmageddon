<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateVisitorHistory extends Model
{
    protected $table = 'affliate_visitor_history';

    public function affiliate()
    {
        return $this->hasOne(User::class,'id','aff_id');
    }
}
