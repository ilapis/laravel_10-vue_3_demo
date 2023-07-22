<?php

namespace App\Services;

use App\DTO\TranslationDTO;
use App\Models\Translation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TranslationService
{
    /**
     * @return LengthAwarePaginator<Translation>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Translation::orderBy('id', 'desc')->paginate($perPage);
    }

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
}
