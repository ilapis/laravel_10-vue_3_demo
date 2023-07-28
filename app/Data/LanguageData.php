<?php

namespace App\Data;

use Spatie\DataTransferObject\DataTransferObject;

class LanguageData extends DataTransferObject
{
    public ?int $id;

    public string $code;

    public string $name;

    public bool $enabled;
}
