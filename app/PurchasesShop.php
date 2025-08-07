<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesShop extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchases_shops';

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

    public function add_shop()
    {
        return $this->hasOne(AddShop::class,'id','shop_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
