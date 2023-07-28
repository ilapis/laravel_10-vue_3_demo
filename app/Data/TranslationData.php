<?php

namespace App\Data;

use Spatie\DataTransferObject\DataTransferObject;

class TranslationData extends DataTransferObject
{
    public ?int $id;

    public string $language_id;

    public string $group;

    public string $key;

    public string $value;
}
