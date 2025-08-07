<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesCategory extends Model
{
    protected $table = 'games_category';

    public function getGames()
    {
        return $this->hasMany(AddGame::class,'game_category','name');
    }
}

