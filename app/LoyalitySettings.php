<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoyalitySettings extends Model
{
    public function game()
    {
        return $this->belongsTo('App\AddGame','game_id','id');
    }
}
