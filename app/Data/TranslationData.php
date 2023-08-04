<?php

namespace App\Data;

class TranslationData extends BaseData
{
    public ?int $id;

    public string $language_id;

    public string $group;

    public string $key;

    public string $value;
}
