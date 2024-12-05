<?php

namespace App\Events;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GotNewChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Room $room)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("user.{$this->room->users()->first()->id}"),
            new PrivateChannel("user.{$this->room->users()->latest()->first()->id}"),
        ];
    }
}
