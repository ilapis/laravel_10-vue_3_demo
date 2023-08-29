<?php

namespace App\WebSocket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WebSocketServer implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Received message: $msg\n";
        echo "From connection: ({$from->resourceId})\n";
        echo "Method: ({$from->httpRequest->getMethod()})\n";

        $cookiesHeader = $from->httpRequest->getHeader('Cookie');
        //print_r($cookiesHeader);
        $cookies = explode('; ', $cookiesHeader[0]);
        $keyValueArray = [];
        foreach ($cookies as $item) {
            [$key, $value] = explode('=', $item, 2);
            $keyValueArray[$key] = $value;
        }
        print_r($keyValueArray);

        $from->send(json_encode(['type' => 'response', 'content' => 'text', 'message' => $msg])); // Send response back to the client
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection closed! ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
