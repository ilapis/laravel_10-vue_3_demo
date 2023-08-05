<?php

namespace App\Http\Requests;

class UserDeleteRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_delete_user'];
    }
}
