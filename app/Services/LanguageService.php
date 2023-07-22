<?php

namespace App\Services;

use App\DTO\LanguageDTO;
use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public function enabled(): Collection
    {
        return Language::where('enabled', true)->get();
    }

    /**
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
        $language->update($languageDTO->getAttributes());

        return $language;
    }
}
