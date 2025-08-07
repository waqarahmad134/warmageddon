<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketContents extends Model
{
    protected $table = 'ticket_content';

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class,'user_id','user_id');
    }
}
