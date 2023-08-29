<?php

namespace App\Data;

class UserData extends BaseData
{
    public ?int $id;

    public string $name;

    public string $email;

    public ?string $password;

    /**
     * @var array<string>|null
     */
    public ?array $abilities;
}
