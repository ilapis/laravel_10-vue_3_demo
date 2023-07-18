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
        $bearerToken = $request->bearerToken();

        if (!$bearerToken) {
            return response()->json([
                'message' => 'Not authorized',
            ], 401);
        }

        $tokenParts = explode('|', $bearerToken);

        if (count($tokenParts) < 2) {
            return response()->json([
                'message' => 'Invalid token format',
            ], 401);
        }

        $token = $tokenParts[1];

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
