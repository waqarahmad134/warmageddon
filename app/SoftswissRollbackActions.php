<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftswissRollbackActions extends Model
{
    protected $table = 'softswiss_rollback_actions';

    public function getRollback()
    {
        return $this->belongsTo(SoftswissRollback::class,'rollback_id','id');
    }
    public function getAction()
    {
        return $this->hasOne(SoftswissGameActions::class,'action_identifier','original_action_id');
    }
}
