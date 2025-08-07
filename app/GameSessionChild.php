<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameSessionChild extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_session_childs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'session_child_id';
    protected $hidden = array('user_id');
    public function useracc()
    {
      return  $this->hasOne(User::class,'id','user_id')->select('id','user_name');
    }

}
