<?php

use App\WebSocket\WebSocketClient;

function wsBroadcast(array $message, array $cookies = [])
{
    $client = new WebSocketClient(env('APP_WS_BROADCAST'), $cookies);

    return $client->sendMessage($message);
}
