<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class HelloWorldEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public function __construct()
    {
        $this->message = 'Hello World';
    }

    public function broadcastOn()
    {
        return new Channel('test-channel');
    }
}
