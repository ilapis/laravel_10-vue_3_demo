<?php

namespace App\Services;

use App\DTO\LanguageDTO;
use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    /**
     * @return Collection|\App\Models\Language[]
     */
    public function enabled(): Collection
    {

        return Language::where('enabled', true)->get();
    }

    /**
     * @return LengthAwarePaginator<Language>
     */
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Language::paginate($perPage);
    }

    public function create(LanguageDTO $dto): Language
    {
        return Language::create([
            'code' => $dto->code,
            'name' => $dto->name,
            'enabled' => $dto->enabled,
        ]);
    }

    public function update(Language $language, LanguageDTO $dto): Language
    {
        $language->update([
            'code' => $dto->code,
            'name' => $dto->name,
            'enabled' => $dto->enabled,
        ]);

        return $language;
    }
}
