<?php

uses(Tests\TestCase::class);

beforeEach(function () {
    $response = test()->post('/api/v1/auth/login', [
        'name' => env('MASTER_NAME'),
        'email' => env('MASTER_EMAIL'),
        'password' => env('MASTER_PASSWORD'),
    ]);

    if ($response->getStatusCode() == 200) {
        $array = json_decode($response->content(), true);
        $this->token = $array['authorization']['token'];
    }
    //echo $this->token;
    //$array = json_decode($response->content(), true);
    //echo $response->getStatusCode();//200
    //print_r();
    //$this->token = $array['authorization']['token'];
});

it('register user', function () {
    $response = $this->post('/api/v1/auth/register', [
        'name' => 'test2',
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertFalse($response->isClientError());
    $this->assertFalse($response->isServerError());
    echo '|1->' . $response->getStatusCode();
    //echo $response->getContent();
})->group('register-user');

it('register user second time', function () {
    $response = $this->post('/api/v1/auth/register', [
        'name' => 'test2',
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertTrue($response->isClientError());
    $this->assertFalse($response->isServerError());
    echo '|2->' . $response->getStatusCode();//422
    //echo $response->getContent();
})->group('register-user');

it('login existing user', function () {
    $response = $this->post('/api/v1/auth/login', [
        //'name' => 'test2',
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertFalse($response->isClientError());
    $this->assertFalse($response->isServerError());
    echo '|3->' . $response->getStatusCode();//200
    //echo $response->getContent();
})->group('register-user');

it('login not existing user', function () {
    $response = $this->post('/api/v1/auth/login', [
        //'name' => 'test2',
        'email' => 'test@example.com',
        'password' => 'password_dd',
    ]);

    $this->assertTrue($response->isClientError());
    $this->assertFalse($response->isServerError());
    echo '|4->' . $response->getStatusCode();//401
    //echo $response->getContent();
})->group('register-user');
