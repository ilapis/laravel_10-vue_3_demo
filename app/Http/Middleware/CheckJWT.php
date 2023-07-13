<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;

class CheckJWT
{
    public function __construct(private AuthService $authService)
    {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = explode('|', $request->bearerToken())[1];

        if (!$token) {
            return response()->json([
                'message' => 'Not authorized',
            ], 401);
        }

        // Find the user associated with the token
        $user = $this->authService->getUserByToken($token);

        if (!$user) {
            return response()->json([
                'message' => 'Invalid token',
            ], 401);
        }

        // Attach the user to the request
        $request->user = $user;

        return $next($request);
    }
}
