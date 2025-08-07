<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMission extends Model
{    
    public function MissionBonus()
    {
        return $this->belongsTo('App\MissionBonus', 'mission_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
