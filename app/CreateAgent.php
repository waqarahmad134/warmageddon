<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateAgent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'create_agents';

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
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
