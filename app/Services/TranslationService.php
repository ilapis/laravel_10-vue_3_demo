<?php

namespace App\Services;

use App\Models\Translation;
use App\DTO\TranslationDTO;

class TranslationService
{
    public function create(TranslationDTO $dto): Translation
    {
        return Translation::create([
            'language_id' => $dto->language_id,
            'key' => $dto->key,
            'value' => $dto->value,
        ]);
    }

    public function update(Translation $translation, TranslationDTO $dto): Translation
    {
        $translation->update([
            'language_id' => $dto->language_id,
            'key' => $dto->key,
            'value' => $dto->value,
        ]);

        return $translation;
    }

    public function delete(Translation $translation): void
    {
        $translation->delete();
    }
}
