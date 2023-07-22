<?php

uses(Tests\TestCase::class);

it('register user', function () {
    $response = $this->post('/api/v1/auth/register', [
        'name' => 'test2',
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertFalse($response->isClientError());
    $this->assertFalse($response->isServerError());
    $this->assertEquals(200, $response->getStatusCode());

})->group('register-user');

it('register user second time', function () {
    $response = $this->post('/api/v1/auth/register', [
        'name' => 'test2',
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertTrue($response->isClientError());
    $this->assertFalse($response->isServerError());
    $this->assertEquals(422, $response->getStatusCode());

})->group('register-user');

it('login existing user', function () {
    $response = $this->post('/api/v1/auth/login', [
        'email' => 'test@example.com2',
        'password' => 'password',
    ]);

    $this->assertFalse($response->isClientError());
    $this->assertFalse($response->isServerError());
    $this->assertEquals(200, $response->getStatusCode());

})->group('register-user');

it('login not existing user', function () {
    $response = $this->post('/api/v1/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password_dd',
    ]);

    $this->assertTrue($response->isClientError());
    $this->assertFalse($response->isServerError());
    $this->assertEquals(401, $response->getStatusCode());

})->group('register-user');
