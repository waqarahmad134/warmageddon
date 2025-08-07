<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class MissionBonus extends Model
{
    function mission_type(){
        return $this->belongsTo('App\MisssionType','type');
    }
}
