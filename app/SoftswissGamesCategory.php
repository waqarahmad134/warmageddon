<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftswissGamesCategory extends Model
{
    use SoftDeletes;
    protected $table = 'softswiss_games_category';

    public function games()
    {
        return $this->hasMany(SoftswissGames::class,'category','id');
    }
}
