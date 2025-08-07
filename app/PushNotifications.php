<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotifications extends Model
{
    protected $table = 'push_notifications';
    /**
     * @var int|mixed
     */
    private $user_status;

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
