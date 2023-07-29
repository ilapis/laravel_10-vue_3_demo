<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Locale
{
    public function handle($request, Closure $next)
    {
        if ($locale = $request->header('Accept-Language')) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
