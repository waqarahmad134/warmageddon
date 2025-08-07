<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListAffiliate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'list_affiliates';

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
    protected $fillable = ['name', 'status','user_id','aff_id'];
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
