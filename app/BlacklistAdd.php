<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlacklistAdd extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blacklist_adds';

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
    protected $fillable = ['user_id','type', 'value','reason'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}
