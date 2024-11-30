<?php

namespace App\Service;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }

    public function login(array $data, $platform)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            if ($platform == 'web-dashboard') {
                Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
                return;
            } else if ($platform == 'mobile-app') {
                //create sanctum token
                $token = $user->createToken('auth_token')->plainTextToken;
                $user->load('wilayah');
                $user = new UserResource($user);
                return [
                    'access_token' => $token,
                    'user' => $user,
                ];
            }
        }
        throw new \Exception('Email Atau Password Salah');
    }
}
