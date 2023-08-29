<?php

namespace App\WebSocket;

class WebSocketClient
{
    private $client;

    public function __construct($url, $cookies = [])
    {
        $headers = [];
        if (! empty($cookies)) {
            $cookieString = '';
            foreach ($cookies as $key => $value) {
                $cookieString .= "$key=$value; ";
            }
            $headers['Cookie'] = rtrim($cookieString, '; ');
        }

        $options = [
            'headers' => $headers,
        ];

        $this->client = new \WebSocket\Client($url, $options);
    }

    public function sendMessage($message)
    {
        $this->client->send(json_encode($message));

        return json_decode($this->client->receive(), true);
    }
}
