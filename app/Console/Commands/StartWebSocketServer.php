<?php

namespace App\Console\Commands;

use App\WebSocket\WebSocketServer;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class StartWebSocketServer extends Command
{
    protected $signature = 'websocket:serve {port=6001}';

    protected $description = 'Start the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $port = $this->argument('port');
        $this->info("Starting the WebSocket server on port $port...");

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketServer()
                )
            ),
            $port
        );

        $server->run();
    }
}
