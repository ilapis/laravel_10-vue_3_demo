<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class TranslationDTO extends DataTransferObject
{
    public ?int $id;

    public string $language_id;

    public string $group;

    public string $key;

    public string $value;

    public static function fromRequest(FormRequest $request): self
    {
        $data = [
            'language_id' => $request->validated('language_id'),
            'group' => $request->validated('group'),
            'key' => $request->validated('key'),
            'value' => $request->validated('value'),
        ];

        return new self($data);
    }

    public function getAttributes(): array
    {
        $data = [
            'language_id' => $this->language_id,
            'group' => $this->group,
            'key' => $this->key,
            'value' => $this->value,
        ];

        if ($this->id !== null) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
