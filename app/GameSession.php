<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_sessions';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'session_id';
    
}
