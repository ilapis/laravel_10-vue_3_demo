<?php

namespace App\Data;

use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    public ?int $id;

    public string $name;

    public string $email;

    public ?string $password;

    public ?array $abilities;

    public function toArray(): array
    {
        $data = parent::toArray();

        if ($this->password === null) {
            unset($data['password']);
        }

        return $data;
    }
}
