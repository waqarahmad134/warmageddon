<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteGame extends Model
{
    public function game()
    {
        return $this->belongsTo('App\AddGame','game_id');
    }
}
