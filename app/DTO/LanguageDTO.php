<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class LanguageDTO extends DataTransferObject
{
    public ?int $id;

    public string $code;

    public string $name;

    public bool $enabled;

    public static function fromRequest(FormRequest $request): self
    {
        $data = [
            'name' => $request->validated('name'),
            'code' => $request->validated('code'),
            'enabled' => $request->validated('enabled'),
        ];

        return new self($data);
    }

    public function getAttributes(): array
    {
        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'enabled' => $this->enabled,
        ];

        if ($this->id !== null) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
