<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class TranslationDTO extends DataTransferObject
{
    public ?int $id;

    public string $language_id;

    public string $group;

    public string $key;

    public string $value;

    public static function fromRequest(Request $request, ?int $id = null): self
    {
        $data = [
            'language_id' => $request->input('language_id'),
            'group' => $request->input('group'),
            'key' => $request->input('key'),
            'value' => $request->input('value'),
        ];

        if ($id !== null) {
            $data['id'] = $id;
        }

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
