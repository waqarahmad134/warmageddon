<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsixUserWallet extends Model
{
    protected $table = 'prosix_user_wallets';
    protected $fillable = ['user_id'];
}
