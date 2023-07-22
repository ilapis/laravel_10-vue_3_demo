<?php

namespace App\Services;

use App\DTO\LanguageDTO;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LanguageService
{
    /**
     * @return Collection
     */
    public function enabled(): Collection
    {
        return Language::where('enabled', true)->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator<Language>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Language::orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(LanguageDTO $languageDTO): Language
    {
        return Language::create($languageDTO->getAttributes());
    }

    public function update(Language $language, LanguageDTO $languageDTO): Language
    {
        return $language->update($languageDTO->getAttributes());
    }
}
