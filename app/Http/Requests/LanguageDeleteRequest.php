<?php

namespace App\Http\Requests;

class LanguageDeleteRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_delete_language'];
    }
}
