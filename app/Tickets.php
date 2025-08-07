<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table  = 'ticket';

    public function contents()
    {
        return $this->hasMany(TicketContents::class,'ticket_number','ticket_number');
    }
    public function files()
    {
        return $this->hasMany(TicketFiles::class,'ticket_number','ticket_number');
    }
    public function Ticketstatus()
    {
        return $this->hasMany(TicketStatus::class,'ticket_number','ticket_number');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
