<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        return auth()->shouldUse('api');
    }

    public function register(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json([
            'message' => 'Successfully registered user',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ],201);
    }

    public function login(UserRequest $request)
    {
        $credentials = $request->validated();

        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json([
              'errors' => 'Invalid login credentials',
            ], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
