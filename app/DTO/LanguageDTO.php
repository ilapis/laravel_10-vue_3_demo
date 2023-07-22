<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class LanguageDTO extends DataTransferObject
{
    public ?int $id;

    public string $code;

    public string $name;

    public bool $enabled;

    public static function fromRequest(Request $request, ?int $id = null): self
    {
        $data = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'enabled' => $request->input('enabled'),
        ];

        if ($id !== null) {
            $data['id'] = $id;
        }

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
