<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerateLotteryTicket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'generate_lottery_tickets';

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
    protected $fillable = ['username', 'nr_of_tickts'];

    
}
