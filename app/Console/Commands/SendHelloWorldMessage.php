<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendHelloWorldMessage extends Command
{
    protected $signature = 'send:message';

    protected $description = 'Send Hello World Message to WebSocket Server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        print_r(wsBroadcast(['type' => 'hello', 'content' => 'Hello, WebSocket Server!'], ['SC' => 'TROLOLO']));
    }
}
