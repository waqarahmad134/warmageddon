<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftswissGames extends Model
{
    use SoftDeletes;
    protected $table = 'softswiss_games';

    public function getCategory()
    {
        return $this->belongsTo(SoftswissGamesCategory::class,'category','id');
    }
    public function getSessions()
    {
        return $this->hasMany(GameSession::class,'game_id','id');
    }
    public function gameActions()
    {
        return $this->hasMany(SoftswissGameActions::class,'game_id','id');
    }
    public function gameTransactions()
    {
        return $this->hasMany(SoftswissTransactions::class,'game_id','id');
    }

}
