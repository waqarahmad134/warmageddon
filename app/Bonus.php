<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    public function add_bonus()
    {
        return $this->belongsTo(PropersixBonus::class);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
