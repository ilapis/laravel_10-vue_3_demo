<?php

namespace App\Services;

use App\Data\LanguageData;
//use App\DTO\LanguageDTO;
use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public function enabled(): Collection
    {
        return Language::where('enabled', true)->filter()->get();
    }

    /**
     * @return LengthAwarePaginator<Language>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Language::orderBy('id', 'desc')->filter()->paginate($perPage)->withQueryString();
    }

    public function create(LanguageData $languageData): Language
    {
        return Language::create($languageData->toArray());
    }

    public function update(Language $language, LanguageData $languageData): Language
    {
        $language->update($languageData->toArray());

        return $language->fresh();
    }
}
