<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Contact;

class ContactUnsubscribe
{
    use InteractsWithSockets, SerializesModels;

    /**
     * [$contact description]
     * @var [type]
     */
    public $contact;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
         $this->contact = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
