<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

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
    protected $fillable = [
        'user_id',
        'base_image',
        'username',
        'first_name',
        'last_name',
        'address',
        'date_of_birth',
        'tag',
        'country',
        'city',
        'phone_number',
        'balance',
        'secret_question',
        'secret_answer',
        'status',
    ];

    public function State()
    {
        return $this->hasOne('App\State', 'name', 'state');
    }
    public function Country()
    {
        return $this->hasOne('App\Country', 'id', 'country');
    }
}
