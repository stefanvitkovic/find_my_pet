<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $admins;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order,$admins,$data)
    {
        $this->order = $order;
        $this->admins = $admins;
        $this->data = $data;
    }

}
