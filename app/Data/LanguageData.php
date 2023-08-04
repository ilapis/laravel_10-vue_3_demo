<?php

namespace App\Data;

class LanguageData  extends BaseData
{
    public ?int $id;

    public string $code;

    public string $name;

    public bool $enabled;
}
