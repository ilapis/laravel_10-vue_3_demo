<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait PerPage
{
    private function perPage(): int
    {
        return filter_var(request()->get('per_page', 10), FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1]]);
    }
}
