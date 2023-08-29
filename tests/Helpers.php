<?php

function loginMasterUser(): string
{
    $response = test()->post('/api/v1/auth/login', [
        'email' => env('MASTER_EMAIL'),
        'password' => env('MASTER_PASSWORD'),
    ]);

    if ($response->getStatusCode() == 200) {
        $array = json_decode($response->content(), true);

        return $array['authorization']['token'];
    }

    return '';
}
