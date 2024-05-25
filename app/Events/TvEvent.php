<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TvEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nomorAntrianTerakhir;
    public $nomorAntrianTerakhirLayanan;

    /**
     * Create a new event instance.
     */
    public function __construct($nomorAntrianTerakhir, $nomorAntrianTerakhirLayanan)
    {
        $this->nomorAntrianTerakhir = $nomorAntrianTerakhir;
        $this->nomorAntrianTerakhirLayanan = $nomorAntrianTerakhirLayanan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('antrian-online')
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */

    public function broadcastWith(): array
    {
        return [
            'nomorAntrianTerakhir' => $this->nomorAntrianTerakhir,
            'nomorAntrianTerakhirLayanan' => $this->nomorAntrianTerakhirLayanan
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */

    public function broadcastAs(): string
    {
        return 'tv-event';
    }
}
