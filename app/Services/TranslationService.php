<?php

namespace App\Services;

use App\Models\Translation;
use App\Data\TranslationData;
use Illuminate\Support\Facades\Cache;
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
        return Cache::rememberForever('locale-' . $language_code, function () use ($language_code) {
            return Translation::query()
                ->whereHas('language', function ($query) use ($language_code) {
                    $query->where('code', $language_code);
                })
                ->get(['group', 'key', 'value'])
                ->groupBy('group')
                ->map(function ($groupItems) {
                    return $groupItems->pluck('value', 'key');
                })
                ->toArray();
        });
    }

    public function create(TranslationData $dto): Translation
    {
        $translation = Translation::create($dto->toArray());

        $this->invalidateCache($translation->language->code);

        return $translation->fresh();
    }

    public function update(Translation $translation, TranslationData $dto): ?Translation
    {
        $translation->update($dto->toArray());

        $this->invalidateCache($translation->language->code);

        return $translation->fresh();
    }

    public function delete(Translation $translation): ?Translation
    {
        $languageCode = $translation->language->code;

        $translation->delete();

        $this->invalidateCache($languageCode);

        return $translation->fresh();
    }

    private function invalidateCache(string $language_code): void
    {
        Cache::forget('locale-' . $language_code);
    }
}
