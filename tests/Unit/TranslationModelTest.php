<?php

use App\Models\Language;
use App\Models\Translation;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->languageData = [
        'code' => 'ctl',
        'name' => 'custom_translation_language',
        'enabled' => true,
    ];
    $this->language = Language::firstOrCreate($this->languageData);

    $this->translationKey = 'key_test';
    $this->translationValue = 'value_test';
    $this->translationValueUpdated = 'value_updated';
});

test('it can create a translation', function () {
    $translation = Translation::create([
        'language_id' => $this->language->id,
        'key' => $this->translationKey,
        'value' => $this->translationValue,
    ]);

    expect($translation->language_id)->toBe($this->language->id);
    expect($translation->key)->toBe($this->translationKey);
    expect($translation->value)->toBe($this->translationValue);

    return $translation->id;
});

test('it can update a translation', function ($translationId) {
    $translation = Translation::find($translationId);

    $translation->update([
        'value' => $this->translationValueUpdated,
    ]);

    expect($translation->fresh()->value)->toBe($this->translationValueUpdated);

    return $translationId;
})->depends('it can create a translation');

test('it can delete a translation', function ($translationId) {
    $translation = Translation::find($translationId);

    $translation->delete();

    $deletedTranslation = Translation::find($translationId);

    expect($deletedTranslation)->toBeNull();
})->depends('it can update a translation');
