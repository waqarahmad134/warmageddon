<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemEventAdd extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_event_adds';

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
