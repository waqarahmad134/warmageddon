<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $table = 'ticket_status';

    public function getcontents()
    {
        return $this->hasOne(TicketContents::class,'ticket_number','ticket_number');
    }
    public function getfiles()
    {
        return $this->hasOne(TicketFiles::class,'ticket_number','ticket_number');
    }
    public function getparent()
    {
        return $this->hasOne(Tickets::class,'ticket_number','ticket_number');
    }
}
