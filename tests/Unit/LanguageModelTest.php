<?php

use App\Models\Language;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->languageCode = 'cl';
    $this->languageName = 'custom_language';
    $this->languageNameUpdated = 'custom_language_updated';

    $this->languageData = [
        'code' => $this->languageCode,
        'name' => $this->languageName,
        'enabled' => true,
    ];
});

test('it can create a language', function () {
    $language = Language::create($this->languageData);

    expect($language->code)->toBe($this->languageCode);
    expect($language->name)->toBe($this->languageName);
    expect($language->enabled)->toBe(true);

    return $language->id;
});

test('it can update a language', function ($languageId) {

    $language = Language::find($languageId);

    $language->update([
        'name' => $this->languageNameUpdated,
    ]);

    expect($language->fresh()->name)->toBe($this->languageNameUpdated);

    return $languageId;

})->depends('it can create a language');

test('it can delete a language', function ($languageId) {

    $language = Language::find($languageId);

    $language->delete();
    // Try to retrieve the language again. If it has been deleted, $deletedLanguage should be null.
    $deletedLanguage = Language::find($languageId);

    expect($deletedLanguage)->toBeNull();

})->depends('it can update a language');
