<?php

namespace App\Services;

use App\Data\LanguageData;
use App\Filters\LanguageFilter;
use App\Models\Language;
use App\Traits\OrderBy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    use OrderBy;

    public function enabled(): Collection
    {
        return Language::where('enabled', true)->filter()->get();
    }

    /**
     * @return LengthAwarePaginator<Language>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Language::orderBy(...$this->orderBy(LanguageFilter::SORTABLE))->withTrashed()->filter()->paginate($perPage)->withQueryString();
    }

    public function create(LanguageData $languageData): Language
    {
        return Language::create($languageData->toArray());
    }

    public function update(Language $language, LanguageData $languageData): ?Language
    {
        $language->update($languageData->toArray());

        return $language->fresh();
    }

    public function delete(Language $language): ?Language
    {
        $language->delete();

        return $language->fresh();
    }
}
