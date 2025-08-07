<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetAllBank extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reset_all_banks';

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
