<?php

namespace App\Services;

use App\Data\TranslationData;
use App\Filters\TranslationFilter;
use App\Models\Translation;
use App\Traits\OrderBy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    use OrderBy;

    /**
     * @return LengthAwarePaginator<Translation>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Translation::orderBy(...$this->orderBy(TranslationFilter::SORTABLE))->filter()->paginate($perPage)->withQueryString();
    }

    /**
     * @return array<string, array<string>>
     */
    public function locale(string $language_code): array
    {
        //TODO add route and button frontend to refresh caches
        //return Cache::rememberForever('locale-'.$language_code, function () use ($language_code) {
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
        //});
    }

    public function create(TranslationData $dto): ?Translation
    {
        $translation = Translation::create($dto->toArray());

        if ($translation->language !== null) {
            $this->invalidateCache($translation->language->code);
        }

        return $translation->fresh();
    }

    public function update(Translation $translation, TranslationData $dto): ?Translation
    {
        $translation->update($dto->toArray());

        if ($translation->language !== null) {
            $this->invalidateCache($translation->language->code);
        }

        return $translation->fresh();
    }

    public function delete(Translation $translation): ?Translation
    {
        if ($translation->language !== null) {
            $languageCode = $translation->language->code;
        }

        $translation->delete();

        if (isset($languageCode)) {
            $this->invalidateCache($languageCode);
        }

        return $translation->fresh();
    }

    private function invalidateCache(string $language_code): void
    {
        Cache::forget('locale-'.$language_code);
    }
}
