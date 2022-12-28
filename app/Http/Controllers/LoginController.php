<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (auth()->attempt($validated)) {
            $token = auth()->user()->createToken($request->email)->plainTextToken;

            return response()->json(['status_code' => 200, 'token' => $token]);
        }
        throw \Illuminate\Validation\ValidationException::withMessages([
            'message' => 'username or password wrong']);
    }
}
