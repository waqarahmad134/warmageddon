<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
    public function hasPermission($requiredPermission){
        $permissions = $this->permissions;
        foreach($permissions as $permission){
            if($requiredPermission == $permission){
                return true; //returns true early if the permission is found (as it doesnt need to continue)
            }
        }
        //if none are found then it will eventually reach this
        return false;
    }
}
