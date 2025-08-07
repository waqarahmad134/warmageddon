<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewBet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'view_bets';

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
