<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddBonus extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'add_bonuses';

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

    public function bonus()
    {
        return $this->hasMany('App\Bonus');
    }
}
