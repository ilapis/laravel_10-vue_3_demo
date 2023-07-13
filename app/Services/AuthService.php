<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    public function registerUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function loginUser($credentials): ?array
    {
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $existingToken = $user->tokens->first();

            if ($existingToken && now()->lessThanOrEqualTo($existingToken->expires_at)) {
                return $this->returnToken($existingToken);
            } else {
                return $this->createToken($user);
            }
        }

        return null;
    }

    public function logoutUser($request): array
    {
        $bearerToken = explode('|', $request->bearerToken())[1];
        if ($bearerToken && $user = $this->getUserByToken($bearerToken)) {
            $user->tokens->where('token', $bearerToken)->first()->delete();
        }

        return [
            'message' => 'Successfully logged out',
        ];
    }

    public function refreshToken($request): array
    {
        return $this->createToken($request->user);
    }

    public function getUserByToken($token): ?User
    {
        return User::whereHas('tokens', function ($query) use ($token) {
            $query->where('token', $token);
        })->first();
    }

    private function createToken(User $user): array
    {
        if ($existingToken = $user->tokens->first()) {
            $existingToken->delete();
        }

        return $this->returnToken(
            $user
                ->createToken($user->name, ['*'], now()->addHours(8))
                ->accessToken
        );
    }

    private function returnToken($existingToken): array
    {
        return [
            'token' => $existingToken->id . '|' . $existingToken->token,
            'abilities' => $existingToken->abilities,
            'name' => $existingToken->name,
            'expires_at' => $existingToken->expires_at,
        ];
    }
}
