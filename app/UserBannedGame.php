<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBannedGame extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_banned_games';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    
}
