<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AxcessPayment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public function __construct($user)
    {
        $this->user  = $user;
    }

    public function broadcastOn()
    {

        $channels = [
            'receiver.' . $this->user,
        ];

        return $channels;
    }
    public function broadcastAs()
    {
        return 'AxcessPayment';
    }
}
