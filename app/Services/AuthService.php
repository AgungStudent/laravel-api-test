<?php

namespace App\Services;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class AuthService
{
    public function login(array $credentials): NewAccessToken
    {
        if (!auth()->attempt($credentials)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'message' => 'username or password wrong']);
        }
        $token = auth()->user()->createToken($credentials['email']);
        return $token;
    }

    public function register(array $data): User
    {
        $user = User::create($data);
        return $user;
    }

    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
