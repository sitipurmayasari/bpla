<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BroadCastRequestEkspor
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_id;
    public $number;
	public $message;
    public $link;
    public $created_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$number,$message,$link,$created_at)
    {
        $this->user_id = $user_id;
        $this->number = $number;
        $this->message = $message;
        $this->link = $link;
        $this->created_at = $created_at;

        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('request-ekspor-channel-'.$this->user_id);

    }
}
