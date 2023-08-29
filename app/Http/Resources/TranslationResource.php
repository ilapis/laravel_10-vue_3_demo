<?php

namespace App\Http\Resources;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Translation
 */
class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, int|string|bool|null>
     */
    public function toArray(Request $request): array
    {
        return [
            'translations.id' => $this->id,
            'language.name' => $this->language->name,
            'group' => $this->group,
            'key' => $this->key,
            'value' => $this->value,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
        ];
    }
}
