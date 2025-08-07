<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateMap extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'template_maps';

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
