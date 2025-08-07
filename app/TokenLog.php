<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'token_logs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    
}