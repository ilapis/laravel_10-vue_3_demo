<?php

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->token = loginMasterUser();
    $this->languageId = App\Models\Language::first()->id;
    $this->translationId = null;
    $this->translationKey = 'test_key';
    $this->translationValue = 'test_value';
    $this->translationValueUpated = 'test_value_updated';
});

it('create test_translation', function () {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$this->token,
    ])->post('/api/v1/translation', [
        'language_id' => $this->languageId,
        'key' => $this->translationKey,
        'value' => $this->translationValue,
    ]);

    $data = json_decode($response->getContent(), true);

    $this->assertEquals($this->translationKey, $data['key']);
    $this->assertEquals($this->translationValue, $data['value']);

    return $data['id'];

})->group('translation-tests');

it('gets translation', function ($translationId) {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$this->token,
    ])->get('/api/v1/translation/'.$translationId);

    $data = json_decode($response->getContent(), true)['data'];

    $this->assertEquals($this->translationKey, $data['key']);
    $this->assertEquals($this->translationValue, $data['value']);

})->group('translation-tests')->depends('it create test_translation');

it('updates translation', function ($translationId) {

    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$this->token,
    ])->put('/api/v1/translation/'.$translationId, [
        'language_id' => $this->languageId,
        'key' => $this->translationKey,
        'value' => $this->translationValueUpated,
    ]);

    $data = json_decode($response->getContent(), true);

    $this->assertEquals($this->translationKey, $data['key']);
    $this->assertEquals($this->translationValueUpated, $data['value']);

    return $data['id'];

})->group('translation-tests')->depends('it create test_translation');

it('get translations', function () {
    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$this->token,
    ])->get('/api/v1/translation');

    $data = json_decode($response->getContent(), true);

    $codeExists = false;

    foreach ($data['data'] as $item) {
        if ($item['key'] === $this->translationKey) {
            $codeExists = true;
            break;
        }
    }

    $this->assertTrue($codeExists);

})->group('translation-tests')->depends('it create test_translation');

it('delete translation', function ($translationId) {
    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$this->token,
    ])->delete('/api/v1/translation/'.$translationId);

    $this->assertEquals(204, $response->getStatusCode());

})->group('translation-tests')->depends('it create test_translation');
