<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Language
 */
class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, int|string|bool|null>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'language_id' => $this->language_id,
            'key' => $this->key,
            'value' => $this->value,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
        ];
    }
}
