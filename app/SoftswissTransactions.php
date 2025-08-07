<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftswissTransactions extends Model
{
    protected $table = 'softswiss_actions_transactions';

    public function getGame()
    {
        return $this->belongsTo(SoftswissGames::class,'game_id','id');
    }
    public function getAction()
    {
        return $this->belongsTo(SoftswissGameActions::class,'action_id','id');
    }
}
