<?php

namespace App\Http\Requests;

class UserEnabledRequest extends BaseRequest
{
    public function permissions(): array
    {
        return ['can_view_user'];
    }
}
