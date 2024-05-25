<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ValasEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $valas1;
    public $valas2;

    /**
     * Create a new event instance.
     */
    public function __construct($valas1, $valas2)
    {
        $this->valas1 = $valas1;
        $this->valas2 = $valas2;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('antrian-online'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'valas-event';
    }

    public function broadcastWith(): array
    {
        return [
            'valas1' => $this->valas1,
            'valas2' => $this->valas2,
        ];
    }

    
}
