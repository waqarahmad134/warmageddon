<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocuments extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function kyc()
    {
        return $this->hasOne(KycDocuments::class,'doc_id','id');
    }
}
