<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftswissGameSession extends Model
{
    use SoftDeletes;
    protected $table = 'softswiss_games_sessions';

    public function getGame()
    {
        return $this->belongsTo(SoftswissGames::class,'game_id','user_id');
    }
    public function getUser()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }
}
