<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class TranslationDTO extends DataTransferObject
{
    public ?int $id;

    public string $language_id;

    public string $key;

    public bool $value;

    public static function fromRequest(Request $request, ?int $id = null): self
    {
        $data = [
            'language_id' => $request->input('language_id'),
            'key' => $request->input('key'),
            'value' => $request->input('value'),
        ];

        if ($id !== null) {
            $data['id'] = $id;
        }

        return new self($data);
    }
}
