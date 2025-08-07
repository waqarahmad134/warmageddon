<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanIP extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ban_i_ps';

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
    protected $fillable = ['user_id','ban_start_date', 'type','client_ip','duration_minutes','ban_start_date'];

    
}
