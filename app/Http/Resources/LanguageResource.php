<?php

namespace App\Http\Resources;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Language
 */
class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, int|string|bool|null>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'enabled' => $this->enabled,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i') : null,
        ];
    }
}
