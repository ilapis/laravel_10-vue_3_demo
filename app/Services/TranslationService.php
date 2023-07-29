<?php

namespace App\Services;

use App\Data\TranslationData;
use App\Models\Translation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TranslationService
{
    /**
     * @return LengthAwarePaginator<Translation>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Translation::orderBy('id', 'desc')->filter()->paginate($perPage)->withQueryString();
    }

    public function create(TranslationData $dto): Translation
    {
        return Translation::create($dto->toArray());
    }

    public function update(Translation $translation, TranslationData $dto): ?Translation
    {
        $translation->update($dto->toArray());

        return $translation->fresh();
    }
}
