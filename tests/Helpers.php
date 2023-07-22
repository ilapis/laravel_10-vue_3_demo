<?php

use Illuminate\Support\Facades\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
/*
function loginAndGetToken()//: string
{
    $response = Http::withoutVerifying()->post('https://nginx/api/v1/auth/login', [
        'email' => 'sablo.andre@gmail.com',
        'password' => 'testtest',
    ]);

    $token = json_decode($response->body(), true)['authorization']['token'];

    return $token;
}
*/
