<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffAccess extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff_accesses';

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
