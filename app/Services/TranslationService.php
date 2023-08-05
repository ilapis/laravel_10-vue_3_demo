<?php

namespace App\Services;

use App\Models\Translation;
use App\Data\TranslationData;
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

    public function locale(string $language_code): array
    {
        return Translation::query()
            ->whereHas('language', function ($query) use ($language_code) {
                $query->where('code', $language_code);
            })
            ->get(['group', 'key', 'value'])
            ->groupBy('group')
            ->map(function ($groupItems) {
                return $groupItems->pluck('value', 'key');
            })
            ->toArray();;
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

    public function delete(Translation $translation): ?Translation
    {
        $translation->delete();

        return $translation->fresh();
    }
}
