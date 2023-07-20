<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param  array<string>  $data
     */
    public function registerUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Log in a user.
     *
     * @param  array<string>  $credentials
     * @return array<string, mixed>|null
     */
    public function loginUser(array $credentials): ?array
    {
        if (Auth::attempt($credentials) && $user = Auth::user()) {
            if ($existingToken = $user->tokens->first()) {
                if ($existingToken instanceof PersonalAccessToken && now()->lessThanOrEqualTo($existingToken->expires_at)) {
                    return $this->returnToken($existingToken);
                } else {
                    return $this->createToken($user);
                }
            } else {
                return $this->createToken($user);
            }
        }

        return null;
    }

    /**
     * Log out a user.
     *
     * @return array<string, mixed>
     */
    public function logoutUser(Request $request): array
    {
        $authorizationHeader = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $authorizationHeader ?? '');

        $bearerToken = explode('|', $token)[1] ?? null;
        if ($bearerToken && $user = $this->getUserByToken($bearerToken)) {
            $tokenModel = $user->tokens->where('token', $bearerToken)->first();
            if ($tokenModel) {
                $tokenModel->delete();
            }
        }

        return [
            'message' => 'Successfully logged out',
        ];
    }

    /**
     * Refresh the user's token.
     *
     * @return array<string, mixed>
     */
    public function refreshToken(Request $request): array
    {
        $user = $request->user();

        if (! $user instanceof User) {
            throw new \Exception('No authenticated user found');
        }

        return $this->createToken($user);
    }

    /**
     * Get a user by token.
     */
    public function getUserByToken(string $token): ?User
    {
        return User::whereHas('tokens', function ($query) use ($token) {
            $query->where('token', $token);
        })->first();
    }

    /**
     * Create a new token for the user.
     *
     * @return array<string, mixed>
     */
    private function createToken(User $user): array
    {
        if ($existingToken = $user->tokens->first()) {
            if ($existingToken instanceof PersonalAccessToken) {
                $existingToken->delete();
            }
        }

        $newToken = $user->createToken($user->name, ['*'], now()->addHours(8));

        return $this->returnToken($newToken->accessToken);
    }

    /**
     * Return the token details.
     *
     * @return array<string, mixed>
     */
    private function returnToken(PersonalAccessToken $existingToken): array
    {
        return [
            'token' => $existingToken->id.'|'.$existingToken->token,
            'abilities' => $existingToken->abilities,
            'name' => $existingToken->name,
            'expires_at' => $existingToken->expires_at,
        ];
    }
}
