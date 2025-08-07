<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SicboViewBet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sicbo_view_bets';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status'];

    
}
