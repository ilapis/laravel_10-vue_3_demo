<?php

namespace App\Http\Requests;

class TranslationDeleteRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_delete_translation'];
    }
}
