<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoggedinUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loggedin_users';

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
    protected $fillable = ['name', 'status','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
