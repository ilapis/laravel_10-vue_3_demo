<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $authData = $this->authService->loginUser($credentials);

        if ($authData) {
            return response()->json([
                'authorization' => array_merge(
                    $authData,
                    ['type' => 'bearer']
                ),
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->registerUser($request->all());

        $userResourceArray = (new UserResource($user))->response()->getData(true);
        $userResourceArray['message'] = 'User created successfully';

        return response()->json($userResourceArray);
    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json($this->authService->logoutUser($request));
    }

    public function refresh(Request $request): JsonResponse
    {
        return response()->json([
            'authorization' => array_merge(
                $this->authService->refreshToken($request),
                ['type' => 'bearer']
            ),
        ]);
    }
}
