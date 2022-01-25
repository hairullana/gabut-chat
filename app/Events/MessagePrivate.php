<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message, $userId, $conversationId;

    public function __construct($conversationId, $userId, $message)
    {
        $this->conversationId = $conversationId;
        $this->userId = $userId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('privateChat');
    }

    public function broadcastAs(){
        return 'privateMessage';
    }
}
