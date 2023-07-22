<?php

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->token = loginMasterUser();
    $this->languageId = null;
    $this->languageCode = 'test_code';
    $this->languageName = 'test_name';
    $this->languageNameUpated = 'test_name_updated';
    $this->languageEnabled = false;
});

it('create test_language', function () {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $this->token,
    ])->post('/api/v1/language', [
        'code' => $this->languageCode,
        'name' => $this->languageName,
        'enabled' => $this->languageEnabled,
    ]);

    $data = json_decode($response->getContent(), true);

    $this->assertEquals($this->languageCode, $data['code']);
    $this->assertEquals($this->languageName, $data['name']);
    $this->assertEquals($this->languageEnabled, $data['enabled']);

    return $data['id'];

})->group('language-tests');

it('gets language', function ($languageId) {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $this->token,
    ])->get('/api/v1/language/' . $languageId);

    $data = json_decode($response->getContent(), true)['data'];

    $this->assertEquals($this->languageCode, $data['code']);
    $this->assertEquals($this->languageName, $data['name']);
    $this->assertEquals($this->languageEnabled, $data['enabled']);

})->group('language-tests')->depends('it create test_language');

it('updates language', function ($languageId) {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $this->token,
    ])->put('/api/v1/language/' . $languageId, [
        'code' => $this->languageCode,
        'name' => $this->languageNameUpated,
        'enabled' => $this->languageEnabled,
    ]);

    $data = json_decode($response->getContent(), true);

    $this->assertEquals($this->languageCode, $data['code']);
    $this->assertEquals($this->languageNameUpated, $data['name']);
    $this->assertEquals($this->languageEnabled, $data['enabled']);

    return $data['id'];

})->group('language-tests')->depends('it create test_language');

it('gets languages', function () {
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $this->token,
    ])->get('/api/v1/language');

    $data = json_decode($response->getContent(), true);

    $codeExists = false;

    foreach ($data['data'] as $item) {
        if ($item['code'] === $this->languageCode) {
            $codeExists = true;
            break;
        }
    }

    $this->assertTrue($codeExists);

})->group('language-tests')->depends('it create test_language');

it('delete language', function ($languageId) {
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $this->token,
    ])->delete('/api/v1/language/' . $languageId);

    $this->assertEquals(204, $response->getStatusCode());

})->group('language-tests')->depends('it create test_language');
