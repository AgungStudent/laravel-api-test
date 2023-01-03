<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request->validated());

        return response()->success(['token' => $token->plainTextToken]);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $user = $this->authService->register($registerRequest->validated());
        return response()->success($user, 201);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->noContent();
    }
}
