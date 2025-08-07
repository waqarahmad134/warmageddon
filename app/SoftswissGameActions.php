<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftswissGameActions extends Model
{
    protected $table = 'softswiss_games_actions';

    public function getGame()
    {
        return $this->belongsTo(SoftswissGames::class,'game_id','id');
    }
    public function getTransactions()
    {
        return $this->hasMany(SoftswissTransactions::class,'action_id','id');
    }

}
